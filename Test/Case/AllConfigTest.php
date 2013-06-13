<?php
/**
 * All Config plugin tests
 *
 * @package Cake.Test.Case.Controller.Component.Auth
 */
class AllConfigTest extends PHPUnit_Framework_TestSuite {

/**
 * Suite define the tests for this suite
 *
 * @return void
 */
	public static function suite() {
		$suite = new CakeTestSuite('All Config test');

		$path = CakePlugin::path('Config') . 'Test' . DS . 'Case' . DS;
		$suite->addTestDirectoryRecursive($path);

		return $suite;
	}
}
