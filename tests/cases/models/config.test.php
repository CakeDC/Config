<?php
App::import('Model', 'Config.Config');
class ConfigTestCase extends CakeTestCase {

/**
 * 
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
 * startTest
 *
 * @return void
 * @access public
 */
	public function testConfigSavingAndReading() {
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

		debug(Configure::read('tester'));
		$this->assertEqual('burzum', Configure::read('Config.tester'));
		$this->assertEqual(array('one' => 1, 'two' => 2), Configure::read('AppConfig.nested'));
	}

}
?>