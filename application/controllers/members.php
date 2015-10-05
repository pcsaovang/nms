<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Members extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check_frontend();
		$this->load->model('m_members');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->load->library('session');
	}
	
	public function saveuser($userid)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home/index');
		$_post = $this->input->post('data');
		if($this->input->post('transfermoney'))
		{
			$results = $this->m_members->getuserinfomoney($userid);
			$remainmoney = $results['rows']->remainmoney;
			$this->form_validation->set_rules('data[moneytransferto]', 'số tiền', 'trim|numeric|integer|max_length[5]|greater_than[0]|callback_checktransfermoney['.$remainmoney.']');
			$this->form_validation->set_rules('data[pw]', 'mật khẩu', 'trim|required|callback__password['.$_post['firstname'].']');
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
			}
			$err = validation_errors();
			$this->session->set_flashdata('errors', $err);
			redirect("home");
		}
		elseif($this->input->post('payservice'))
		{
			$servicedate = date('Y-m-d');
			$servicetime = date('H:i:s');
			foreach($this->input->post('servicenum') as $key => $value)
			{
				if($value > 0)
				{
					$amount = $this->m_members->getpriceservice($key, $value);
					$arr = array(
						'UserId' => $userid,
						'ServiceId' => $key,
						'ServiceDate' => $servicedate,
						'ServiceTime' => $servicetime,
						'ServiceQuantity' => $value,
						'ServiceAmount'	=> $amount
					);
					$this->m_members->saveservice($arr);
				}
			}
			redirect("home");
		}
		else
		{
			redirect("home");
		}
		$err = validation_errors();
		$this->session->set_flashdata('errors', $err);
	}
	
	public function checktransfermoney($moneytransferto, $remainmoney){
		if($moneytransferto > $remainmoney)
		{
			$this->form_validation->set_message('checktransfermoney', '%s còn lại không đủ.');
			return false;
		}
		else return true;
	}
	
	public function _username($username)
	{
		$count = $this->db->where(array('firstname'=>$username))->from('usertb')->count_all_results();
		if($count == 0)
		{
			$this->form_validation->set_message('_username', '%s không tồn tại.');
			return false;
		}
		else return true;
	}
	
	public function _password($password, $username)
	{
		if($this->_username($username) == true)
		{
			$user = $this->db->select('firstname, password')->where(array('firstname' => $username))->from('usertb')->get()->row_array();
			$pass = $this->db->select("OLD_PASSWORD('".$password."') as pw")->from('usertb')->get()->row_array();
			if($pass['pw'] != $user['password'])
			{
				$this->form_validation->set_message('_password', '%s không hợp lệ.');
				return false;
			}
			return true;
		}
	}
}
?>