<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/*
 * Register extension icons
 * this is required for TYPO3 8.7 and available since TYPO3 7.5
 * @see https://docs.typo3.org/typo3cms/CoreApiReference/ApiOverview/Icon/Index.html
 * [Example-12]
 */
/* @var $iconRegistry \TYPO3\CMS\Core\Imaging\IconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
// register a svg-icon with the identifier 'eh-bootstrap-icon'
$iconRegistry->registerIcon(
	'eh-bootstrap-icon', \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class, ['source' => 'EXT:eh_bootstrap/ext_icon.svg']
);

/* add a default pageTS
 * @see https://docs.typo3.org/typo3cms/extensions/fluid_styled_content/7.6/AddingYourOwnContentElements/Index.html
 * [Example-4]
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
mod.wizards.newContentElement.wizardItems.common {
	elements {
		eh_bs_01 {
			iconIdentifier = eh-bootstrap-icon
			title = LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:eh_bs_01_title
			description = LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:eh_bs_01_desc
			tt_content_defValues {
				CType = eh_bs_01
			}
		}
	}
	show := addToList(eh_bs_01)
}
');

// register the plugin to see it in TYPO3 backend
/* @see https://docs.typo3.org/typo3cms/ExtbaseFluidBook/4-FirstExtension/7-configuring-the-plugin.html */
// [Example-5]
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY, 'Ehbs', 'Example plugin'
);


if (TYPO3_MODE === 'BE') {

	/**
	 * Register a backend module
	 * [Example-9]
	 */
	\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
		'EHAERER.' . $_EXTKEY, 'web', // Make module a submodule of 'web'
		'ehbootstrap', // Submodule key
		'', // Position
		array(
		'Abstract' => 'module',
		), array(
		'access' => 'user,group',
		'icon' => 'EXT:' . $_EXTKEY . '/ext_icon.svg',
		'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xlf',
		'navigationComponentId' => '',
		'inheritNavigationComponentFromMainModule' => false
		)
	);
}