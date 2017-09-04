<?php

namespace EHAERER\EhBootstrap\Controller;

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

use \TYPO3\CMS\Core\Messaging\FlashMessage;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Core\Utility\DebugUtility;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use \TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use \TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * AbstractController
 */
class AbstractController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

	/**
	 * persistenceManager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * @var \In2code\Powermail\Domain\Repository\MailRepository
	 * @inject
	 */
	protected $mailRepository;

	/**
	 * action render
	 *
	 * @return \string The rendered view.
	 */
	public function renderAction() {
		// show it only for logged in backend users
		if ($GLOBALS['TSFE']->beUserLogin) {
			if ($this->request->hasArgument('mailuid')) {
				$mailuid = (int) $this->request->getArgument('mailuid');
				$mail = $this->mailRepository->findByUid($mailuid);
				//DebuggerUtility::var_dump($mail);
				$this->view->assign("mail", $mail);
			}
		}
	}

}