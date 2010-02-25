<?php
class M3ac0d08a21fcheefbic9p4df1829f9b5 extends CakeMigration {
/**
 * Migration description
 *
 * @var string
 * @access public
 */
	public $description = '';

/**
 * Dependency array. Define what minimum version required for other part of db schema
 *
 * Migration defined like 'app.m49ad0b91bd4c4bd482cc1de43461d00a' or 'plugin.PluginName.m49ad0d8518904f518db21bb43461d00a'
 * 
 * @var array $dependendOf
 * @access public
 */
	public $dependendOf = array();

/**
 * Shell object
 *
 * @var MigrationInterface
 * @access public
 */
	public $Shell;

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
					'namespace' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 64),
					'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 64),
					'foreign_key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 36),
					'key' => array('type' => 'string', 'null' => true, 'default' => NULL, 'lenght' => 255),
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
?>