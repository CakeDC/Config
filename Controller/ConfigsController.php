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

class ConfigsController extends ConfigAppController {

/**
 * Name
 *
 * @var string
 * @access public
 */
	public $name = 'Configs';

/**
 * Models to load
 *
 * @var array
 * @access public
 */
	public $uses = array('Config.Config');

/**
 * Main admininstrative settings
 *
 * @return void
 * @access public
 */
	public function admin_index() {
		if (!empty($this->data)) {
			if ($this->Config->write($this->data)) {
				$this->Session->setFlash(__('Configuration saved'));
			} else {
				$this->Session->setFlash(__('Could not save configuration'));
			}
		} else {
			$this->data['Config'] = Configure::read('AppConfig');
		}
	}

/**
 * Edit existing settings section
 *
 * @return void
 * @access public
 */
	public function admin_edit($section = null) {
		$plugin = null;
		if (isset($this->params['named']['plugin'])) {
			$plugin = $this->params['named']['plugin'];
		}

		if (!empty($this->data)) {
			if ($this->Config->write($this->data)) {
				$this->Session->setFlash(__('Configuration saved'));
			} else {
				$this->Session->setFlash(__('Could not save configuration'));
			}
		} else {
			$this->data['Config'] = $this->Config->readFileAsArray();
		}

		if (!empty($plugin)) {
			$this->viewPath = CakePlugin::path($plugin) . 'View' . DS . 'configs' . DS;
		}

		$this->render($section);
	}

}