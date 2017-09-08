<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Register for hook to show preview of tt_content element of CType="yourextensionkey_newcontentelement" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['eh_bs_01'] = \EHAERER\EhBootstrap\Hooks\PageLayoutView\NewContentElementPreviewRenderer::class;

// register Extbase plugin
/* @see https://docs.typo3.org/typo3cms/ExtbaseFluidBook/4-FirstExtension/7-configuring-the-plugin.html */
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'EHAERER.' . $_EXTKEY, 'Ehbs', array(
	'Abstract' => 'plugin, render',
	),
	// non-cacheable actions
	array(
	'Abstract' => 'render',
	)
);

// register the class for ajax via eid and Extbase class
$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['ehBootstrap'] = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Classes/Eid/ExtbaseDispatcher.php';
