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

App::uses('File', 'Utility');

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
		$config[$this->alias] = $this->arrayToKeys($config[$this->alias]);
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

		return $newResults;
	}

/**
 * Writes a config file
 *
 * @param string file with or without path, if without path its saved to APP/tmp
 * @param string keypath like Media.imageSizes.small
 * @return boolean
 * @access public
 */
	public function writeFile($file = null, $key = null) {
		if (empty($file)) {
			$file = TMP . self::$configFile;
		} else {
			if (!strstr($file, DS)) {
				$file = TMP . $file;
			}
		}

		$conditions = array();
		if (is_string($key)) {
			$conditions[$this->alias . '.key LIKE'] = $key . '%';
		}

		$config = $this->find('all', array(
			'recursive' => -1,
			'conditions' => $conditions));
		if (empty($config)) {
			$config[$this->alias] = array();
		}
		$nl = "\n";
		$content = '<?php' . $nl . '$config = ' . var_export($config[$this->alias], true) . $nl . ' ?>';
		$File = new File($file);
		return $File->write($content);
	}

/**
 * Loads a config file
 *
 * @param string $file Configuration file
 * @return boolean Success
 * @access public
 */
	public static function loadFile($file = null) {
		$fileData = self::readFile($file);

		$success = false;
		if ($fileData !== false) {
			$success = Configure::write($fileData);
		}
		return $success;
	}

/**
 * Reads the content of the config file and returns its values
 *
 * @param string $file Configuration file
 * @return array All values formatted as a multidimensional array, false if an error occured
 * @access public
 */
	public static function readFile($file = null) {
		if (is_null($file)) {
			$file = TMP .  self::$configFile;
		} else {
			if (!strstr($file, DS)) {
				$file = TMP . $file;
			}
		}

		$result = false;
		if (file_exists($file)) {
			unset($config);
			include($file);
			$result = (array) $config;
		}
		return $result;
	}

/**
 * Reads the content of the config file and returns all its values in nested arrays
 *
 * @param string $file Configuration file
 * @return array All values in nested arrays, false if there are no data
 * @access public
 */
	public static function readFileAsArray($file = null) {
		$fileData = self::readFile($file);

		$result = false;
		if ($fileData !== false) {
			$result = self::keysToArray($fileData);
		}
		return $result;
	}

/**
 * Convenience method for converting pointed key / values in nested arrays
 *
 * @param array $in Values indexed by pointed key
 * @return array Multidimensional array
 * @access public
 */
	public static function keysToArray($in = array()) {
		$result = array();

		if (!empty($in) && is_array($in)) {
			foreach($in as $key => $val) {
				if (strpos($key, '.') !== false) {
					$result = Set::insert($result, $key, $val);
				} else {
					$result[$key] = $val;
				}
			}
		}

		return $result;
	}

/**
 * Convenience method for converting nested arrays to pointed key / values, using recursivity
 *
 * @param array $in Multidimensional array to convert
 * @param string $path Base path to prepend to generated keys in this array
 * @return array All values indexed by their pointed key
 * @access public
 */
	public static function arrayToKeys($in = array(), $path = '') {
		$result = array();
		if (!empty($path) && substr($path, -1) != '.') {
			$path .= '.';
		}

		if (!empty($in) && is_array($in)) {
			foreach($in as $key => $val) {
				if (is_array($val)) {
					$result += self::arrayToKeys($val, $path . $key . '.');
				} else {
					$result[$path . $key] = $val;
				}
			}
		}

		return $result;
	}

}
?>