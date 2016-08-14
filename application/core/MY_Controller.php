<?php

class MY_Controller extends MX_Controller {

	// Site global layout

	public function __construct() {
		Modules::run('maintenance/index/index');
		parent::__construct();
		$this->layout->setLayout('layout/default');
	}
	
	protected function isEnv($env){
		return ENVIRONMENT === $env;
	}
	
	
	protected function addEditor() {
		$this->layout->css('assets/vendor/css/wysibb/default/wbbtheme.css');
	}
}
