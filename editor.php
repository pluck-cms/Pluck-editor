<?php
//MODULE NAME: Pluck Editor

//Make sure the file isn't accessed directly
defined('IN_PLUCK') or exit('Access denied!');

function editor_info() {
	global $lang;
	$module_info = array(
		'name'          => $lang['editor']['name'],
		'intro'         => $lang['editor']['intro'],
		'version'       => '0.1',
		'author'        => $lang['editor']['author'],
		'website'       => 'http://xobit.nl',
		'icon'          => 'images/style-edit.png',
		'compatibility' => '4.7'
	);
	return $module_info;
}
 
?>