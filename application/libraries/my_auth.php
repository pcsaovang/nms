<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class My_auth{
	private $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function check()
	{
		if(isset($_COOKIE[CW_PREFIX.'_user_admin_logged']) && !empty($_COOKIE[CW_PREFIX.'_user_admin_logged']))
		{
			$cookie = $_COOKIE[CW_PREFIX.'_user_admin_logged'];
			$cookie = json_decode($this->CI->my_string->decode_cookie($cookie), true);
			
			$this->CI->db->select('userid, username, firstname, password');
			$this->CI->db->where(array('username' => $cookie['username'], 'usertype' => 3));
			$user = $this->CI->db->get('usertb')->row_array();
			
			if(isset($user) && count($user))
			{
				if($cookie['username'] == $user['username'] && $cookie['password'] == $user['password'])
				{
					setcookie(CW_PREFIX.'_user_admin_logged', $this->CI->my_string->encode_cookie(json_encode(array('username' => $user['username'], 'firstname' => $user['firstname'], 'password' => $user['password']))), time() + 900, '/');
					return array('userid' =>$user['userid'], 'username' => $user['username'], 'firstname' => $user['firstname']);
				}
			}
		}
		return NULL;
	}
	
	public function check_frontend()
	{
		if(isset($_COOKIE[CW_PREFIX.'_user_logged']) && !empty($_COOKIE[CW_PREFIX.'_user_logged']))
		{
			$cookie = $_COOKIE[CW_PREFIX.'_user_logged'];
			$cookie = json_decode($this->CI->my_string->decode_cookie($cookie), true);
			
			$this->CI->db->select('userid, username, firstname, password');
			$this->CI->db->where(array('username' => $cookie['username']));
			$user = $this->CI->db->get('usertb')->row_array();
			
			if(isset($user) && count($user))
			{
				if($cookie['username'] == $user['username'] && $cookie['password'] == $user['password'])
				{
					setcookie(CW_PREFIX.'_user_logged', $this->CI->my_string->encode_cookie(json_encode(array('username' => $user['username'], 'firstname' => $user['firstname'], 'password' => $user['password']))), time()+24*3600, '/');
					return array('userid' =>$user['userid'], 'username' => $user['username'], 'firstname' => $user['firstname']);
				}
			}
		}
		return NULL;
	}
}
?>