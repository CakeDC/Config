<?php
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
				$this->Session->setFlash(__('Configuration saved', true));
			} else {
				$this->Session->setFlash(__('Could not save configuration', true));
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
				$this->Session->setFlash(__('Configuration saved', true));
			} else {
				$this->Session->setFlash(__('Could not save configuration', true));
			}
		} else {
			$this->data['Config'] = $this->Config->readFileAsArray();
		}

		if (!empty($plugin)) {
			$this->viewPath = App::pluginPath($plugin) . 'views' . DS . 'configs' . DS;
		}

		$this->render($section);
	}

}
?>