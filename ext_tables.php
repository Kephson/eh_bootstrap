<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'EH bootstrap');

// add default pageTS
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('
	mod.wizards.newContentElement.wizardItems.common.elements {
		eh_bs_01 {
			icon = EXT:eh_bootstrap/ext_icon.svg
			title = LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:eh_bs_01_title
			description = LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:eh_bs_01_desc
			tt_content_defValues.CType = eh_bs_01
		}
	}
	mod.wizards.newContentElement.wizardItems.common.show := addToList(eh_bs_01)
');

