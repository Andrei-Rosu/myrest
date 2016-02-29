<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Tutorials extends MY_Controller {
	
	public function __construct($param = null) {
		parent::__construct($param);
		if(!is_connected()) {
			add_error(translate('Vous ne pouvez pas accéder à vos wikis sans vous être authentifié'));
		}
		$this->load->helper('pagination');
		$this->load->model('tutorial');
		$this->load->library('mypagination');
	}
	
	public function index() {
		$this->session->unset_userdata('user_tuto_search');
		$this->load->model('tutorial');
		$tutorials = $this->tutorial->getOwn();
		$this->layout->view('tutorials/index', array('tutorials'=>$tutorials));
	}
	
	public function search($limit='start',$page=1) {
//		$this->output->enable_profiler(TRUE);
		$tutorials = $this->doSearch($limit,$page);
		$this->layout->view('tutorials/index', array('tutorials'=>$tutorials));
	}
	
	public function see($id = null) {
		$this->layout->view('tutorials/see', array('idTuto'=>$id));
	}
	
	private function doSearch($limit='start',$page=1) {
		
		$searched = $this->input->get('search');
		
		if($searched === null) {
			$searched = $this->session->userdata('user_tuto_search');
		}
				
		$tutorials = array();
		if(!$searched) return $tutorials;
		$search = $searched;
		$searched = alias($searched);
		$this->session->set_userdata('user_tuto_search',$searched);
		
		$this->load->library('form_validation');
		$search_len = strlen($searched);
		
		if($search_len < 2 || $search_len > 250) {
			add_error(translate('La recherche est invalide'));
			return $tutorials;
		}
		
		$this->tutorial->search = $search;
		return $this->mypagination->paginate('searched-tutos', $this->tutorial, $limit, 10, $methodName = 'keySearch');
	}
}

