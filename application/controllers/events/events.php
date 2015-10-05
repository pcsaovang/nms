<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends CI_Controller
{
	private $sec;
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check_frontend();
		$this->load->model('m_members');
		$this->load->model('m_events');
		$this->load->library('session');
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	public function data_event($eventcode = '001')
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		
		$_post = $this->input->post('s');
		if($_post !== md5($this->auth['userid'])) die(show_404());
		
		$p = md5($this->my_string->random()."-".$_post);
		
		$this->session->set_flashdata('sec', $p);
		
		$turn = $this->m_events->getturn($this->auth['userid']);
		if($turn > 0)
		{
			$result = $this->_randomprize();
			$prize_status = $this->m_events->check_event_number($result);
			if($prize_status->EventNumber <= 0) $prize_status = $this->m_events->check_event_number('G');
			
			$tmp = explode(',', $prize_status->EventAngle);
			
			$angle = rand($tmp[0], $tmp[1]);
			$prize = $prize_status->EventMoney;
			$name = $prize_status->EventName;
			
			$data = array(
				'code'			=>	1,
				'spinSecret'	=>	$_post,
				'pos'			=>	$angle,
				'turns'			=>	$turn,
				'getprize'		=>	"events/events/getprize/$p",
				'message'		=> $name
			);
			
			$this->session->set_userdata('prize_status', $prize_status);
		}
		else
		{
			$data = array('code' => 1, 'message' => 'Hết lượt quay');
		}
		echo json_encode($data);
	}
	
	public function index()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		
		$this->session->unset_userdata('prize_status');
		$result = $this->m_members->getallusername($this->auth['userid']);
		$data_sub['user_info'] = $result['rows'];
		
		$results = $this->m_members->getallusername();
		$data_sub['user_other'] = $results['rows'];
		
		$data_sub['errors'] = $this->session->flashdata('errors');
		$data['user_box'] = $this->load->view('userbox', $data_sub, true);
		
		$result = $this->m_members->listservice();
		$data_sub['listservice'] = $result['rows'];
		$data['list_service'] = $this->load->view('service', $data_sub, true);
		
		$data['turn'] = $this->m_events->getturn($this->auth['userid']);
		
		$data['spinSecret'] = md5($this->auth['userid']);

		$data['template'] = 'events/events';
		$this->load->view('layout/index', $data);
	}
	
	public function __data_event()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		
		$_post = $this->input->post('s');
		$a = str_repeat('A', 1) . str_repeat('B', 2) . str_repeat('C', 2) . str_repeat('D', 5) . str_repeat('E', 10) .str_repeat('F', 20) . str_repeat('G', 60);

		$a = str_shuffle($a);

		$result = $a{rand(0, 99)};
		switch($result)
		{
			case 'A': //20k
				$angle = rand(62, 107);
				$img = "template/img/event/20k.png";
				$prize = 20000;
				break;
			case 'B': //sting
				$angle = rand(167, 213);
				$img = "template/img/event/sting.png";
				$prize = 10000;
				break;
			case 'C': //10k
				$angle = rand(271, 315);
				$img = "template/img/event/10k.png";
				$prize = 10000;
				break;
			case 'D': //5k
				$angle = rand(107, 167);
				$img = "template/img/event/5k.png";
				$prize = 5000;
				break;
			case 'E': //1k
				$angle = rand(213, 271);
				$img = "template/img/event/1k.png";
				$prize = 1000;
				break;
			case 'F': //500d
				$angle = rand(0, 62);
				$img = "template/img/event/500d.png";
				$prize = 500;
				break;
			case 'G': //kt
				$angle = rand(315, 360);
				$img = "template/img/event/kt.png";
				$prize = 0;
			break;
		}
		
		$turn = $this->m_events->getturn($this->auth['userid']);
		
		$this->session->set_flashdata('prize', $prize);
		
		$data = array(
			'code'			=>	1,
			'spinSecret'	=>	$_post,
			'pos'			=>	$angle,
			'turns'			=>	$turn,
			'getprize'		=>	"events/events/getprize",
			'image'			=> $img
		);
		echo json_encode($data);
	}
	
	public function getprize($s = '')
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		$sec = $this->session->flashdata('sec');
		if($s == '' || $sec == false || $s != $sec) die(show_404());
		$arr_prize = $this->session->userdata('prize_status');

		if(is_object($arr_prize))
		{
			if($this->_saveprize($this->auth['userid'], $arr_prize->EventMoney, $s))
			{
				if($arr_prize->EventNumber > 0) $this->m_events->update_event($arr_prize->EventCode, $arr_prize->EventPrize, array('EventNumber' => $arr_prize->EventNumber - 1));
				$a = array('messages' => $arr_prize->EventName);
			}
			else
			{
				$a = array('messages' => 'Có lổi trong khi nhận thưởng. Vui lòng kiểm tra lại.');
			}
		}
		else $a = array('messages' => 'Có lổi trong khi nhận thưởng. Vui lòng kiểm tra lại.');
		
		echo json_encode($a);
	}
	
	private function _randomprize($eventcode = '001')
	{
		$event = $this->m_events->get_events_prize($eventcode);
			
		$a = '';
		foreach($event['prize'] as $key => $val)
		{
			$a .= str_repeat($val->EventPrize, $val->EventHitrate);
		}
		
		$a = str_shuffle($a);
		$result = $a{rand(0, 99)};
		
		return $result;
	}
	
	private function _saveprize($userid, $money, $s)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'home');
		
		$results = $this->m_members->getuserinfomoney($userid);
		$remainmoney = $results['rows']->remainmoney;
		
		$remaintime = $this->m_members->getprice($userid, ($remainmoney + $money));
		
		$arr_data_user = array('RemainMoney'	=>	($remainmoney + $money), 'RemainTime'	=>	$remaintime);
		
		$arr_data_log = array(
			'LogUserId'		=>	$this->auth['userid'],
			'LogCode'		=>	$this->session->userdata('prize_status')->EventCode,
			'LogPrize'		=>	$this->session->userdata('prize_status')->EventPrize,
			'LogSecret'		=>	$s,
			'LogDate'		=>	date('Y-m-d H:i:s', time())
		);
		if($money > 0)
		{
			$this->m_members->saveuserinfo($userid, $arr_data_user);
		}
		
		if($this->m_events->updateturn($userid, 1, '-') && $this->m_events->savelogevent($arr_data_log)) return true;
	
		return false;
	}
}
?>