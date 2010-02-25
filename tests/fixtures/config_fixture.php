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

/**
 * Records
 *
 * @var string
 * @access public
 */
	public $records = array();

}
?>