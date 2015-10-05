<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Changepass extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check();
		$this->load->model('m_changepass');
	}
	
	public function index()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$data['recs'] = $this->auth['username'];
		$data['template'] = 'admin/changepass';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function change()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$_post = $this->input->post();
		if($_post['username'] && (!empty($_post['username'])))
		{
			if($_post['change'])
			{
				$this->form_validation->set_rules('username', 'tài khoản', 'trim|required|regex_match[/^([a-z0-9_])+$/i]|callback__username');
				$this->form_validation->set_rules('oldpw', 'mật khẩu củ', 'trim|required|callback__password['.$_post['username'].']');
				$this->form_validation->set_rules('newpw', 'mật khẩu mới', 'trim|required');
				$this->form_validation->set_rules('confignewpw', 'xác nhận mật khẩu', 'trim|required|matches[newpw]');
				if($this->form_validation->run() == true)
				{
					if($this->m_changepass->changepw($_post['username'], $_post['newpw']) > 0)
					{
						redirect("admin/auth/logout");
					}
					else redirect("admin/changepass");
				}
				else $this->index();
			}
			else $this->index();
			
		}
		else $this->index();
	}
	
	public function _username($username)
	{
		$count = $this->db->where(array('UserName'=>$username))->from('usertb')->count_all_results();
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
			$user = $this->db->select('username, password')->where(array('username' => $username))->from('usertb')->get()->row_array();
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