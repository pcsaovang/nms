<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
	//private $auth;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->auth = $this->my_auth->check_frontend();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->load->model('m_members');
		$this->load->model('m_events');
		$this->load->library('session');
		//$this->load->library('license');
	}
	
	public function index()
	{
		//$lic = file_get_contents(base_url().'license.key');
		//$this->license->setServerVars($_SERVER);
		//$this->license->setDateFormat('d-m-Y');

		//$license = $this->license->validate($lic);
		
		//if($license['RESULT'] != 'OK') die("Bạn chưa đăng ký sử dụng! Vui lòng liên hệ với tác giả.");
		//userbox
		if($this->auth != NULL)
		{
			$result = $this->m_members->getallusername($this->auth['userid']);
			$data_sub['user_info'] = $result['rows'];
			
			$results = $this->m_members->getallusername();
			$data_sub['user_other'] = $results['rows'];
			
			$data_sub['turn'] = $this->getturn();
			
			$data_sub['errors'] = $this->session->flashdata('errors');
			$data['user_box'] = $this->load->view('userbox', $data_sub, true);
		}
		else
		{
			$data_sub['login'] = '';
			$data_sub['errors'] = $this->session->flashdata('errors');
			$data['user_box'] = $this->load->view('login', $data_sub, true);
		}
		
		//list service
		$result = $this->m_members->listservice();
		$data_sub['listservice'] = $result['rows'];
		$data['list_service'] = $this->load->view('service', $data_sub, true);

		//list web url icon
		$result = $this->m_members->listiconweb();
		$data['list_icon_url'] = $result['rows'];
		
		//box events
		$data_sub['events'] = '';
		$data['box_events'] = $this->load->view('events', $data_sub, true);
		
		//box google search
		$data_sub['google'] = '';
		$data['box_google'] = $this->load->view('googlesearch', $data_sub, true);

		//show $data to view layout/index
		
		$data['template'] = 'home';
		$this->load->view('layout/index', $data);
	}
	
	public function _userinfo()
	{
		if($this->auth != NULL)
		{
			$result = $this->m_members->getallusername($this->auth['userid']);
			$data['ret'] = $result['rows'];
			$results = $this->m_members->getallusername();
			$data['user_other'] = $results['rows'];
			$boxuser = $this->load->view('userbox', $data, true);
		}
		else
		{
			$data['a'] = '';
			$boxuser = $this->load->view('login', $data, true);
		}
		return $boxuser;
	}
	
	public function _list_service()
	{
		$this->db->order_by('ServiceName', 'asc');
		$query = $this->db->get('servicetb');
		$data['row'] = $query->result();
		return $this->load->view('service', $data, true);
	}
	
	public function getturn()
	{
		
		$amount = $this->m_events->get_payment($this->auth['userid']);
		$turn = 0;
		foreach($amount['rows'] as $key => $val)
		{
			$turn += $this->_cal_turn($val->amount);
		}
		return $turn;
	}
	
	public function saveturn()
	{	
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		$result = 0;
		$turn = 0;
		
		$amount = $this->m_events->get_payment($this->auth['userid']);

		if(count($amount['rows']) > 0)
		{
			foreach($amount['rows'] as $key => $val)
			{
				$turn += $this->_cal_turn($val->amount);
				$result += $this->m_events->insertevent($val->voucherid, $val->voucherdate, $this->auth['userid']);
			}
			
			$this->m_events->updateturn($this->auth['userid'], $turn);
		}
		if($result > 0) redirect('events/events');
		else redirect('home');
	}
	
	public function _cal_turn($money)
	{
		$turn = 0;
		
		if($money >= 10000 && $money < 20000) $turn = 1;
		elseif($money < 30000) $turn = 3;
		elseif($money < 40000) $turn = 5;
		elseif($money < 50000) $turn = 7;
		else $turn = floor($money / 5000);
		
		return $turn;
	}
}
?>