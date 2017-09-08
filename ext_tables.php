<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

/* add a default pageTS
 * @see https://docs.typo3.org/typo3cms/extensions/fluid_styled_content/7.6/AddingYourOwnContentElements/Index.html
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
mod.wizards.newContentElement.wizardItems.common {
	elements {
		eh_bs_01 {
			icon = EXT:eh_bootstrap/ext_icon.svg
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
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	$_EXTKEY, 'Ehbs', 'Example plugin'
);

