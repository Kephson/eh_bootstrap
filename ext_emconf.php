<?php
/* * *************************************************************
 * Extension Manager/Repository config file for ext "eh_bootstrap".
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 * ************************************************************* */

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Bootstrap example extension',
	'description' => 'Bootstrap extension with examples of update script, eid integration, scheduler tasks.',
	'category' => 'example',
	'constraints' =>
	array(
		'depends' =>
		array(
			'typo3' => '7.6.0-8.99.99',
			'typoscript_rendering' => '*'
		),
		'conflicts' =>
		array(
		),
		'suggests' =>
		array(
		),
	),
	'autoload' =>
	array(
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
	'version' => '1.0.3',
	'clearcacheonload' => true,
);

