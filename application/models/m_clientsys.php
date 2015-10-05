<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_clientsys extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		
	}
	
	public function show_client($offset, $limit)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by('CPName', 'asc');
		$ret['rows'] = $this->db->get('clientsystb')->result();
		$ret['num_rows'] = $this->db->count_all_results('clientsystb');
		return $ret;
	}
}
?>