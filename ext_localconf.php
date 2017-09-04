<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

// Register for hook to show preview of tt_content element of CType="yourextensionkey_newcontentelement" in page module
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['cms/layout/class.tx_cms_layout.php']['tt_content_drawItem']['eh_bs_01'] = \EHAERER\EhBootstrap\Hooks\PageLayoutView\NewContentElementPreviewRenderer::class;
