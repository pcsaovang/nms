<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Config extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->auth = $this->my_auth->check();
		date_default_timezone_set('Asia/Ho_Chi_Minh');
	}
	
	public function index()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		$data['template'] = 'admin/config';
		$this->load->view('admin/layout/home', $data);
	}
	
	public function update()
	{
		if($this->auth == NULL) $this->my_string->php_redirect(CW_BASE_URL.'admin/auth/login');
		if($this->input->post('update'))
		{
			$this->form_validation->set_rules('from[]', 'số tiền', 'required');
			$this->form_validation->set_rules('to[]', 'số tiền', 'required');
			$this->form_validation->set_rules('trans[]', 'quy đổi', 'required|numeric|greater_than[0]');
			$this->form_validation->set_rules('number[]', 'số lượng giải', 'required|numeric');
			$this->form_validation->set_rules('hitrate[]', 'tỷ lệ trúng', 'required|numeric|less_than[100]');
			
			if($this->form_validation->run() == true)
			{
				$from = $this->input->post('from');
				$to = $this->input->post('to');
				$trans = $this->input->post('trans');
				
				$name = $this->input->post('name');
				$number = $this->input->post('number');
				$hitrate = $this->input->post('hitrate');
				
				$event_trans = array();
				for($i = 0; $i <= 4; $i++)
				{
					$event_trans[] = array(
						'from' => filter_var($from[$i], FILTER_SANITIZE_NUMBER_INT), 
						'to' => filter_var($to[$i], FILTER_SANITIZE_NUMBER_INT), 
						'trans' => $trans[$i]
					);
				}
				$data_trans = json_encode($event_trans);
				
				$event_prize = array();
				for($i = 0; $i <= 6; $i++)
				{
					$event_prize[] = array('name' => $name[$i], 'number' => $number[$i], 'hitrate' => $hitrate[$i]);
				}
				$data_prize = json_encode($event_prize);
				
				$update_data = array(
					'event_prize' => $data_prize,
					'event_trans' => $data_trans
				);
				
				$this->Siteconfig->update_config($update_data);
			}
			$err = validation_errors();
			$this->session->set_flashdata('errors', $err);
			redirect('admin/config');
		}
		redirect('admin/config');
	}
}
?>