<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Events extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->my_auth->check();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
		$this->load->library('session');
		$this->load->model('m_events');
		$this->load->model('Siteconfig');
	}
	
	public function index($eventcode = '001')
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		$result = $this->m_events->get_events_prize($eventcode);
		
		$data['eventcode'] = $eventcode;
		$data['prize'] = $result['prize'];
		
		$eventtime = array();
		$eventtime['start'] = explode(' ', $result['eventtime']->EventStart);
		$eventtime['end'] = explode(' ', $result['eventtime']->EventEnd);
		
		$data['eventtime'] = $eventtime;

		$data['trans'] = json_decode($result['trans']->value);
		
		$data['template'] = 'admin/events';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function update($eventcode)
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		if($this->input->post('update'))
		{	
			$this->form_validation->set_rules('prizeid[]', 'mã giải thưởng', 'require');
			$this->form_validation->set_rules('name[]', 'tên giải thưởng', 'required');
			$this->form_validation->set_rules('number[]', 'số lượng giải thưởng', 'required|numeric');
			$this->form_validation->set_rules('hitrate[]', 'tỷ lệ trúng', 'required|numeric|less_than[100]');
			$this->form_validation->set_rules('money[]', 'giá trị giải thưởng', 'required|numeric|greater_than[-1]');
			
			if($this->form_validation->run() == true)
			{
				$start = $this->input->post('eventdatebegin').' '.$this->input->post('eventtimebegin');
				$end = $this->input->post('eventdateend').' '.$this->input->post('eventtimeend');
				
				$id = $this->input->post('prizeid');
				$name = $this->input->post('name');
				$number = $this->input->post('number');
				$hitrate = $this->input->post('hitrate');
				$money = $this->input->post('money');
				
				for($i = 0; $i < count($id); $i++)
				{
					$data_arr = array(
						'EventName'		=>	$name[$i],
						'EventMoney'	=>	$money[$i],
						'EventNumber'	=>	$number[$i],
						'EventHitrate'	=>	$hitrate[$i],
						'EventStart'	=>	$start,
						'EventEnd'		=>	$end
					);
					$this->m_events->update_event($eventcode, $id[$i], $data_arr);
				}
			}
			$err = validation_errors();
			$this->session->set_flashdata('errors', $err);
			redirect('admin/events');
		}
		redirect('admin/events');
	}
	
	public function trans()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		
		if($this->input->post('update'))
		{
			$this->form_validation->set_rules('from[]', 'số tiền', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('to[]', 'số tiền', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('trans[]', 'quy đổi', 'required|numeric|greater_than[0]');
			
			$this->form_validation->set_rules('frommax', 'số tiền', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('transmax', 'số tiền', 'required|numeric|greater_than[0]');
			
			if($this->form_validation->run() == true)
			{
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				$trans = $this->input->post('trans');
				
				$frommax = $this->input->post('frommax');
				$transmax = $this->input->post('transmax');
				
				$event_trans = array();
				for($i =0; $i < count($from); $i++)
				{
					$event_trans[] = array(
						'from' => filter_var($from[$i], FILTER_SANITIZE_NUMBER_INT), 
						'to' => filter_var($to[$i], FILTER_SANITIZE_NUMBER_INT), 
						'trans' => $trans[$i]
					);
				}
				$event_trans[] = array(
					'from' => $frommax,
					'to' => '~',
					'trans' => $transmax
				);
				$data_trans = json_encode($event_trans);
				
				$update_data = array('event_trans' => $data_trans);
				$this->Siteconfig->update_config($update_data);
			}
			$err = validation_errors();
			$this->session->set_flashdata('errors', $err);
			redirect('admin/events');
		}
		redirect('admin/events');
	}
}
?>