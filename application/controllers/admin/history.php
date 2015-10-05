<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class History extends CI_Controller
{	
	protected $self = '';
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->model('m_history');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->load->library('pagination');
	}
	
	public function index()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$this->payment();
	}
	
	public function payment($query_string = '', $sort_by = 'vouchertime', $sort_order = 'desc', $offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$date_default = date('Y-m-d');
		
		if(empty($query_string)) $query_string = strtotime($date_default." 00:00:00")."-".strtotime($date_default." 23:59:59")."-2-all";
			
		$limit = 20;
		$data['fields'] = array(
			'firstname'		=>	'Tên',
			'voucherdate'	=>	'Ngày nạp',
			'vouchertime'	=>	'Giờ nạp',
			'amount'		=>	'Số tiền',
			'staffid'		=>	'Nhân viên',
			'note'			=>	'Ghi chú'
		);
		
		$results = $this->m_history->payment_search($query_string, $limit, $offset, $sort_by, $sort_order);
		$staff = $this->m_history->get_staff();

		$data['staff'] = $staff['rows'];
		$data['recs'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['total'] = $results['total'];
		$data['query_string'] = $query_string;
		$data['string_txt'] = explode('-', $query_string);
		
		if(isset($this->self) && !empty($this->self)) $data['self'] = $this->self;
		else $data['self'] = '';
		
		$config = array();
		$config['base_url'] = base_url()."admin/history/payment/$query_string/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$data['template'] = 'admin/payment';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function service($query_string = '', $offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$date_default = date('Y-m-d');
		if(empty($query_string)) $query_string = strtotime($date_default)."-".strtotime($date_default)."-2";
		$limit = 20;
		$results = $this->m_history->service_search($query_string, $offset, $limit);
		$staff = $this->m_history->get_staff();
		
		$data['recs'] = $results['rows'];
		$data['staff'] = $staff['rows'];
		
		$data['num_results'] = $results['num_rows'];
		$data['string_txt'] = explode('-', $query_string);

		if(isset($this->self) && !empty($this->self)) $data['self'] = $this->self;
		else $data['self'] = '';
		
		$config = array();
		$config['base_url'] = base_url()."admin/history/service/$query_string";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		
		$data['template'] = 'admin/service';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function weburl($query_string = '', $offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$date_default = date('Y-m-d');
		if(empty($query_string)) $query_string = strtotime($date_default)."-".strtotime($date_default);
		$limit = 20;
		
		$results = $this->m_history->weburl_search($query_string, $offset, $limit);
		$data['recs'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['string_txt'] = explode('-', $query_string);
		
		if(isset($this->self) && !empty($this->self)) $data['self'] = $this->self;
		else $data['self'] = '';
		
		$config = array();
		$config['base_url'] = base_url()."admin/history/weburl/$query_string";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'admin/weburl';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function serverlog($offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$limit = 20;
		$results = $this->m_history->serverlog_search($offset, $limit);
		$data['recs'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		//print_r($data['recs']);
		$config = array();
		$config['base_url'] = base_url()."admin/history/serverlog";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 4;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'admin/serverlog';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function systemlog($query_string = '' , $offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$date_default = date('Y-m-d');
		if(empty($query_string)) $query_string = strtotime($date_default)."-".strtotime($date_default);
		$limit = 20;
		$results = $this->m_history->systemlog_search($query_string, $offset, $limit);
		
		$data['recs'] = $results['rows'];
		$data['num_results'] = $results['num_rows'];
		$data['string_txt'] = explode('-', $query_string);

		if(isset($this->self) && !empty($this->self)) $data['self'] = $this->self;
		else $data['self'] = '';
		
		$config = array();
		$config['base_url'] = base_url()."admin/history/systemlog/$query_string";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 5;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['template'] = 'admin/systemlog';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function search_payment()
	{
		if($this->input->post())
		{
			$date_default = date('Y-m-d');
			
			if($this->input->post('datefrom')) $df = date_format(date_create($this->input->post('datefrom')), 'Y-m-d');
			else $df = $date_default;
			
			if($this->input->post('timefrom')) $tf = $this->input->post('timefrom');
			else $tf = '00:00:00';
			
			if($this->input->post('dateto')) $dt = date_format(date_create($this->input->post('dateto')), 'Y-m-d');
			else $dt = $date_default;
			
			if($this->input->post('timeto')) $tt = $this->input->post('timeto');
			else $tt = '23:59:59';
			
			if($this->input->post('staff')) $staff = $this->input->post('staff');
			else $staff = 2;
			
			if($this->input->post('firstname')) $firstname = $this->input->post('firstname');
			else $firstname = 'all';
			
			$query_string = strtotime($df." ".$tf)."-".strtotime($dt." ".$tt)."-".$staff."-".$firstname;
			
			if($this->input->post('filter'))
			{	
				redirect("admin/history/payment/$query_string");
			}
			if($this->input->post('action'))
			{
				$trans = $this->m_history->trans_payment($query_string);
				if($trans != 0) $data['message'] = 'Đã xử lý '.$trans.' mẩu tin.';
				else $data['message'] = 'Có lổi xẩy ra!';
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->payment($query_string);
			}
		}
	}
	
	public function weburl_search()
	{
		if($this->input->post())
		{
			$date_default = date('Y-m-d');
			
			if($this->input->post('datefrom')) $df = date_format(date_create($this->input->post('datefrom')), 'Y-m-d');
			else $df = $date_default;
			
			if($this->input->post('dateto')) $dt = date_format(date_create($this->input->post('dateto')), 'Y-m-d');
			else $dt = $date_default;
			
			$query_string = strtotime($df)."-".strtotime($dt);
			
			if($this->input->post('filter'))
			{	
				redirect("admin/history/weburl/$query_string");
			}
			
			if($this->input->post('action'))
			{
				$trans = $this->m_history->trans_weburl($query_string);
				
				if($trans != 0) $data['message'] = 'Đã xử lý '.$trans.' mẩu tin.';
				else $data['message'] = 'Có lổi xẩy ra!';
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->weburl($query_string);
			}
		}
	}
	
	public function service_search()
	{
		if($this->input->post())
		{
			$date_default = date('Y-m-d');
			
			if($this->input->post('datefrom')) $df = date_format(date_create($this->input->post('datefrom')), 'Y-m-d');
			else $df = $date_default;
			
			if($this->input->post('dateto')) $dt = date_format(date_create($this->input->post('dateto')), 'Y-m-d');
			else $dt = $date_default;
			
			if($this->input->post('staff')) $staff = $this->input->post('staff');
			else $staff = 2;
			
			$query_string = strtotime($df)."-".strtotime($dt)."-".$staff;
			
			if($this->input->post('filter'))
			{	
				redirect("admin/history/service/$query_string");
			}
		}
	}	
	public function systemlog_search()
	{
		if($this->input->post())
		{
			$date_default = date('Y-m-d');
			
			if($this->input->post('datefrom')) $df = date_format(date_create($this->input->post('datefrom')), 'Y-m-d');
			else $df = $date_default;
			
			if($this->input->post('dateto')) $dt = date_format(date_create($this->input->post('dateto')), 'Y-m-d');
			else $dt = $date_default;
			
			$query_string = strtotime($df)."-".strtotime($dt);
			
			if($this->input->post('filter'))
			{	
				redirect("admin/history/systemlog/$query_string");
			}
			if($this->input->post('action'))
			{
				$trans = $this->m_history->trans_systemlog($query_string);
				
				if($trans != 0) $data['message'] = 'Đã xử lý '.$trans.' mẩu tin.';
				else $data['message'] = 'Có lổi xẩy ra!';
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->systemlog($query_string);
			}
		}
	}
}
?>