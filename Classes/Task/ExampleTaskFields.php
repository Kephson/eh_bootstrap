<?php
namespace EHAERER\EhBootstrap\Task;

/* * *************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Ephraim Härer <ephraim@ephespage.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Core\Messaging\FlashMessage;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Utility\DebugUtility;

/**
 * [Example-10]
 * additional task class to add custom fields in the scheduler
 * @see https://docs.typo3.org/typo3cms/extensions/scheduler/DevelopersGuide/CreatingTasks/Index.html
 */
class ExampleTaskFields implements \TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface
{

	protected $extKey = 'eh_bootstrap';
	protected $taskKey = 'example';
	protected $fieldNamePrefix = '';

	/**
	 * Gets additional fields to render in the form to add/edit a task
	 *
	 * @param array $taskInfo Values of the fields from the add/edit task form
	 * @param \TYPO3\CMS\Scheduler\Task\AbstractTask $task The task object being edited. Null when adding a task!
	 * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject Reference to the scheduler backend module
	 * @return array A two dimensional array, array('Identifier' => array('fieldId' => array('code' => '', 'label' => '', 'cshKey' => '', 'cshLabel' => ''))
	 */
	public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject)
	{

		$this->fieldNamePrefix = 'tx_scheduler[' . $this->extKey . '][' . $this->taskKey . ']';
		$additionalFields = array();

		$editEntry = false;
		if ($parentObject->CMD === 'edit') {
			$editEntry = true;
		}

		// write link field
		if (empty($taskInfo[$this->extKey][$this->taskKey]['link'])) {
			if ($editEntry) {
				$taskInfo[$this->extKey][$this->taskKey]['link'] = $task->link;
			} else {
				$taskInfo[$this->extKey][$this->taskKey]['link'] = '';
			}
		}
		$fieldID_0 = 'task_' . $this->taskKey . '_link';
		$fieldCode_0 = $this->getTextField($fieldID_0, 'link', $taskInfo[$this->extKey][$this->taskKey]['link']);
		$additionalFields[$fieldID_0] = array(
			'code' => $fieldCode_0,
			'label' => 'LLL:EXT:' . $this->extKey . '/Resources/Private/Language/locallang.xlf:task_f_0'
		);

		// write language field
		if (empty($taskInfo[$this->extKey][$this->taskKey]['transLanguage'])) {
			if ($editEntry) {
				$taskInfo[$this->extKey][$this->taskKey]['transLanguage'] = $task->translang;
			} else {
				$taskInfo[$this->extKey][$this->taskKey]['transLanguage'] = 'en';
			}
		}
		$fieldID_1 = 'task_' . $this->taskKey . '_transLanguage';
		$fieldCode_1 = $this->getTranslationField($fieldID_1, $taskInfo[$this->extKey][$this->taskKey]['transLanguage']);
		$additionalFields[$fieldID_1] = array(
			'code' => $fieldCode_1,
			'label' => 'LLL:EXT:' . $this->extKey . '/Resources/Private/Language/locallang.xlf:task_f_1'
		);

		return $additionalFields;
	}

	/**
	 * Validates the additional fields' values
	 *
	 * @param array $submittedData An array containing the data submitted by the add/edit task form
	 * @param \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject Reference to the scheduler backend module
	 * @return boolean TRUE if validation was ok (or selected class is not relevant), FALSE otherwise
	 */
	public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $parentObject)
	{

		$errors = array();
		$message = array();

		if (empty($submittedData[$this->extKey][$this->taskKey]['link'])) {
			$errors['link'] = true;
			$message[]['head'] = LocalizationUtility::translate('task_f_0_message_error_head', $this->extKey);
			$message[]['body'] = LocalizationUtility::translate('task_f_0_message_error_body', $this->extKey);
			$submittedData[$this->extKey][$this->taskKey]['link'] = '';
		} else {
			$submittedData[$this->extKey][$this->taskKey]['link'] = trim($submittedData[$this->extKey][$this->taskKey]['link']);
		}

		if (empty($submittedData[$this->extKey][$this->taskKey]['transLanguage'])) {
			$submittedData[$this->extKey][$this->taskKey]['transLanguage'] = 'en';
		} else {
			$submittedData[$this->extKey][$this->taskKey]['transLanguage'] = $submittedData[$this->extKey][$this->taskKey]['transLanguage'];
		}

		if (!empty($errors)) {
			foreach ($message as $m) {
				/* @var $messageOut \TYPO3\CMS\Core\Messaging\FlashMessage */
				$messageOut = GeneralUtility::makeInstance(
						\TYPO3\CMS\Core\Messaging\FlashMessage::class, $m['body'], $m['head'], FlashMessage::ERROR, FALSE
				);
				// get backend message queue
				/* @var $flashMessageService \TYPO3\CMS\Core\Messaging\FlashMessageService */
				$flashMessageService = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\FlashMessageService::class);
				$flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier('ehBoostrap.task.default');
				// add message
				$flashMessageQueue->enqueue($messageOut);
			}
			return false;
		} else {
			return true;
		}

		return true;
	}

	/**
	 * Takes care of saving the additional fields' values in the task's object
	 *
	 * @param array $submittedData An array containing the data submitted by the add/edit task form
	 * @param \TYPO3\CMS\Scheduler\Task\AbstractTask $task Reference to the scheduler backend module
	 * @return void
	 */
	public function saveAdditionalFields(array $submittedData, \TYPO3\CMS\Scheduler\Task\AbstractTask $task)
	{
		$task->link = $submittedData[$this->extKey][$this->taskKey]['link'];
		$task->translang = $submittedData[$this->extKey][$this->taskKey]['transLanguage'];
	}

	/**
	 * returns a selectbox with translation options
	 * 
	 * @param string $fieldID
	 * @param string $fieldKey
	 * @param string $value
	 * 
	 * @return string
	 */
	protected function getTextField($fieldID, $fieldKey, $value)
	{

		return '<input class="form-control" type="text" name="' . $this->fieldNamePrefix . '[' . $fieldKey . ']" id="' . $fieldID . '" value="' . $value . '" size="30" />';
	}

	/**
	 * returns a selectbox with translation options
	 * 
	 * @param string $fieldID
	 * @param string $value
	 * 
	 * @return string
	 */
	protected function getTranslationField($fieldID, $value = 'en')
	{

		$field = '<select name="' . $this->fieldNamePrefix . '[transLanguage]" id="' . $fieldID . '" class="form-control">';
		$values = array(
			'en' => 'task_en',
			'de' => 'task_de',
		);
		foreach ($values as $k => $r) {
			if ($k === $value) {
				$selected = ' selected="selected"';
			} else {
				$selected = '';
			}
			$field .= '<option value="' . $k . '"' . $selected . '>' . LocalizationUtility::translate($r, $this->extKey) . '</option>';
		}
		$field .= '</select>';
		return $field;
	}
}
