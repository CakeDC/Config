<?php
/**
 * Copyright 2010 - 2012, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2012, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

class ConfigCacherShell extends Shell {

/**
 * Entry point for this shell, only display the help
 *
 * @return void
 */
	public function main() {
		$this->help();
	}

/**
 * Writes the configuration keys into a file.
 *
 */
	public function cache() {
		$this->out('Writing configurations in ' . TMP . 'config.php');
		ClassRegistry::init('Config.Config')->writeFile('config.php');
		$this->out('Done.');
	}

/**
 * Displays the help for this shell
 *
 */
	public function help() {
		$this->out('Usage: cake config_cacher cache');
		$this->out('This shell is meant to be used to cache all configuration keys stored in database into a php file');
	}
}