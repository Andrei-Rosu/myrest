<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tutorials extends BO_Controller {

	public function index() {
		$this->all();
	}
	
	public function all() {
		$this->layout->view('bo/tutorials/all');
	}
	
	public function newOne() {
		$this->layout->view('bo/tutorials/new');
	}
	
	public function delete($id = null) {
		Modules::run('blog/see/delete', $id);
		redirect('bo/tutorials/all');
	}
	
	public function see($id = null) {
		$this->layout->view('bo/tutorials/see', array('idTuto'=>$id));
	}
	
	public function edit($id = null) {
		$this->layout->view('bo/tutorials/edit', array('idTuto'=>$id));
	}
}

