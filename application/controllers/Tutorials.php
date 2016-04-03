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
		$this->layout->view('tutorials/see', array('idTuto'=>$id));
	}
	
	private function doSearch($limit='start',$page=0) {
		
		$searched = $this->input->get('search');
		
		if($searched === null) {
			$searched = $this->session->userdata('user_tuto_search');
		}
				
		$tutorials = array();
		if(!$searched) return $tutorials;
		$search = explode(' ', $searched);
		$search = array_map('alias', $search);
		$searched = implode(' ', $search);
		$this->session->set_userdata('user_tuto_search',$searched);
		
		$this->load->library('form_validation');
		$search_len = strlen($searched);
		
		if($search_len < 2 || $search_len > 250) {
			add_error(translate('La recherche est invalide'));
			return $tutorials;
		}
		
		$this->tutorial->search = $search;
		return $this->mypagination->paginate('searched-tutos', $this->tutorial, $page, 10, $methodName = 'keySearch');
	}
	
	private function addEditor()  {
		$this->layout->js('js/wysibb/jquery.wysibb.min.js');
		$this->layout->css('css/wysibb/theme/wbbtheme.css');
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

