<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_changepass extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function changepw($user, $pass)
	{
		$pw = $this->db->select("OLD_PASSWORD('".$pass."') as pw")->get()->row_array();
		$this->db->where('username', $user);
		$this->db->update('usertb', array('password' => $pw['pw']));
		$affected = $this->db->affected_rows();
		return $affected;
	}
}
?>