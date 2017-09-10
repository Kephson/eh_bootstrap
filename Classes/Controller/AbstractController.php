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
	 * extension key
	 * 
	 * @var string
	 */
	protected $extKey = 'eh_bootstrap';

	/**
	 * settings in extension manager
	 * 
	 * @var array
	 */
	protected $emSettings;

	public function __construct()
	{
		parent::__construct();
		$this->emSettings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf'][$this->extKey]);
	}

	/**
	 * action plugin
	 *
	 * @return \string The rendered view.
	 */
	public function pluginAction()
	{
		$this->view->assignMultiple(
			array(
				'emSettings' => $this->emSettings
			)
		);
	}

	/**
	 * action render
	 *
	 * @return \string The rendered view.
	 */
	public function renderAction()
	{
		// show it only for logged in backend users
		$example = NULL;
		if ($GLOBALS['TSFE']->beUserLogin) {
			if ($this->request->hasArgument('exampleUid')) {
				//$exampleUid = (int) $this->request->getArgument('exampleUid');
				$example = NULL;
			}
		}
		$this->view->assignMultiple(
			array(
				"example" => $example,
				'emSettings' => $this->emSettings
			)
		);
	}
	
	/**
	 * action module
	 *
	 * @return \string The rendered view. For the backend module
	 */
	public function moduleAction()
	{
		$this->view->assignMultiple(
			array(
				"example" => 'example',
				'emSettings' => $this->emSettings
			)
		);
	}
}
