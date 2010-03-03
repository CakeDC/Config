<?php
App::import('Model', 'Config.Config');
class ConfigTestCase extends CakeTestCase {

/**
 * Fixture
 *
 * @var array
 * @access public
 */
	public $fixtures = array('plugin.config.config');

/**
 * startTest
 *
 * @return void
 * @access public
 */
	public function startTest() {
		$this->Config = ClassRegistry::init('Config.Config');
	}

/**
 * startTest
 *
 * @return void
 * @access public
 */
	public function endTest() {
		unset($this->Config);
		ClassRegistry::flush();
	}

/**
 * startTest
 *
 * @return void
 * @access public
 */
	public function testConfigInstance() {
		$this->assertTrue(is_a($this->Config, 'Config'));
	}

/**
 * testConfigSavingAndReading
 *
 * @return void
 * @access public
 */
	public function testConfigSavingAndReading() {
		Config::$configFile = 'tmp_config.php';
		$config = array(
			'Config' => array(
				'tester' => 'burzum',
				'foo' => 'bar',
				'cakephp' => '1.2',
				'nested' => array(
					'one' => 1,
					'two' => 2)));

		$this->assertTrue($this->Config->write($config));
		$this->Config->loadFile();

		$this->assertEqual('burzum', Configure::read('tester'));
		$this->assertEqual(array('one' => 1, 'two' => 2), Configure::read('nested'));

		if (is_file(TMP . 'tmp_config.php')) {
			unlink(TMP . 'tmp_config.php');
		}
	}

/**
 * testBuildFields
 *
 * @return void
 * @access public
 */
	public function testBuildFields() {
		$result = $this->Config->buildFields();
		$this->assertTrue(empty($result));
	}

/**
 * testWriteFile
 *
 * @return void
 * @access public
 */
	public function testWriteFile() {
		$testFile = sha1(rand(10000, 90000000)) . '.php';
		$this->Config->writeFile($testFile, 'Media.imageSizes.small');
		$this->assertTrue(is_file(TMP . $testFile));
		if (is_file(TMP . $testFile)) {
			unlink(TMP . $testFile);
		}
	}

}
?>