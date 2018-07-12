<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_salary_head extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(($this->session->userdata('is_admin_logged_in')!=1))

		{

			redirect(base_url());	

		}		
		$this->load->model(array('Common_model'));
	}

	################################################################

	function index()
	{
		$table['name'] = 'td_salary_head';
		$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-salary-head-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################	

	function add()
	{	

		$data['action'] = 'Add';

		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$fields = array(
				'salary_head_name' => $this->input->post('salary_head_name'),
				'salary_head_description' => $this->input->post('salary_head_description'),
				'emp_type' => $this->input->post('emp_type'),
				'salary_head_type' => $this->input->post('salary_head_type'),
				'is_fixed_percent' => $this->input->post('is_fixed_percent'),
				'percent_rate' => $this->input->post('percent_rate'),
				'is_optional' => $this->input->post('is_optional'),
				'published'	=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_salary_head';
				$data = $this->Common_model->save_data($table,$fields,'','salary_head_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Salary head successfully inserted');	
				redirect('manage_salary_head');
				}
				else
				{
				redirect('manage_salary_head');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-salary-head-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';	

		$conditions=array('salary_head_id'=>$id);
		$table['name'] = 'td_salary_head';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		$data['is_fixed_percent'] = $data['row']->is_fixed_percent;
		//echo '<pre>';print_r($data['row']);die;
		
		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{		  		
				$fields = array(
				'salary_head_name' => $this->input->post('salary_head_name'),
				'salary_head_description' => $this->input->post('salary_head_description'),
				'emp_type' => $this->input->post('emp_type'),
				'salary_head_type' => $this->input->post('salary_head_type'),
				'is_fixed_percent' => $this->input->post('is_fixed_percent'),
				'percent_rate' => $this->input->post('percent_rate'),
				'is_optional' => $this->input->post('is_optional'),
				'published'	=> 1
				);
			 	//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_salary_head';
				$data = $this->Common_model->save_data($table,$fields,$id,'salary_head_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Salary head successfully updated');	
				redirect('manage_salary_head');
				}
				else
				{
				redirect('manage_salary_head');	
				}
			}
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-salary-head-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function confirmDelete($id)
	{

		if($this->session->flashdata('success_message'))
		{
			$data['success_message'] =  $this->session->flashdata('success_message');
		}
		if($this->session->flashdata('error_message'))
		{
			$data['error_message'] =  $this->session->flashdata('error_message');
		}
		$table['name'] = 'td_salary_head';
		if($this->Common_model->delete_data($table,$id,'salary_head_id'))
		{
			$this->session->set_flashdata('success_message','Salary head has been Deleted successfully.');
			redirect('manage_salary_head');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_salary_head');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_salary_head';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'salary_head_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Salary head successfully deactivated');
				redirect('manage_salary_head');
			}
		else
			{
				redirect('manage_salary_head');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_salary_head';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'salary_head_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Salary head successfully activated');
				redirect('manage_salary_head');
			}
		else
			{
				redirect('manage_salary_head');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('salary_head_name', 'Salary head name', 'required');
		$this->form_validation->set_rules('salary_head_description', 'Salary head description', 'required');
		$this->form_validation->set_rules('emp_type', 'Employee name', 'required');
		$this->form_validation->set_rules('salary_head_type', 'Salary head type', 'required');
		$this->form_validation->set_rules('is_fixed_percent', 'Is fixed percent', 'required');
		$this->form_validation->set_rules('is_optional', 'Is optional', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	##################################################################################################
}



