<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_skillmatrix extends CI_Controller {
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
		$table['name'] = 'td_employee_skill_matrix';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_employee_skill_matrix','field_table_master'=>'emp_id','type'=>'inner');	
		$select = 'td_employee_personal_details.*,td_employee_skill_matrix.*';
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-skillmatrix-list-view',$data,true);
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
				'emp_id' => $this->input->post('emp_id'),
				'sm_details' => $this->input->post('sm_details'),
				);
				$table['name'] = 'td_employee_skill_matrix';
				$data = $this->Common_model->save_data($table,$fields,'','');
				if($data)
				{
				$this->session->set_flashdata('success_message','Skill Matrix successfully inserted');	
				redirect('manage_skillmatrix');
				}
				else
				{
				redirect('manage_skillmatrix');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-skillmatrix-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';		

		$conditions=array('sm_id'=>$id);
		$table['name'] = 'td_employee_skill_matrix';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$fields = array(
				'emp_id' => $this->input->post('emp_id'),
				'sm_details' => $this->input->post('sm_details'),
				);	

				$table['name'] = 'td_employee_skill_matrix';
				$data = $this->Common_model->save_data($table,$fields,$id,'department_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Skill Matrix successfully updated');	
				redirect('manage_skillmatrix');
				}
				else
				{
				redirect('manage_skillmatrix');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-skillmatrix-view',$data,true);
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
		$table['name'] = 'td_employee_skill_matrix';
		if($this->Common_model->delete_data($table,$id,'sm_id'))
		{
			$this->session->set_flashdata('success_message','Skill Matrix has been Deleted successfully.');
			redirect('manage_skillmatrix');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_skillmatrix');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_employee_skill_matrix';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'sm_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Skill Matrix successfully deactivated');
				redirect('manage_skillmatrix');
			}
		else
			{
				redirect('manage_skillmatrix');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_employee_skill_matrix';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'sm_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Skill Matrix successfully activated');
				redirect('manage_skillmatrix');
			}
		else
			{
				redirect('manage_skillmatrix');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('sm_details', 'Skill Matrix Details', 'required');
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



