<?php
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
 *
 *
 * [Example-6]
 * Usage of this script:
 *
 * - Copy this script in your Extension Dir in the Folder Classes
 * - Set the Vendor and Extension Name in Line 82 + 83
 * - Include the next line in the ext_localconf.php, change the ext name!
 * - $TYPO3_CONF_VARS['FE']['eID_include']['myExtAjaxDispatcher'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('myExtension').'Classes/Eid/EidDispatcher.php';
 *
 * tested with TYPO3 7.6 and 8.7
 * 
 * Usage for AJAX calls in your jQuery Code:
 * see example file Resources/Public/JavaScript/main.js
 *
 * $('.jqAjax').click(function(e) {
 * var uid = $(this).find('.uid').html();
 * var storagePid = '11';
 *
 * $.ajax({
 * async: 'true',
 * url: 'index.php',
 * type: 'POST',
 *
 * data: {
 *     eID: "ehBootstrap",
 *     request: {
 *          pluginName: 'ehbs',
 *          controller: 'Abstract',
 *          action: 'render',
 *          arguments: {
 * 					'mailuid': mailuid
 * 				}
 * 			}
 *      },
 *      dataType: "json",
 *      success: function(result) {
 *           console.log(result);
 *      },
 *      error: function(error) {
 *           console.log(error);
 *      }
 * });
 * ************************************************************* */
/* * **********************************
 * Gets the AJAX Call Parameters
 * ********************************* */
$ajax = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('request');
/**
 * Set Vendor and Extension Name
 *
 * Vendor Name like your Vendor Name in namespaces
 * ExtensionName in upperCamelCase
 */
$ajax['vendor'] = 'EHAERER';
$ajax['extensionName'] = 'EhBootstrap';
if (!isset($ajax['controller'])) {
	$ajax['controller'] = 'Abstract';
}
if (!isset($ajax['action'])) {
	$ajax['action'] = 'render';
}
if (!isset($ajax['arguments'])) {
	$ajax['arguments'] = array();
}
$pid = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
if (is_null($pid)) {
	$pid = 1;
}

global $TYPO3_CONF_VARS;

/* @var $GLOBALS['TSFE'] \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController */
$GLOBALS['TSFE'] = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController::class, $TYPO3_CONF_VARS, $pid, 0);
\TYPO3\CMS\Frontend\Utility\EidUtility::initLanguage();
// Get FE User Information
$GLOBALS['TSFE']->initFEuser();
// get backend user information
$GLOBALS['TSFE']->initializeBackendUser();
// init TCA to load content elements
\TYPO3\CMS\Frontend\Utility\EidUtility::initTCA();
// disable Cache for AJAX calls
$GLOBALS['TSFE']->set_no_cache();
// Provides ways to bypass the '?id=[xxx]&type=[xx]' format
$GLOBALS['TSFE']->checkAlternativeIdMethods();
// Determines the id and evaluates any preview settings
$GLOBALS['TSFE']->determineId();
// Initialize the TypoScript template parser
$GLOBALS['TSFE']->initTemplate();
// Checks if config-array exists already but if not, gets it
$GLOBALS['TSFE']->getConfigArray();

/* @var $GLOBALS['TSFE']->cObj \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer */
$GLOBALS['TSFE']->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer::class);
// Setting the language key that will be used by the current page
$GLOBALS['TSFE']->settingLanguage();
// Setting locale for frontend rendering
$GLOBALS['TSFE']->settingLocale();
/* @var $objectManager \TYPO3\CMS\Extbase\Object\ObjectManager */
$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Object\ObjectManager::class);
/* * *********************************
 * Initialize the Extbase bootstap
 * ******************************** */
$bootstrapConf = [
	'extensionName' => $ajax['extensionName'],
	'pluginName' => $ajax['pluginName'],
];
/* @var $bootstrap \TYPO3\CMS\Extbase\Core\Bootstrap */
$bootstrap = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Core\Bootstrap::class);
$bootstrap->initialize($bootstrapConf);
/* @var $bootstrap->cObj \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer */
$bootstrap->cObj = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer::class);
/* * *****$bootstrap*************
 * Build the request
 * ***************** */
/* @var $request \TYPO3\CMS\Extbase\Mvc\Request */
$request = $objectManager->get(\TYPO3\CMS\Extbase\Mvc\Request::class);
$request->setControllerVendorName($ajax['vendor']);
$request->setcontrollerExtensionName($ajax['extensionName']);
$request->setPluginName($ajax['pluginName']);
$request->setControllerName($ajax['controller']);
$request->setControllerActionName($ajax['action']);
$request->setArguments($ajax['arguments']);
// set to use html file as template -> default is txt file
$request->setFormat("html");
/* @var $response \TYPO3\CMS\Extbase\Mvc\ResponseInterface */
$response = $objectManager->get(\TYPO3\CMS\Extbase\Mvc\ResponseInterface::class);
/* @var $dispatcher \TYPO3\CMS\Extbase\Mvc\Dispatcher */
$dispatcher = $objectManager->get(\TYPO3\CMS\Extbase\Mvc\Dispatcher::class);
$dispatcher->dispatch($request, $response);
echo $response->getContent();
