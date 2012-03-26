<?php
class ConfigFixture extends CakeTestFixture {

/**
 * Name
 *
 * @var string
 * @access public
 */
	public $name = 'Config';

/**
 * Table
 *
 * @var string
 * @access public
 */
	public $table = 'configs';

/**
 * Fields
 *
 * @var string
 * @access public
 */
	public $fields = array(
		'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
		'namespace' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 64),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 64),
		'foreign_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 36),
		'key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 255),
		'value' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)));

	public function __construct() {
		$this->records = array(
			array(
				'id' => 1,
				'namespace' => null,
				'model' => null,
				'foreign_key' => null,
				'key' => 'Media.imageSizes.large.width',
				'value' => serialize('500')),
			array(
				'id' => 2,
				'namespace' => null,
				'model' => null,
				'foreign_key' => null,
				'key' => 'Media.imageSizes.large.height',
				'value' => serialize('500')),
			);
		parent::__construct();
	}
/**
 * Records
 *
 * @var string
 * @access public
 */
	public $records = array();

}
?>