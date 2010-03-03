<?php
class Config extends ConfigAppModel {

/**
 * Name
 *
 * @var string Name
 * @access public
 */
	public $name = 'Config';

/**
 * Config file to deal with
 *
 * @var string
 * @access public
 */
	public static $configFile = 'config.php';

/**
 * Write key / value pairs to the database
 *
 * @param array Config data
 * @return boolean
 * @access public
 */
	public function write($config) {
		$alias = $this->alias;
		$this->deleteAll(array($this->alias . '.key' => array_keys($config[$this->alias])), false);

		foreach ($config[$this->alias] as $key => $value) {
			$data = array(
				$this->alias => array(
					'key' => $key,
					'value' => serialize($value)));
			$this->create();
			$this->save($data, false);
		}

		return $this->writeFile();
	}

/**
 * afterFind callback
 *
 * @param array
 * @param boolean
 * @return array
 * @access public
 */
	public function afterFind($results) {
		return $this->buildFields($results);
	}

/**
 * Builds fields filled with values based on the key value pair in the table
 *
 * @param array Raw results as they come back from the database
 * @return array Virtual field array
 * @access public
 */
	public function buildFields($results = array()) {
		if (empty($results)) {
			return $results;
		}

		$newResults = array();
		foreach ($results as $key => $record) {
			if (isset($record[$this->alias]['key']) && isset($record[$this->alias]['value'])) {
				$newResults[$this->alias][$record[$this->alias]['key']] = unserialize($record[$this->alias]['value']);
			}
		}

		$defaults = array($this->alias => Configure::read($this->alias));
		return Set::merge($defaults, $newResults);
	}

/**
 * Writes a config file
 *
 * @return boolean
 * @access public
 */
	public function writeFile($file = null) {
		if (empty($file)) {
			$file = TMP . self::$configFile;
		}

		$config = $this->find('all');
		$nl = "\n";
		$content = '<?php' . $nl . '$config = ' . var_export($config[$this->alias], true) . $nl . ' ?>';
		$File = new File($file);
		return $File->write($content);
	}

/**
 * Loads a config file
 *
 * @return boolean
 * @access public
 */
	public static function loadFile($file = null) {
		if (empty($file)) {
			$file = TMP .  self::$configFile;
		}
		if (file_exists($file)) {
			unset($config);
			include($file);
			return Configure::write($config);
		}
		return false;
	}

/**
 * @todo implement Model Config::edit() method
 */
	public static function edit() {
		
	}

}
?>