<?php
if (!defined('CAKEPHP_SHELL')) {
	if (!file_exists(TMP . 'config.php')) {
		App::uses('ClassRegistry', 'Utility');
		ClassRegistry::init('Config.Config')->writeFile('config.php');
	}
}
if (file_exists(TMP . 'config.php')) {
	include (TMP . 'config.php');
	Configure::write($config);
}

