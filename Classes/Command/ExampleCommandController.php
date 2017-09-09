<?php
namespace EHAERER\EhBootstrap\Command;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Messaging\FlashMessage;

/**
 * Example controller
 *
 */
class ExampleCommandController extends CommandController
{

	/**
	 * one command
	 * 
	 * @param int $required
	 * @param boolean $optional
	 * @param string $string
	 */
	public function runCommand($required, $optional = false, $string = '')
	{
		$message = 'Required: ' . $required . ' | optional:' . $optional . ' | string:' . $string;
		$messageOut = GeneralUtility::makeInstance(
				\TYPO3\CMS\Core\Messaging\FlashMessage::class, $message, 'Field content', FlashMessage::OK, FALSE
		);
		// get backend message queue
		$flashMessageService = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\FlashMessageService::class);
		$flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
		// add message
		$flashMessageQueue->enqueue($messageOut);

		return true;
	}
}
