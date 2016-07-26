<?php

class MY_Controller extends MX_Controller {

	// Site global layout

	public function __construct() {
		parent::__construct();
	}
	
	protected function isEnv($env){
		return ENVIRONMENT === $env;
	}
	
	protected function addEditor()  {
		$this->layout->js('js/wysibb/jquery.wysibb.min.js');
		$this->layout->css('css/wysibb/theme/wbbtheme.css');
	}
}
