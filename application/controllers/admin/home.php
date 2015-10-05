<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	public function index()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$sql = "SELECT * 
				FROM `paymenttb` 
				WHERE `VoucherDate` BETWEEN (DATE_ADD(CURDATE(), INTERVAL 2-DAYOFWEEK(CURDATE()) DAY)) AND (DATE_ADD(CURDATE(), INTERVAL 8-DAYOFWEEK(CURDATE()) DAY)) 
				GROUP BY(VoucherDate) 
				ORDER BY VoucherDate ASC";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		$tmp = "[";
		foreach($row as $value)
		{
			$tmp .= '"'.date_format(date_create($value->VoucherDate), 'd-m').'"';
			$tmp .= ",";
		}
		$tmp = rtrim($tmp, ',');
		$tmp .= "]";
		$data['group_date'] = $tmp;
		$data['group_title'] = date_format(date_create($row[0]->VoucherDate), 'd-m-Y').' - '.date('d-m-Y');

		$sql = "SELECT VoucherDate, sum(amount) as Total 
				FROM paymenttb 
				WHERE (VoucherDate BETWEEN (DATE_ADD(CURDATE(), INTERVAL 2-DAYOFWEEK(CURDATE()) DAY)) AND (DATE_ADD(CURDATE(), INTERVAL 8-DAYOFWEEK(CURDATE()) DAY))) AND (PaymentType IN(4, 5, 10)) AND (PaymentWaitId = 0) 
				GROUP BY(VoucherDate) 
				ORDER BY VoucherDate ASC";
		
		$query = $this->db->query($sql);
		$row = $query->result();
		$tmp = "[";
		foreach($row as $value)
		{
			$tmp .= '"'.$value->Total.'",';
		}
		$tmp = rtrim($tmp, ',');
		$tmp .= "]";
		$data['ret'] = $tmp;
		
		$data['service'] = $this->list_service();
		
		$data['toppayment'] = $this->top_payment();
		
		$data['topservice'] = $this->top_service();
		
		$data['template'] = 'admin/home';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function top_payment($option = 'week', $method = 'load')
	{
		if($option == 'week') $where = "(VoucherDate BETWEEN (DATE_ADD(CURDATE(), INTERVAL 2-DAYOFWEEK(CURDATE()) DAY)) AND (DATE_ADD(CURDATE(), INTERVAL 8-DAYOFWEEK(CURDATE()) DAY)))";
		elseif($option == 'month') $where = "(VoucherDate BETWEEN (DATE_ADD(CURDATE(), INTERVAL 1-DAYOFMONTH(CURDATE()) DAY)) AND (DATE_ADD(CURDATE(), INTERVAL 30-DAYOFMONTH(CURDATE()) DAY)))";
		
		$sql = "SELECT paymenttb.userid, firstname, sum(amount) as total 
				FROM paymenttb
				INNER JOIN usertb on paymenttb.userid = usertb.userid 
				WHERE $where 
					AND (paymenttype = 4) 
					AND (usertb.usertype not in(0, 1, 3)) 
					GROUP BY userid 
					ORDER BY total desc 
					LIMIT 0,10";
		
		$query = $this->db->query($sql);
		$data['row'] = $query->result();
		$a = $this->load->view('admin/home/toppayment', $data, true);
		if($method == 'load') return $a;
		elseif($method == 'ajax') echo $a;
		else echo 'Error!';
	}
	
	public function top_service($option = 'month', $method = 'load')
	{
		//if($option == 'week') $numdate = 6;
		//elseif($option == 'month') $numdate = 29;
		
		if($option == 'week') $where = "(ServiceDate BETWEEN (DATE_ADD(CURDATE(), INTERVAL 2-DAYOFWEEK(CURDATE()) DAY)) AND (DATE_ADD(CURDATE(), INTERVAL 8-DAYOFWEEK(CURDATE()) DAY)))";
		elseif($option == 'month') $where = "(ServiceDate BETWEEN (DATE_ADD(CURDATE(), INTERVAL 1-DAYOFMONTH(CURDATE()) DAY)) AND (DATE_ADD(CURDATE(), INTERVAL 30-DAYOFMONTH(CURDATE()) DAY)))";

		$sql = "SELECT ServiceName, Unit, ServiceDate, ServiceTime, ServicePrice, ServiceQuantity, ServiceAmount, sum(ServiceAmount) as Total, sum(ServiceQuantity) as TotalQuan 
				FROM servicedetailtb 
				INNER JOIN servicetb ON servicedetailtb.ServiceId = servicetb.ServiceId 
				WHERE $where 
				GROUP BY servicedetailtb.ServiceId 
				ORDER BY `Total` DESC 
				LIMIT 0,10";
		
		$query = $this->db->query($sql);
		$data['row'] = $query->result();
		$a = $this->load->view('admin/home/topservice', $data, true);
		if($method == 'load') return $a;
		elseif($method == 'ajax') echo $a;
		else echo 'Error!';
	}
	
	public function list_service()
	{
		$this->db->order_by('ServiceName', 'asc');
		$query = $this->db->get('servicetb');
		$data['row'] = $query->result();
		$a = $this->load->view('admin/home/service', $data, true);
		return $a;
	}
}
?>