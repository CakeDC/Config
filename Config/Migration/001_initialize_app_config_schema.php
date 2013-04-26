<?php
class M3ac0d08a21fcheefbic9p4df1829f9b5 extends CakeMigration {


/**
 * Migration array
 * 
 * @var array $migration
 * @access public
 */ 
	public $migration = array(
		'up' => array(
			'create_table' => array(
				'configs' => array(
					'id' => array('type'=>'string', 'null' => false, 'length' => 36, 'key' => 'primary'),
					'namespace' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
					'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
					'foreign_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 36),
					'key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 255),
					'value' => array('type' => 'text', 'null' => true, 'default' => NULL),
					'indexes' => array(
						'PRIMARY' => array('column' => 'id', 'unique' => 1),
						'UNIQUE_KEY' => array('column' => array('key', 'namespace'), 'unique' => 1))
				),
			),
		),
		'down' => array(
			'drop_table' => array('configs')
		)
	);

/**
 * before migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @access public
 */
	public function before($direction) {
		return true;
	}

/**
 * after migration callback
 *
 * @param string $direction, up or down direction of migration process
 * @access public
 */
	public function after($direction) {
		return true;
	}

}
