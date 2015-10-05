<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_history extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	public function payment_search($query_string, $limit, $offset, $sort_by, $sort_order)
	{
		$total_money = 0;
		$total_money_service = 0;
		$total_money_debit = 0;
		$total_money_undebit = 0;
		$total_hours = 0;
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('firstname', 'voucherdate', 'vouchertime', 'amount', 'staffid', 'note');
		$sort_by = (in_array($sort_by, $sort_columns) ? $sort_by : 'vouchertime');
		
		$this->db->select('paymenttb.userid, voucherdate, vouchertime, amount, staffid, note, paymenttype, firstname, username');
		$this->db->from('paymenttb');
		$this->db->join('usertb', 'paymenttb.userid = usertb.userid', 'inner');
		
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 4 && is_numeric($tmp[0]) && is_numeric($tmp[1]) && is_numeric($tmp[2]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				$tf = date('H:i:s', $tmp[0]);
				$tt = date('H:i:s', $tmp[1]);
				
				$where = "SELECT VoucherId FROM paymenttb WHERE".
				" (VoucherDate = '".$df."' AND VoucherTime <= '".$tf."') OR".
				" (VoucherDate = '".$dt."' AND VoucherTime >= '".$tt."')";
				
				if($tmp[3] != 'all') $this->db->where('firstname', $tmp[3]);
				
				$this->db->where('staffid', $tmp[2]);
				$this->db->where('voucherdate >=', $df);
				$this->db->where('voucherdate <=', $dt);
				$this->db->where('VoucherId NOT IN ('.$where.')');
			}
		}
		
		$this->db->order_by($sort_by, $sort_order);
		$this->db->limit($limit, $offset);
		
		$query = $this->db->get();
		$ret['rows'] = $query->result();;
		
		foreach($ret['rows'] as $key => $value)
		{	
			$this->db->select('username');
			$this->db->where('userid', $value->staffid);
			$querystaff = $this->db->get('usertb');
			$ret['rows'][$key]->staffname = $querystaff->row()->username;
		}

		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 4 && is_numeric($tmp[0]) && is_numeric($tmp[1]) && is_numeric($tmp[2]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				$tf = date('H:i:s', $tmp[0]);
				$tt = date('H:i:s', $tmp[1]);
				
				$where = "SELECT VoucherId FROM paymenttb WHERE".
				" (VoucherDate = '".$df."' AND VoucherTime <= '".$tf."') OR".
				" (VoucherDate = '".$dt."' AND VoucherTime >= '".$tt."')";
				
				if($tmp[3] != 'all') $this->db->where('firstname', $tmp[3]);
				
				$this->db->where('staffid', $tmp[2]);
				$this->db->where('voucherdate >=', $df);
				$this->db->where('voucherdate <=', $dt);
				$this->db->where('VoucherId NOT IN ('.$where.')');
			}
		}
		$this->db->select('paymenttb.userid, amount, paymenttype');
		
		$this->db->join('usertb', 'paymenttb.userid = usertb.userid', 'inner');
		$this->db->from('paymenttb');
		
		$statistic = $this->db->get()->result();
		$ret['num_rows'] = count($statistic);
		foreach($statistic as $value)
		{
			if($value->paymenttype == 4 || $value->paymenttype == 5 || $value->paymenttype == 10) $total_money = $total_money + $value->amount;
			if($value->paymenttype == 1 || $value->paymenttype == 2) $total_money_service = $total_money_service + $value->amount;
			if($value->paymenttype == 6) $total_money_debit = $total_money_debit + $value->amount;
			if($value->paymenttype == 5) $total_money_undebit = $total_money_undebit + $value->amount;
		}
		$ret['total']['total_money'] = $total_money;
		$ret['total']['total_money_service'] = $total_money_service;
		$ret['total']['total_money_debit'] = $total_money_debit;
		$ret['total']['total_money_undebit'] = $total_money_undebit;
		return $ret;
	}
	
	public function trans_payment($query_string)
	{
		$j = 0;
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 4 && is_numeric($tmp[0]) && is_numeric($tmp[1]) && is_numeric($tmp[2]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				
				$this->db->where('voucherdate >=', $df);
				$this->db->where('voucherdate <=', $dt);
				$this->db->where("(vouchertime < '08:00:00' OR vouchertime >= '22:00:00')");
				
				$this->db->select('voucherid, vouchertime');
				$this->db->from('paymenttb');
				$all_result = $this->db->get()->result();
				
				$h_now = date('H');
				$i_now = date('i');
				
				foreach($all_result as $all_results)
				{
					if($h_now > 21) $h_now = 21;
					if($i_now > 10) $i_now = $i_now - 10;
					
					$h = rand(8, $h_now);
					$i = rand(0, $i_now);
					$s = rand(0, 59);
					
					if($h < 10) $h = '0'.$h;
					if($i < 10) $i = '0'.$i;
					if($s < 10) $s = '0'.$s;
					$time_rand = $h.":".$i.":".$s;
					
					$this->db->where('voucherid', $all_results->voucherid);
					$this->db->update('paymenttb', array('vouchertime' => $time_rand));
					$j++;
				}
				return $j;
			}
			else return $j;
		}
		else return $j;
	}
	
	public function trans_weburl($query_string)
	{
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			$affected = 0;
			if(count($tmp) == 2 && is_numeric($tmp[0]) && is_numeric($tmp[1]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				
				$this->db->where("(DATE(recorddate) BETWEEN '$df' AND '$dt')");
				
				$dataurl = array();
				$file = fopen(base_url().'/template/url.txt', 'r');
				if($file){
					while(!feof($file)){
						$dataurl[] = "'%".trim(fgets($file))."%'";
					}
					fclose($file);
				}
				$str = implode(' AND url NOT LIKE ', $dataurl);

				$query = "((url NOT LIKE {$str}) OR (TIME(RecordDate) >= '22:00:00' OR TIME(RecordDate) <= '08:00:00'))";
				
				$this->db->where($query);
				
				$this->db->select('urlid, url');

				$this->db->delete('webhistorytb');
				$affected = $this->db->affected_rows();
			}
		}
		return $affected;
	}
	
	public function trans_systemlog($query_string)
	{
		$j = 0;
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			$affected = 0;
			if(count($tmp) == 2 && is_numeric($tmp[0]) && is_numeric($tmp[1]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
			
				$this->db->where("(enterdate BETWEEN '$df' AND '$dt')");
				$this->db->where("(entertime < '08:00:00' OR entertime > '22:00:00')");
				$this->db->or_where("(endtime < '08:00:00' OR endtime > '22:00:00')");
				
				$this->db->select('systemlogid, enterdate, entertime, endtime');
				$result = $this->db->get('systemlogtb');
				$ret['rows'] = $result->result();
				
				foreach($ret['rows'] as $value)
				{
					if($value->entertime)
					{
						$sh = substr($value->entertime, 0, 2);
						if($sh < 8)
						{
							$tmp = 8 - $sh;
							$sh += $tmp;
							if($sh < 10) $sh = '0'.$sh;
							$sh = $sh.":".substr($value->entertime, 3);
						}
						elseif($sh >= 22)
						{
							$tmp = $sh - 21;
							$sh -= $tmp;
							$sh = $sh.":".substr($value->entertime, 3);
						}
						else $sh = $value->entertime;
					}
					else $sh = NULL;
					
					if($value->endtime)
					{
						$eh = substr($value->endtime, 0, 2);
						if($eh < 8)
						{
							$tmp = 8 - $eh;
							$eh += $tmp;
							if($eh < 10) $eh = '0'.$eh;
							$eh = $eh.":".substr($value->endtime, 3);
						}
						elseif($eh >= 22)
						{
							$tmp = $eh - 21;
							$eh -= $tmp;
							$eh = $eh.":".substr($value->endtime, 3);
						}
						else $eh = $value->endtime;
					}
					else $eh = NULL;
					
					$this->db->where('systemlogid', $value->systemlogid);
					$this->db->update('systemlogtb', array('entertime' => $sh, 'endtime' => $eh));
					$j++;
				}
			}
		}
		return $j;
	}
	
	public function weburl_search($query_string, $offset, $limit)
	{
		$this->db->select('urlid, url, webhistorytb.recorddate, machine, firstname');
		$this->db->from('webhistorytb');
		$this->db->join('usertb', 'webhistorytb.userid = usertb.userid', 'left');
		
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 2 && is_numeric($tmp[0]) && is_numeric($tmp[1]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				
				$this->db->where("DATE(webhistorytb.recorddate) BETWEEN '$df' AND '$dt'");
			}
		}
		
		$this->db->limit($limit, $offset);
		$ret['rows'] = $this->db->get()->result();
		
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 2 && is_numeric($tmp[0]) && is_numeric($tmp[1]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				
				$this->db->where("DATE(recorddate) BETWEEN '$df' AND '$dt'");
			}
		}
		$ret['num_rows'] = $this->db->count_all_results('webhistorytb');
		
		return $ret;
	}
	
	public function serverlog_search($offset, $limit)
	{
		$this->db->limit($limit, $offset);
		$this->db->order_by('recorddate', 'desc');
		$this->db->order_by('recordtime', 'desc');
		$ret['rows'] = $this->db->get('serverlogtb')->result();
		$ret['num_rows'] = $this->db->count_all_results('serverlogtb');
		return $ret;
	}
	
	public function service_search($query_string, $offset, $limit)
	{
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 3 && is_numeric($tmp[0]) && is_numeric($tmp[1]) && is_numeric($tmp[2]))
			{
				$df = date('Y-m-d', $tmp[0]);
				//$df = '2015-03-01';
				$dt = date('Y-m-d', $tmp[1]);
				
				$this->db->select('servicedate, servicetime, servicequantity, serviceamount, staffid, usertb.firstname, usertb.username, servicetb.servicename, servicetb.unit');
				$this->db->from('servicedetailtb');
				
				$this->db->join('servicetb', 'servicedetailtb.serviceid = servicetb.serviceid', 'left');
				$this->db->join('usertb', 'servicedetailtb.userid = usertb.userid', 'left');
				
				$this->db->where("servicedate BETWEEN '$df' AND '$dt'");
				$this->db->where('staffid', $tmp[2]);
				$this->db->where('accept', 1);
				$this->db->order_by('servicedate', 'desc');
				$this->db->limit($limit, $offset);
				$query = $this->db->get();
				//print_r($result);
				
				$ret['rows'] = $query->result();
				foreach($ret['rows'] as $key => $value)
				{	
					$this->db->select('username');
					$this->db->where('userid', $value->staffid);
					$querystaff = $this->db->get('usertb');
					$ret['rows'][$key]->staffname = $querystaff->row()->username;
				}
				
				$this->db->where("servicedate BETWEEN '$df' AND '$dt'");
				$this->db->where('staffid', $tmp[2]);
				$this->db->where('accept', 1);
				$ret['num_rows'] = $this->db->count_all_results('servicedetailtb');
				
				return $ret;
			}
		}
	}
	
	public function systemlog_search($query_string, $offset, $limit)
	{
		if(strlen($query_string))
		{
			$tmp = explode('-', $query_string);
			if(count($tmp) == 2 && is_numeric($tmp[0]) && is_numeric($tmp[1]))
			{
				$df = date('Y-m-d', $tmp[0]);
				$dt = date('Y-m-d', $tmp[1]);
				
				$this->db->select('systemlogid, machinename, ipaddress, enterdate, entertime, enddate, endtime, systemlogtb.status, systemlogtb.timeused, systemlogtb.moneyused, usertb.firstname, usertb.username');
				$this->db->from('systemlogtb');
				
				$this->db->join('usertb', 'systemlogtb.userid = usertb.userid', 'left');
				
				$this->db->where("enterdate BETWEEN '$df' AND '$dt'");
				$this->db->order_by('enterdate', 'desc');
				$this->db->order_by('entertime', 'desc');
				$this->db->limit($limit, $offset);
				$query = $this->db->get();
				$ret['rows'] = $query->result();
				
				$this->db->where("enterdate BETWEEN '$df' AND '$dt'");
				$ret['num_rows'] = $this->db->count_all_results('systemlogtb');
				
				return $ret;
			}
		}
	}
	
	public function get_staff($staffid = '')
	{
		$this->db->select('userid, firstname, username,');
		if(empty($staffid))
		{
			$this->db->where('usertype', 3);
			$this->db->or_where('usertype', 4);
		}
		else
		{
			$this->db->where('userid', (int)$staffid);
		}
		$query = $this->db->get('usertb');
		$ret['rows'] = $query->result();
		return $ret;
	}
	
	public function list_all_members()
	{
		$this->db->select('firstname');
		$this->db->where_not_in('usertype', array(0, 1, 3));
		$query = $this->db->get('usertb');
		$ret['rows'] = $query->result();
		return $ret;
	}
}
?>