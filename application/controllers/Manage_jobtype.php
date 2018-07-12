<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_jobtype extends CI_Controller {
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
		$table['name'] = 'td_job_type';
		$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-jobtype-list-view',$data,true);
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
				'jobtype_name' => $this->input->post('jobtype_name'),
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_job_type';
				$data = $this->Common_model->save_data($table,$fields,'','jobtype_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Job Type successfully inserted');	
				redirect('manage_jobtype');
				}
				else
				{
				redirect('manage_jobtype');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-jobtype-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';		

		$conditions=array('jobtype_id'=>$id);
		$table['name'] = 'td_job_type';
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
				'jobtype_name' => $this->input->post('jobtype_name'),
				'published'		=> 1
				);	

				$table['name'] = 'td_job_type';
				$data = $this->Common_model->save_data($table,$fields,$id,'jobtype_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Job Type successfully updated');	
				redirect('manage_jobtype');
				}
				else
				{
				redirect('manage_jobtype');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-jobtype-view',$data,true);
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
		$table['name'] = 'td_job_type';
		if($this->Common_model->delete_data($table,$id,'jobtype_id'))
		{
			$this->session->set_flashdata('success_message','Job Type has been Deleted successfully.');
			redirect('manage_jobtype');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_jobtype');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_job_type';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'jobtype_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Job Type successfully deactivated');
				redirect('manage_jobtype');
			}
		else
			{
				redirect('manage_jobtype');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_job_type';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'jobtype_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Job Type successfully activated');
				redirect('manage_jobtype');
			}
		else
			{
				redirect('manage_jobtype');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('jobtype_name', 'Job Type Name', 'required');
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



