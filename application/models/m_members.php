<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_members extends CI_Model
{
	public function search($query_string, $limit, $offset, $sort_by, $sort_order)
	{
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('userid', 'firstname', 'debit', 'usertype', 'moneypaid', 'remainmoney', 'recorddate', 'lastlogindate', 'active');
		$sort_by = (in_array($sort_by, $sort_columns) ? $sort_by : 'firstname');
		$arr_usertype = array(0, 1, 3);
		
		$this->db->select('usertb.userid, usertb.firstname, usertb.username, usertb.debit, usertb.usertype, usertb.moneypaid, usertb.remainmoney, usertb.recorddate, usertb.lastlogindate, usertb.active, pricelisttb.pricetype');
		$this->db->from('usertb');
		$this->db->join('pricelisttb', 'usertb.usertype = pricelisttb.priceid', 'left');
		
		if(strlen($query_string) && $query_string != "all")
		{
			$this->db->like('usertb.firstname', $query_string, 'after');
		}
		$this->db->where('usertb.status', 1);
		$this->db->where_not_in('usertb.usertype', $arr_usertype);
		$this->db->order_by($sort_by, $sort_order);
		$this->db->limit($limit, $offset);
		$query = $this->db->get();

		$ret['rows'] = $query->result();
		
		$this->db->select('COUNT(*) as count');
		$this->db->where('usertb.status', 1);
		$this->db->where_not_in('usertb.usertype', $arr_usertype);
		if(strlen($query_string) && $query_string != "all")
		{
			$this->db->like('usertb.firstname', $query_string, 'after');
		}
		$query = $this->db->get('usertb');

		$tmp = $query->result();
		$ret['num_rows'] = $tmp[0]->count;
		
		$query1 = $this->db->query('select sum(debit) as totaldebit, sum(remainmoney) as totalmoney from usertb where usertype not in(0, 1, 3)');
		$tmp1 = $query1->result();
		$ret['totaldebit'] = $tmp1[0]->totaldebit;
		$ret['totalmoney'] = $tmp1[0]->totalmoney;
		
		return $ret;
	}
	
	public function getallusername($userid = '')
	{
		$this->db->select('userid, firstname, username, debit, creditlimit, moneypaid, remainmoney, remaintime, freemoney, pricetype');
		$this->db->from('usertb');
		$this->db->join('pricelisttb', 'usertb.usertype = pricelisttb.priceid', 'left');
		if($userid) $this->db->where('userid', $userid);
		else $this->db->where_not_in('usertype', array(0, 1, 3));
		$this->db->order_by('firstname', 'asc');
		$this->db->where('status', 1);
		$query = $this->db->get();
		$ret['rows'] = $query->result();
		return $ret;
	}
	
	public function getinfouser($userid)
	{
		$query = $this->db->get_where('usertb', array('userid' => $userid));
		
		if($query->num_rows() > 0)
		{
			$ret['rows'] = $query->row();
			$query_price = $this->db->select('Type, PriceType')->where(array('PriceId' => $ret['rows']->UserType))->get('pricelisttb');
			$ret['price'] = $query_price->row();
		}
		else
		{
			$ret['rows'] = null;
		}
		return $ret;
	}
	
	public function getuserinfomoney($userid)
	{	
		$query = $this->db->select('userid, password, creditlimit, debit, moneypaid, remainmoney, freemoney, moneytransfer, remaintime')->where('userid', $userid)->from('usertb');
		
		$ret['rows'] = $query->get()->row();
		
		return $ret;
	}
	
	public function passdecode($str)
	{
		$query = $this->db->select("OLD_PASSWORD('".$str."') as pw");
		return $query->get()->row();
	}
	
	public function saveuserinfo($userid, $arr)
	{
		$this->db->where('userid', $userid);
		$this->db->update('usertb', $arr);
		if($this->db->affected_rows() > 0) return true;
		return false;
	}
	
	public function savereport($arr)
	{
		$this->db->insert('paymenttb', $arr);
		if($this->db->affected_rows() > 0) return true;
		return false;
	}
	
	public function saveservice($arr)
	{
		$this->db->insert('servicedetailtb', $arr);
		if($this->db->affected_rows() > 0) return true;
		return false;
	}
	
	public function getprice($userid, $money = 0)
	{
		$this->db->select('pricemachinetb.price');
		$this->db->from('usertb');
		$this->db->join('pricemachinetb', 'usertb.usertype = pricemachinetb.priceid', 'left');
		$this->db->where('usertb.userid', $userid);
		$this->db->where('pricemachinetb.MachineGroupId', 1);
		$query = $this->db->get();
		$result = $query->row();
		
		$min = round(($money / ($result->price / 60)), 0, PHP_ROUND_HALF_DOWN);
		return $min;
	}
	
	public function listservice()
	{
		$this->db->where('Active', 1);
		$this->db->where('Inventory > 0');
		$this->db->order_by('ServiceName', 'asc');
		$query = $this->db->get('servicetb');
		$ret['rows'] = $query->result();
		return $ret;
	}
	
	public function getpriceservice($serviceid, $num)
	{
		$this->db->where('serviceid', $serviceid);
		$result = $this->db->get('servicetb')->row();
		return ($result->ServicePrice * $num);
	}
	
	public function listiconweb()
	{
		$this->db->where('active', 1);
		$this->db->order_by('sort', 'desc');
		$query = $this->db->get('icon');
		$ret['rows'] = $query->result();
		return $ret;
	}
}
?>