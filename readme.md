# Config Plugin for CakePHP #

for cake 2.X

## Plugin Purpose ##

Plugin is supposed to be used as site configuration storage.
Plugin provide db storage for site configuration.

Plugin should loaded next way: CakePlugin::load('Config', array('bootstrap' => true));
Plugin need to load with bootstrap file, that will loads configuration data into the memory.

### Edit and save configuration ###

Lets define simplest form with one setting parameter where we will store default site language.
```php
<?php
	echo $this->Form->create('Config', array('url' => $this->here));

	echo $this->Form->input('Config.Default.language', array(
		'label' => __('Default language', true)));

	echo $this->Form->end(__('Save these settings', true));
```

Please mention that in te edit form need to use value name with "Config." preffx.

Best way to have new setting pages for plugin separated from Configs plugin is use cakephp convantion about plugin views overloading.  So 'default.ctp' edit view page possible to place in app/View/Plugin/Config/Configs folder. After that default settings will available using /admin/config/configs/edit/default url.

## Configuration usage ###

Configuration values accessible using Configure class. So if you have value Default.language stored in database you will able to read it using Configure::read('Default.language') call.

## Tracking Configuration Changes ##

Config model dispatches CakeEvent named 'Config.Config.change' in its write() method, if any of key/value pairs was added or changed, and puts associative arrays with previous and new key/value pairs to its data property. Example usage with global event manager:
* AppController
```php
<?php
	App::uses('Post', 'Model');

	class AppController extends Controller {

		public function beforeFilter() {
			CakeEventManager::instance()->attach('Post::changeSettings', 'Config.Config.change', array('passParams' => true));
		}
	}
```
* Post model
```php
<?php
	App::uses('AppModel', 'Model');

	class Post extends AppModel {

		public static function changeSettings($old, $new) {
			// do your magic here
		}
	}
```

## Requirements ##

* PHP version: PHP 5.2+
* CakePHP version: Cakephp 2.0

## License ##

Copyright 2009-2012, [Cake Development Corporation](http://cakedc.com)

Licensed under [The MIT License](http://www.opensource.org/licenses/mit-license.php)<br/>
Redistributions of files must retain the above copyright notice.

## Branch strategy ##

[![Build Status](https://travis-ci.org/CakeDC/Config.png?branch=master)](https://travis-ci.org/CakeDC/Config) The master branch holds the STABLE latest version of the plugin.

[![Build Status](https://travis-ci.org/CakeDC/Config.png?branch=develop)](https://travis-ci.org/CakeDC/Config) Develop branch is UNSTABLE and used to test new features before releasing them.

Previous maintenance versions are named after the CakePHP compatible version, for example, branch 1.3 is the maintenance version compatible with CakePHP 1.3.
All versions are updated with security patches.

## Contributing to this Plugin ##

Please feel free to contribute to the plugin with new issues, requests, unit tests and code fixes or new features. If you want to contribute some code, create a feature branch from develop, and send us your pull request. Unit tests for new features and issues detected are mandatory to keep quality high. 

## Copyright ###

Copyright 2009-2012<br/>
[Cake Development Corporation](http://cakedc.com)<br/>
1785 E. Sahara Avenue, Suite 490-423<br/>
Las Vegas, Nevada 89104<br/>
http://cakedc.com<br/>
