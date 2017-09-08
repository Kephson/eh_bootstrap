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

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Messaging\FlashMessage;

class ExampleTask
{

	/**
	 * executes the task function
	 * 
	 * @param string $link
	 * @param string $transLang
	 * @param string $receiver_email
	 * @param string $receiver_name
	 * @param string $sender_email
	 * @param string $sender_name
	 * @param integer $rootpage_id
	 * 
	 * @return boolean
	 */
	public function run($link, $transLang)
	{
		$messageOut = GeneralUtility::makeInstance(
				\TYPO3\CMS\Core\Messaging\FlashMessage::class, 'Configured link: ' . $link . ' | Configured language: ' . $transLang, 'Field content', FlashMessage::OK, FALSE
		);
		// get backend message queue
		$flashMessageService = GeneralUtility::makeInstance(\TYPO3\CMS\Core\Messaging\FlashMessageService::class);
		$flashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();
		// add message
		$flashMessageQueue->enqueue($messageOut);

		return true;
	}
}
