<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tutorials extends MY_Controller {
	
	public function __construct($param = null) {
		parent::__construct($param);
		if(!is_connected()) {
			add_error(translate('Vous ne pouvez pas accéder à vos wikis sans vous être authentifié'));
			redirect('home');
		}
		$this->load->helper('pagination');
		$this->load->model('tutorial');
		$this->load->library('mypagination');
	}
	
	public function index($limit='start',$page=0) {
		redirect('tutorials/all');
	}
	
	public function all($limit='start',$page=0) {
		$this->session->unset_userdata('user_tuto_search');
		$this->load->model('tutorial');
		$tutorials = $this->mypagination->paginate('searched-tutos', $this->tutorial, $page, 10, $methodName = 'getOwn');
		$this->layout->view('tutorials/index', array('tutorials'=>$tutorials));
	}


	public function search($limit='start',$page=0) {
//		$this->output->enable_profiler(TRUE);
		$tutorials = $this->doSearch($limit,$page);
		$this->layout->view('tutorials/index', array('tutorials'=>$tutorials));
	}
	
	public function see($id = null) {
		$this->layout->css('assets/vendor/css/highlightjs/styles/atelier-forest-light.css');
		$this->layout->js('assets/vendor/js/highlightjs/highlight.pack.js');
		$this->layout->jscript('hljs.initHighlightingOnLoad();');
		$this->layout->view('tutorials/see', array('idTuto'=>$id));
	}
	
	private function doSearch($limit='start',$page=0) {
		
		$searched = $this->input->get('search');
		
		if($searched === null) {
			$searched = $this->session->userdata('user_tuto_search');
		}
				
		$tutorials = array();
		if(!$searched){
			add_error(translate('Vous devez entrer un ou plusieurs mots dans la zone de recherche.'));
			return $tutorials;
		}
		$search = explode(' ', $searched);
		$search = array_map('alias', $search);
		$searched = implode(' ', $search);
		$this->session->set_userdata('user_tuto_search',$searched);
		
		$this->load->library('form_validation');
		$searchLen = strlen($searched);
		
		if($searchLen < 2 || $searchLen > 250) {
			add_error(translate('La recherche est invalide'));
			return $tutorials;
		}
		
		$this->tutorial->search = $search;
		return $this->mypagination->paginate('searched-tutos', $this->tutorial, $page, 10, $methodName = 'keySearch');
	}
	
	public function add() {
		$this->addEditor();
		$this->layout->view('tutorials/edit');
	}
	
	public function edit($id) {
		$this->addEditor();
		$tutorial = $this->tutorial->getId($id);
		if(!$tutorial){
			redirect('tutorials/all');
		}
		$this->layout->view('tutorials/edit', array('tutorial'=>$tutorial,'idTuto'=>$id));
	}
	
	public function delete($id) {
		Modules::run('blog/see/delete', $id, 'tutorial');
		add_success(translate('Le tutoriel a bien été supprimé"'));
		redirect('tutorials/all');
	}
}

