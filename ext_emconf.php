<?php
/* * *************************************************************
 * Extension Manager/Repository config file for ext "eh_bootstrap".
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 * ************************************************************* */

$EM_CONF[$_EXTKEY] = array(
	'title' => 'TYPO3 CMS example extension',
	'description' => 'A TYPO3 example extension with examples of update script, eID integration, scheduler tasks and default TypoScript.',
	'category' => 'example',
	'constraints' =>
	array(
		'depends' =>
		array(
			'typo3' => '7.6.0-8.99.99',
			'typoscript_rendering' => '2.0.0-'
		),
		'conflicts' =>
		array(
		),
		'suggests' =>
		array(
		),
	),
	'autoload' => array(
		'psr-4' =>
		array(
			'EHAERER\\EhBootstrap\\' => 'Classes',
		),
	),
	'state' => 'stable',
	'uploadfolder' => false,
	'createDirs' => '',
	'clearCacheOnLoad' => 1,
	'author' => 'Ephraim Härer',
	'author_email' => 'ephraim@ephespage.de',
	'author_company' => 'private',
	'version' => '1.0.4',
	'clearcacheonload' => true,
);

