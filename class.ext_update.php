<?php

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Update script
 *
 * @package EHAERER\EhBootstrap
 */
class ext_update
{

	/**
	 * @var \TYPO3\CMS\Core\Messaging\FlashMessageQueue
	 * @inject
	 */
	protected $flashMessageQueue;

	/**
	 * @var string
	 */
	protected $extensionKey = 'eh_bootstrap';

	/**
	 * Check if upgrade script is needed (this function is called from the extension manager)
	 *
	 * @return boolean
	 */
	public function access()
	{
		return $this->getBackendUserAuthentication()->isAdmin();
	}

	/**
	 * Run upgrade scripts (this function is called from the extension manager)
	 *
	 * @return string
	 */
	public function main()
	{
		$updateScriptLink = BackendUtility::getModuleUrl('tools_ExtensionmanagerExtensionmanager', [
				'tx_extensionmanager_tools_extensionmanagerextensionmanager' => [
					'extensionKey' => $this->extensionKey,
					'action' => 'show',
					'controller' => 'UpdateScript',
				],
		]);
		$view = $this->getView();
		$viewValues = ['formAction' => $updateScriptLink];

		if ((int) GeneralUtility::_GP('doSomething') === 1) {
			$contentElements = $this->doSomething();
			$viewValues['contentElements'] = $contentElements;
		}

		$view->assignMultiple($viewValues);

		return $view->render();
	}

	/**
	 * Get tt_content data
	 *
	 * @return array
	 */
	protected function doSomething()
	{
		$table = 'tt_content';
		$res = $this->getDatabaseConnection()->exec_SELECTgetRows(
			'uid, pid, tstamp, crdate, CType, header', $table, '', '', '', 1000
		);

		if (count($res) > 0) {
			$message = $this->getObjectManager()->get(
				'TYPO3\\CMS\\Core\\Messaging\\FlashMessage', 'A total of ' . count($res) . ' content elements found.', 'Content elements found', FlashMessage::OK
			);
		} else {
			$message = $this->getObjectManager()->get(
				'TYPO3\\CMS\\Core\\Messaging\\FlashMessage', 'No content elements found.', 'Nothing to do', FlashMessage::ERROR
			);
		}
		$this->getFlashMessageQueue()->enqueue($message);
		return $res;
	}

	/**
	 * @return \TYPO3\CMS\Extbase\Object\ObjectManager
	 */
	protected function getObjectManager()
	{
		return GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
	}

	/**
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseConnection()
	{
		return $GLOBALS['TYPO3_DB'];
	}

	/**
	 * @return \TYPO3\CMS\Core\Authentication\BackendUserAuthentication
	 */
	protected function getBackendUserAuthentication()
	{
		return $GLOBALS['BE_USER'];
	}

	/**
	 * @return \TYPO3\CMS\Fluid\View\StandaloneView
	 */
	protected function getView()
	{
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
		$view = $this->getObjectManager()->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$view->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:' . $this->extensionKey . '/Resources/Private/Templates/UpdateScript/Index.html'));
		$view->setLayoutRootPaths([GeneralUtility::getFileAbsFileName('EXT:' . $this->extensionKey . '/Resources/Private/Layouts')]);
		$view->setPartialRootPaths([GeneralUtility::getFileAbsFileName('EXT:' . $this->extensionKey . '/Resources/Private/Partials')]);
		return $view;
	}

	/**
	 * @return \TYPO3\CMS\Core\Messaging\FlashMessageQueue
	 */
	protected function getFlashMessageQueue()
	{
		if (!isset($this->flashMessageQueue)) {
			/** @var \TYPO3\CMS\Core\Messaging\FlashMessageService $flashMessageService */
			$flashMessageService = $this->getObjectManager()->get('TYPO3\\CMS\\Core\\Messaging\\FlashMessageService');
			$this->flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier('reintcontentelements.errors');
		}
		return $this->flashMessageQueue;
	}
}
