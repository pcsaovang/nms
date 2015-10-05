<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller{
	private $auth;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('file');
		$this->auth = $this->my_auth->check_frontend();
		$this->load->library('session');
	}
	
	public function login()
	{
		if($this->auth != NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		if($this->input->post('login'))
		{
			$_post = $this->input->post('data');
			$this->form_validation->set_rules('data[username]', 'Tên đăng nhập', 'trim|required|regex_match[/^([a-z0-9_])+$/i]|callback__username');
			$this->form_validation->set_rules('data[password]', 'Mật khẩu', 'trim|required|callback__password['.$_post['username'].']');
			if($this->form_validation->run() == true)
			{
				$user = $this->db->select('userid, username, firstname, password')->where(array('firstname' => $_post['username']))->from('usertb')->get()->row_array();
				setcookie(CW_PREFIX.'_user_logged', $this->my_string->encode_cookie(json_encode($user)), time() + 24*3600, '/');
				$this->my_string->php_redirect(CW_BASE_URL.'home');
			}
		}
		$err = validation_errors();
		$this->session->set_flashdata('errors', $err);
		redirect("home");
	}
	
	public function logout()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		setcookie(CW_PREFIX.'_user_logged', NULL, time()-3600, '/');
		$this->my_string->php_redirect(CW_BASE_URL.'home');
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