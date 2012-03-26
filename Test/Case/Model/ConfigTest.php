<?php
App::uses('Config', 'Config.Model');

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

		$this->assertNull(Configure::read('tester'));
		$result = $this->Config->readFile();
		$expected = array(
			'Media.imageSizes.large.width' => 500,
			'Media.imageSizes.large.height' => 500,
			'tester' => 'burzum',
			'foo' => 'bar',
			'cakephp' => '1.2',
			'nested.one' => 1,
			'nested.two' => 2);
		$this->assertEqual($result, $expected);

		$this->assertNull(Configure::read('tester'));
		$result = $this->Config->readFileAsArray();
		$expected = Set::merge(
			array(
				'Media' => array(
					'imageSizes' => array(
						'large' => array(
							'width' => 500,
							'height' => 500)))),
			$config['Config']);
		$this->assertEqual($result, $expected);

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
 * Test write method
 *
 * @return void
 * @access public
 */
	public function testWrite() {
		$testFile = 'tmp_config.php';
		Config::$configFile = $testFile;

		$f = new Exception('f');
		$data = array('Config' => array(
			'a' => array(
				'b' => 'c',
				'd'),
			'e' => $f,
			'g' => array(
				'h' => array(
					'i'))));
		$this->assertTrue($this->Config->write($data));
		$this->assertTrue(is_file(TMP . $testFile));

		$result = $this->Config->find('all');
		$expected = array(
			'Media.imageSizes.large.width' => 500,
			'Media.imageSizes.large.height' => 500,
			'a.b' => 'c',
			'a.0' => 'd',
			'e' => $f,
			'g.h.0' => 'i');
		$this->assertEqual(array_keys($result['Config']), array_keys($expected));
		$this->assertIsA($result['Config']['e'], 'Exception');
		unset($expected['e']);
		foreach($expected as $key => $value) {
			$this->assertEqual($result['Config'][$key], $expected[$key]);
		}

		if (is_file(TMP . $testFile)) {
			unlink(TMP . $testFile);
		}
	}

/**
 * testWriteFile
 *
 * @return void
 * @access public
 */
	public function testWriteFile() {
		$testFile = sha1(rand(10000, 90000000)) . '.php';
		$this->Config->writeFile($testFile, 'Media.imageSizes.large');
		$this->assertTrue(is_file(TMP . $testFile));
		if (is_file(TMP . $testFile)) {
			unlink(TMP . $testFile);
		}
	}

/**
 * testWriteFile when no config entries in the database match the key
 * A file must be written with empty data inside
 *
 * @return void
 * @access public
 */
	public function testWriteFileNoConfig() {
		$testFile = sha1(rand(10000, 90000000)) . '.php';
		$this->Config->writeFile($testFile, 'Key.Not.Valid');
		$this->assertTrue(is_file(TMP . $testFile));
		if (is_file(TMP . $testFile)) {
			$generatedContent = file_get_contents(TMP . $testFile);
			$expectedTokens = array(
				array(T_OPEN_TAG, '<?php'),
				array(T_VARIABLE, '$config'), '=', array(T_ARRAY, 'array'), '(', ')',
				array(T_CLOSE_TAG, '?>'));
			$tokens = token_get_all(file_get_contents(TMP . $testFile));
			$cleanedTokens = array();
			foreach($tokens as $token) {
				if (is_string($token)) {
					$cleanedTokens[] = $token;
				} elseif ($token[0] !== T_WHITESPACE) {
					$cleanedTokens[] = array($token[0], trim($token[1]));
				}
			}
			$this->assertIdentical($expectedTokens, $cleanedTokens);
			unlink(TMP . $testFile);
		}
	}

/**
 * Test keysToArray method
 *
 * @return void
 * @access public
 */
	public function testKeysToArray() {
		$data = array(
			'test' => 'result',
			'foo' => 'bar');

		$result = $this->Config->keysToArray($data);
		$expected = $data;
		$this->assertEqual($result, $expected);

		$data = array(
			'test' => 'result',
			'foo.0' => 'a',
			'foo.1' => 'b',
			'foo.c' => 'd');
		$result = $this->Config->keysToArray($data);
		$expected = array(
			'test' => 'result',
			'foo' => array('a', 'b', 'c' => 'd'));
		$this->assertEqual($result, $expected);
	}

/**
 * Test arrayToKeys method
 *
 * @return void
 * @access public
 */
	public function testArrayToKeys() {
		$data = array(
			'test' => 'result',
			'foo' => 'bar');

		$result = $this->Config->arrayToKeys($data);
		$expected = $data;
		$this->assertEqual($result, $expected);

		$result = $this->Config->arrayToKeys($data, 'foo');
		$expected = array(
			'foo.test' => 'result',
			'foo.foo' => 'bar');
		$this->assertEqual($result, $expected);

		$data['foo'] = array('a', 'b', 'c' => 'd');
		$result = $this->Config->arrayToKeys($data);
		$expected = array(
			'test' => 'result',
			'foo.0' => 'a',
			'foo.1' => 'b',
			'foo.c' => 'd');
		$this->assertEqual($result, $expected);
	}

}
?>