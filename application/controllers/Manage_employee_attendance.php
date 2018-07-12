<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_employee_attendance extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		if(($this->session->userdata('is_admin_logged_in')!=1))

		{

			redirect(base_url());	

		}		
		$this->load->model(array('Common_model'));
		//date_default_timezone_set("Asia/calcutta");
	}

	################################################################

	function index()
	{
		$emp_id = $this->session->userdata('user_id1');
		
		if($this->input->post('mode')=='tab') {
			
			$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
			$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
			
			$table['name'] = 'td_attendance';
			$order_by[0] = array('field'=>'attendance_date','type'=>'DESC');
			$conditions = array('attendance_date>='=>$from_date,'attendance_date<='=>$to_date);
			$data['rows'] = $this->Common_model->find_data($table,'array','',$conditions,'','','',$order_by);
			//echo '<pre>';print_r($data['rows']);die;
		}
		else
		{			
			$data['rows'] = array();
		}
				
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-employee-attendance-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}	
	
	##################################################################################################
}