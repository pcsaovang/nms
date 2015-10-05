<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientsys extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->model('m_clientsys');
		$this->load->library('pagination');
	}
	
	public function index($offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$limit = 20;
		$results = $this->m_clientsys->show_client($offset, $limit);
		$data['recs'] = $results['rows'];
		//print_r($data['recs']);
		$data['num_results'] = $results['num_rows'];
		
		$config = array();
		$config['base_url'] = base_url()."admin/history/clientsys";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		$data['template'] = 'admin/clientsys';
		$this->load->view('admin/layout/home', $data);
	}
}
?>