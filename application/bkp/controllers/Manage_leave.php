<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_leave extends CI_Controller {
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
		$table['name'] = 'td_leave';
		$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-leave-list-view',$data,true);
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
				'leave_name' => $this->input->post('leave_name'),
				'leave_type' => $this->input->post('leave_type'),
				'published'		=> 1
				);
				$table['name'] = 'td_leave';
				$data = $this->Common_model->save_data($table,$fields,'','leave_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Leave successfully inserted');	
				redirect('manage_leave');
				}
				else
				{
				redirect('manage_leave');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-leave-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';

		$conditions=array('leave_id'=>$id);
		$table['name'] = 'td_leave';
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
				'leave_name' => $this->input->post('leave_name'),
				'leave_type' => $this->input->post('leave_type'),
				'published'		=> 1
				);
				$table['name'] = 'td_leave';
				$data = $this->Common_model->save_data($table,$fields,$id,'leave_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Leave successfully updated');	
				redirect('manage_leave');
				}
				else
				{
				redirect('manage_leave');	
				}
			}
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-leave-view',$data,true);
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
		$table['name'] = 'td_leave';
		if($this->Common_model->delete_data($table,$id,'leave_id'))
		{
			$this->session->set_flashdata('success_message','Leave has been Deleted successfully.');
			redirect('manage_leave');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_leave');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_leave';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'leave_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Leave successfully deactivated');
				redirect('manage_leave');
			}
		else
			{
				redirect('manage_leave');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_leave';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'leave_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Leave successfully activated');
				redirect('manage_leave');
			}
		else
			{
				redirect('manage_leave');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('leave_name', 'Leave Name', 'required');
		$this->form_validation->set_rules('leave_type', 'Leave Type', 'required');
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