<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_events extends CI_Model
{
	public function get_payment($userid, $money = 10000)
	{
		$dnow = date('Y-m-d');
		//$dnow = '2015-04-16';
		
		$sql = "SELECT voucherid, voucherdate, amount  FROM paymenttb 
				WHERE voucherid NOT IN(SELECT voucherid from events WHERE VoucherDate = '$dnow') AND 
				voucherdate = '$dnow' AND 
				userid = $userid AND 
				paymenttype = 4 AND 
				amount >= $money AND
				servicepaid = 1
		";
		$result = $this->db->query($sql);
		$ret['rows'] = $result->result();
		
		return $ret;
	}
	
	public function insertevent($voucherid, $voucherdate, $userid, $turn = '')
	{
		$rows = 0;
		
		$sql = "INSERT INTO events (VoucherId, VoucherDate, UserId, Active) SELECT * FROM (SELECT $voucherid, '$voucherdate', $userid, 0) AS tmp WHERE NOT EXISTS (SELECT VoucherId FROM events WHERE VoucherId = $voucherid) LIMIT 1";
		$this->db->query($sql);
		if($this->db->affected_rows() > 0) $row = $this->db->affected_rows();
		else $row = 0;
		return $row;
	}
	
	public function updateturn($userid, $turn, $operations = '')
	{
		$dnow = date('Y-m-d');
		$turn_old = 0;
		
		$this->db->where('userid', $userid);
		$this->db->where('VoucherDate', $dnow);
		$result = $this->db->get('events')->result();
		
		if(count($result) > 0) $turn_old = $result[0]->Turn;

		$rows = 0;
		
		if($operations == '') $turn_new = $turn_old + $turn;
		else $turn_new = $turn_old - $turn;
		
		$this->db->where('userid', $userid);
		$this->db->where('VoucherDate', $dnow);
		$this->db->update('events', array('turn' => $turn_new));
		
		if($this->db->affected_rows() > 0) $rows = $this->db->affected_rows();
		else $rows = 0;
		
		return $rows;
	}
	
	
	public function savelogevent($arr)
	{
		$this->db->insert('eventlog', $arr);
		if($this->db->affected_rows() > 0) return true;
		return false;
	}
	
	public function getturn($userid)
	{
		$dnow = date('Y-m-d');
		$turn = 0;
		
		$this->db->select('turn');
		$this->db->where('userid', $userid);
		$this->db->where('voucherdate', $dnow);
		$result = $this->db->get('events')->row();
		
		if(count($result) > 0) $ret = $result->turn;
		else $ret = 0;
		
		return $ret;
	}
	
	public function get_events_prize($eventcode)
	{
		$this->db->where('eventcode', $eventcode);
		$result['prize'] = $this->db->get('eventprize')->result();
		
		$this->db->select('EventStart, EventEnd');
		$this->db->where('eventcode', $eventcode);
		$this->db->group_by('eventcode');
		
		$result['eventtime'] = $this->db->get('eventprize')->row();
		
		$this->db->where('key', 'event_trans');
		$result['trans'] = $this->db->get('config_data')->row();
		
		return $result;
	}
	
	public function update_event($eventcode, $prizeid, $arr)
	{
		$this->db->where('EventCode', $eventcode);
		$this->db->where('EventPrize', $prizeid);
		$this->db->update('eventprize', $arr);
		
		if($this->db->affected_rows() > 0) $rows = $this->db->affected_rows();
		else $rows = 0;
		
		return $rows;
	}
	
	public function check_event_number($eventprize = '')
	{
		//$this->db->select('EventNumber, EventPrize');
		$this->db->where('EventPrize', $eventprize);

		$result = $this->db->get('eventprize')->row();
		
		//if($result->EventNumber > 0 || $result->EventPrize == $miss) return true;
		//return false;
		return $result;
	}
}
?>