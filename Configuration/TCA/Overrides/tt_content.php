<?php
/* TCA config for the content element
 * [Example-4]
 * @see https://docs.typo3.org/typo3cms/extensions/fluid_styled_content/7.6/AddingYourOwnContentElements/Index.html
 */
// add the new CType
$GLOBALS['TCA']['tt_content']['columns']['CType']['config']['items'][] = array(
	'LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:eh_bs_01_title',
	'eh_bs_01',
	'EXT:eh_bootstrap/ext_icon.png'
	// doesnt't work in TYPO3 7.6 with FILE:EXT:
);
// add a new palette for example content element
// example with field header and header link
$GLOBALS['TCA']['tt_content']['palettes']['eh_bs_01'] = array(
	'showitem' => 'header;LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:eh_bs_01_header_title,
         --linebreak--,header_link;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header_link_formlabel',
	'canNotCollapse' => 1
);
// configure the shown palettes
$GLOBALS['TCA']['tt_content']['types']['eh_bs_01'] = array(
	'showitem' => '
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:eh_bootstrap/Resources/Private/Language/locallang.xlf:palettes.eh_bs_01;eh_bs_01,
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
	--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
	--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
	--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
	--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,rowDescription
');
