<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller
{
	protected $self = '';
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->model('m_members');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	public function index()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$this->display();
	}
	
	public function display($query_string = '', $sort_by = 'firstname', $sort_order = 'asc', $offset = 0)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$limit = 20;
		$data['fields'] = array(
			'userid'		=>	'Mã',
			'firstname'		=>	'Tên đăng nhập',
			'debit'			=>	'Nợ',
			'moneypaid'		=>	'Tiền đã nạp',
			'remainmoney'	=>	'Tiền còn',
			'recorddate'	=>	'Ngày tạo',
			'lastlogindate'	=>	'Đăng nhập lần cuối',
			'usertype'		=>	'Nhóm',
			'active'		=>	'Trạng thái'
		);
		
		(!strlen($query_string) ? $query_string = "all" : $query_string);
		$data['query_string'] = $query_string;
		
		$results = $this->m_members->search($query_string, $limit, $offset, $sort_by, $sort_order);

		$data['recs'] = $results['rows'];
		
		$data['num_results'] = $results['num_rows'];
		$data['total_debit'] = $results['totaldebit'];
		$data['total_money'] = $results['totalmoney'];
		$data['offset'] = $offset;
		$data['limit'] = $limit + $offset;
		
		//pagination
		$this->load->library('pagination');
		
		$config = array();
		$config['base_url'] = base_url()."admin/members/display/$query_string/$sort_by/$sort_order";
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$config['use_page_numbers'] = false;
		
		$this->pagination->initialize($config);
		
		$data['pagination'] = $this->pagination->create_links();
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		$data['template'] = 'admin/members';

		$this->load->view('admin/layout/home', $data);
	}
	
	//Tim kiem hoi vien
	public function search()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$query_string = $this->input->post('membername');
		redirect("admin/members/display/$query_string");
	}
	
	public function edituser($userid)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$results = $this->m_members->getinfouser($userid);
		if(!empty($results))
		{
			$results_all = $this->m_members->getallusername();
			$data['recsall'] = $results_all['rows'];
			$data['recs'] = $results['rows'];
			$data['price'] = $results['price'];
		}
		if(isset($this->self) && !empty($this->self)) $data['self'] = $this->self;
		else $data['self'] = '';
		
		$data['userid'] = $userid;
		$data['template'] = 'admin/edituser';
		$this->load->view('admin/layout/home', isset($data) ? $data : NULL);
	}
	
	public function saveuser($userid)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$_post = $this->input->post('data');
		if($this->input->post('saveedit'))
		{
			$this->form_validation->set_rules('data[firstname]', 'tên', 'trim|required|regex_match[/^([a-z0-9_])+$/i]');
			$this->form_validation->set_rules('data[pass]', 'mật khẩu', 'trim|required');
			
			if($this->form_validation->run() == true)
			{
				$results = $this->m_members->getuserinfomoney($userid);
				$p = $this->m_members->passdecode($_post['pass']);
				
				if($results['rows']->password != $_post['pass']) $new_pass = $p->pw;
				else $new_pass = $_post['pass'];
				
				$arr_data = array(
					'firstname'		=> $_post['firstname'],
					'middlename'	=> addslashes($_post['middlename']),
					'lastname'		=> addslashes($_post['lastname']),
					'birthdate'		=> $_post['birthdate'],
					'active'		=> (isset($_post['active']) ? 1 : 0),
					'phone'			=> $_post['phone'],
					'email'			=> $_post['email'],
					'address'		=> $_post['address'],
					'city'			=> $_post['city'],
					'state'			=> $_post['state'],
					'id'			=> $_post['id'],
					'password'		=> $new_pass,
					'expirydate'	=> $_post['expirydate']
				);
				if($this->m_members->saveuserinfo($userid, $arr_data)) $data['message'] = '<i>Cập nhật thành công.</i>';
				else $data['message'] = '';
				$this->self = $this->load->view('admin/saveuser', $data, true);

				$this->edituser($userid);
			}
			else $this->edituser($userid);
		}
		elseif($this->input->post('creditlimit'))
		{
			$this->form_validation->set_rules('data[creditlimitadd]', 'số tiền', 'trim|numeric|integer|max_length[7]|greater_than[0]');
			if($this->form_validation->run() == true)
			{
				$arr_update_creditlimitadd = array(
					'CreditLimit'	=>	$_post['creditlimitadd']
				);
				
				if($this->m_members->saveuserinfo($userid, $arr_update_creditlimitadd)) $data['message'] = 'Giới hạn nợ thành công.';
				else $data['message'] = 'Có lỗi xẩy ra.';
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->edituser($userid);
			}
			else $this->edituser($userid);
			
		}
		elseif($this->input->post('debitmoney'))
		{
			$this->form_validation->set_rules('data[debitadd]', 'số tiền', 'trim|numeric|integer|max_length[6]|greater_than[0]|callback_checkdebit['.$userid.']');
			if($this->form_validation->run() == true)
			{
				$remainmoney = $this->m_members->getprice($userid, $_post['debitadd']);
				$results_all = $this->m_members->getallusername($userid);
				
				$arr_update_debit = array(
					'Debit'			=>	$results_all['rows'][0]->debit + $_post['debitadd'],
					'MoneyPaid'		=>	$results_all['rows'][0]->moneypaid + $_post['debitadd'],
					'RemainTime'	=>	$remainmoney,
					'RemainMoney'	=>	$results_all['rows'][0]->remainmoney + $_post['debitadd']
				);
				
				$arr_data_report = array(
					'UserId'		=>	$userid,
					'VoucherNo'		=>	"",
					'VoucherDate'	=>	date('Y-m-d', time()),
					'VoucherTime'	=>	date('H:i:s', time()),
					'Amount'		=>	$_post['debitadd'],
					'AutoAmount'	=>	$_post['debitadd'],
					'TimeTotal'		=>	$remainmoney,
					'Active'		=>	1,
					'UserNote'		=>	"",
					'Note'			=>	"Số tiền mượn",
					'ServicePaid'	=>	1,
					'StaffId'		=>	2,
					'PaymentType'	=>	6,
					'PaymentWaitId'	=>	0
				);
				
				if($this->m_members->savereport($arr_data_report) && $this->m_members->saveuserinfo($userid, $arr_update_debit))
				{
					$data['message'] = '<i>Đã cho </i> <b>'.$results_all['rows'][0]->firstname.' nợ '.number_format($_post['debitadd']).'</b> <i>đồng.</i>';
				}
				else
				{
					$data['message'] = 'Có lỗi xẩy ra.';
				}
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->edituser($userid);
			}
			else $this->edituser($userid);
		}
		elseif($this->input->post('removedebit'))
		{
			$this->form_validation->set_rules('data[debitadd]', 'số tiền', 'trim|numeric|integer|max_length[6]|greater_than[0]|callback_checkremovedebit['.$userid.']');
			if($this->form_validation->run() == true)
			{
				$results_all = $this->m_members->getallusername($userid);
				$arr_update_debit = array(
					'Debit'		=>	$results_all['rows'][0]->debit - $_post['debitadd']
				);
				
				$arr_data_report = array(
					'UserId'		=>	$userid,
					'VoucherDate'	=>	date('Y-m-d', time()),
					'VoucherTime'	=>	date('H:i:s', time()),
					'Amount'		=>	$_post['debitadd'],
					'AutoAmount'	=>	$_post['debitadd'],
					'TimeTotal'		=>	0,
					'Active'		=>	1,
					'UserNote'		=>	"",
					'Note'			=>	"Trả tiền",
					'ServicePaid'	=>	1,
					'StaffId'		=>	2,
					'PaymentType'	=>	5,
					'PaymentWaitId'	=>	0
				);
				
				if($this->m_members->savereport($arr_data_report) && $this->m_members->saveuserinfo($userid, $arr_update_debit))
				{
					$data['message'] = '<b>'.$results_all['rows'][0]->firstname.'</b> <i>trả nợ</i> <b>'.number_format($_post['debitadd']).'</b> <i>đồng.</i>';
				}
				else
				{
					$data['message'] = 'Có lỗi xẩy ra.';
				}
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->edituser($userid);
			}
			else $this->edituser($userid);
		}
		elseif($this->input->post('addmoney'))
		{
			$this->form_validation->set_rules('data[remainmoneyadd]', 'số tiền', 'trim|numeric|integer|max_length[6]|greater_than[0]');
			if($this->form_validation->run() == true)
			{
				$remainmoney = $this->m_members->getprice($userid, $_post['remainmoneyadd']);
				$results_all = $this->m_members->getallusername($userid);
				
				$arr_update_money = array(
					'MoneyPaid'		=>	$results_all['rows'][0]->moneypaid + $_post['remainmoneyadd'],
					'RemainTime'	=>	$remainmoney,
					'RemainMoney'	=>	$results_all['rows'][0]->remainmoney + $_post['remainmoneyadd']
				);
				
				$arr_data_report = array(
					'UserId'		=>	$userid,
					'VoucherNo'		=>	"",
					'VoucherDate'	=>	date('Y-m-d', time()),
					'VoucherTime'	=>	date('H:i:s', time()),
					'Amount'		=>	$_post['remainmoneyadd'],
					'AutoAmount'	=>	$_post['remainmoneyadd'],
					'TimeTotal'		=>	$remainmoney,
					'Active'		=>	1,
					'UserNote'		=>	"",
					'Note'			=>	"Thời gian phí",
					'ServicePaid'	=>	1,
					'StaffId'		=>	2,
					'MachineName'	=>	"",
					'PaymentType'	=>	4,
					'PaymentWaitId'	=>	0
				);
				
				if($this->m_members->savereport($arr_data_report) && $this->m_members->saveuserinfo($userid, $arr_update_money))
				{
					$data['message'] = '<i>Nạp tiền thành công cho</i> <b>'.$results_all['rows'][0]->firstname.' '.number_format($_post['remainmoneyadd']).'</b> <i>đồng.</i>';
				}
				else
				{
					$data['message'] = 'Có lỗi xẩy ra.';
				}
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->edituser($userid);
			}
			else $this->edituser($userid);
		}
		elseif($this->input->post('freemoney'))
		{
			$this->form_validation->set_rules('data[freemoneyadd]', 'số tiền', 'trim|numeric|integer|max_length[6]|greater_than[0]');
			if($this->form_validation->run() == true)
			{
				$remainmoney = $this->m_members->getprice($userid, $_post['freemoneyadd']);
				$results_all = $this->m_members->getallusername($userid);
				$arr_update_money_free = array(
					'RemainTime'	=>	$remainmoney,
					'RemainMoney'	=>	$results_all['rows'][0]->remainmoney + $_post['freemoneyadd'],
					'FreeMoney'		=>	$results_all['rows'][0]->freemoney + $_post['freemoneyadd']
				);
				
				$arr_data_report = array(
					'UserId'		=>	$userid,
					'VoucherNo'		=>	"",
					'VoucherDate'	=>	date('Y-m-d', time()),
					'VoucherTime'	=>	date('H:i:s', time()),
					'Amount'		=>	$_post['freemoneyadd'],
					'AutoAmount'	=>	$_post['freemoneyadd'],
					'TimeTotal'		=>	$remainmoney,
					'Active'		=>	1,
					'UserNote'		=>	"",
					'Note'			=>	'Quản lý ADMIN tặng tiền: '.number_format($_post['freemoneyadd']).' đồng',
					'ServicePaid'	=>	1,
					'StaffId'		=>	2,
					'PaymentType'	=>	11,
					'PaymentWaitId'	=>	0
				);
				
				if($this->m_members->savereport($arr_data_report) && $this->m_members->saveuserinfo($userid, $arr_update_money_free))
				{
					$data['message'] = '<i>Tặng tiền thành công cho</i> <b>'.$results_all['rows'][0]->firstname.' '.number_format($_post['freemoneyadd']).'</b> <i>đồng.</i>';
				}
				else
				{
					$data['message'] = 'Có lỗi xẩy ra.';
				}
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->edituser($userid);
			}
			else $this->edituser($userid);
		}
		elseif($this->input->post('transfermoney'))
		{
			$results = $this->m_members->getuserinfomoney($userid);
			$remainmoney = $results['rows']->remainmoney;
			$this->form_validation->set_rules('data[moneytransferto]', 'số tiền', 'trim|numeric|integer|max_length[5]|greater_than[0]|callback_checktransfermoney['.$remainmoney.']');
			
			if($this->form_validation->run() == true)
			{
				$results_all = $this->m_members->getallusername($_post['useridto']);
				
				$usernameto = $results_all['rows'][0]->firstname;
				
				$remaintimefrom = $this->m_members->getprice($userid, ($remainmoney - $_post['moneytransferto']));
				$remaintimeto = $this->m_members->getprice($_post['useridto'], ($results_all['rows'][0]->remainmoney + $_post['moneytransferto']));
				
				$arr_data_report = array(
					'UserId'		=>	$userid,
					'VoucherNo'		=>	"",
					'VoucherDate'	=>	date('Y-m-d', time()),
					'VoucherTime'	=>	date('H:i:s', time()),
					'Amount'		=>	(-$_post['moneytransferto']),
					'AutoAmount'	=>	(-$_post['moneytransferto']),
					'TimeTotal'		=>	0,
					'Active'		=>	1,
					'UserNote'		=>	"",
					'Note'			=>	"Số tiền chuyển đến hội viên ".$usernameto." là ".$_post['moneytransferto']." đồng",
					'ServicePaid'	=>	1,
					'StaffId'		=>	2,
					'MachineName'	=>	"",
					'PaymentType'	=>	8,
					'PaymentWaitId'	=>	0
				);
				$arr_data_report1 = array(
					'UserId'		=>	$_post['useridto'],
					'VoucherNo'		=>	"",
					'VoucherDate'	=>	date('Y-m-d', time()),
					'VoucherTime'	=>	date('H:i:s', time()),
					'Amount'		=>	$_post['moneytransferto'],
					'AutoAmount'	=>	$_post['moneytransferto'],
					'TimeTotal'		=>	0,
					'Active'		=>	1,
					'UserNote'		=>	"",
					'Note'			=>	"Số tiền chuyển từ hội viên ".$_post['firstname']." là ".$_post['moneytransferto']." đồng",
					'ServicePaid'	=>	1,
					'StaffId'		=>	2,
					'MachineName'	=>	"",
					'PaymentType'	=>	8,
					'PaymentWaitId'	=>	0
				);
				$arr_update_transfer = array(
				//	'userid'		=>	$userid,
					'RemainMoney'	=>	($remainmoney - $_post['moneytransferto']),
					'MoneyTransfer'	=>	(($results['rows']->moneytransfer) + $_post['moneytransferto']),
					'RemainTime'	=>	$remaintimefrom
				);
				
				$arr_update_transfer1 = array(
				//	'userid'		=>	$_post['useridto'],
					'RemainMoney'	=>	(($results_all['rows'][0]->remainmoney) + $_post['moneytransferto']),
					'MoneyPaid'		=>	(($results_all['rows'][0]->moneypaid) + $_post['moneytransferto']),
					'RemainTime'	=>	$remaintimeto
				);
				
				if($this->m_members->savereport($arr_data_report) &&
					$this->m_members->savereport($arr_data_report1) &&
					$this->m_members->saveuserinfo($userid, $arr_update_transfer) &&
					$this->m_members->saveuserinfo($_post['useridto'], $arr_update_transfer1))
				{
					$data['message'] = '<i>Đã chuyển tiền từ</i> <b>'.$_post['firstname'].'</b> <i>sang</i> <b>'.$usernameto.'</b> <i>là</i> <b>'.number_format($_post['moneytransferto']). '</b> <i>đồng</i>';
				}
				else
				{
					$data['message'] = "Có lỗi xẩy ra.";
				}
				
				$this->self = $this->load->view('admin/saveuser', $data, true);
				$this->edituser($userid);
			}
			else $this->edituser($userid);
		}
		else
		{
			redirect("admin/members/edituser/$userid");
		}
	}
	
	public function checktransfermoney($moneytransferto, $remainmoney){
		if($moneytransferto > $remainmoney)
		{
			$this->form_validation->set_message('checktransfermoney', '%s còn lại không đủ.');
			return false;
		}
		else return true;
	}
	
	public function checkdebit($debitadd, $userid)
	{
		$results_all = $this->m_members->getallusername($userid);
		
		if(($results_all['rows'][0]->debit + $debitadd) >= $results_all['rows'][0]->creditlimit)
		{
			$this->form_validation->set_message('checkdebit', '%s lớn hơn giới hạn nợ.');
			return false;
		}
		else return true;
	}
	
	public function checkremovedebit($debitadd, $userid)
	{
		$results_all = $this->m_members->getallusername($userid);
		if(($results_all['rows'][0]->debit <= 0) || ($results_all['rows'][0]->debit < $debitadd))
		{
			$this->form_validation->set_message('checkremovedebit', '%s nợ không có.');
			return false;
		}
		else return true;
	}
	
	public function action()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$_post = $this->input->post();
		if($this->input->post('action') && $this->input->post('id'))
		{
			switch($_post['option'])
			{
				case 'delete':
					$this->db->where_in('userid', $_post['id']);
					$this->db->delete('usertb');
					redirect("admin/members/display");
					break;
				case 'addmoney':
					if(count($_post['id']) == 1)
					{
						redirect("admin/members/edituser/".$_post['id'][0]);
					}
					else
					{
						redirect("admin/members/display");
					}
					break;
				case 'adddebit':
					break;
			}
		}
		else
		{
			echo "Chua chon tai khoan";
		}
	}
}
?>