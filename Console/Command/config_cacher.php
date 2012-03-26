<?php

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