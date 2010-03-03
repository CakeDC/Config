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
 * 
 */
	public function admin_edit($section = null) {
		$plugin = null;
		if (isset($this->params['named']['plugin'])) {
			$plugin = $this->params['named']['plugin'];
		}

		if ($this->Config->edit($this->data)) {
			$this->Session->setFlash(__('Config saved', true));
		}

		if (!empty($plugin)) {
			$this->viewPath = APP . $plugin . DS . 'views' . DS . 'configs' . DS;
		} else {
			$this->viewPath = VIEWS . 'configs' . DS;
		}

		$this->render($section);
	}

}
?>