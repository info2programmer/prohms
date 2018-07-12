<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_skill extends CI_Controller {
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
		$table['name'] = 'td_skill';
		$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-skill-list-view',$data,true);
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
				'skill_name' => $this->input->post('skill_name'),
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_skill';
				$data = $this->Common_model->save_data($table,$fields,'','skill_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Skill successfully inserted');	
				redirect('manage_skill');
				}
				else
				{
				redirect('manage_skill');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-skill-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';		

		$conditions=array('skill_id'=>$id);
		$table['name'] = 'td_skill';
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
				'skill_name' => $this->input->post('skill_name'),
				'published'		=> 1
				);	

				$table['name'] = 'td_skill';
				$data = $this->Common_model->save_data($table,$fields,$id,'skill_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Skill successfully updated');	
				redirect('manage_skill');
				}
				else
				{
				redirect('manage_skill');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-skill-view',$data,true);
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
		$table['name'] = 'td_skill';
		if($this->Common_model->delete_data($table,$id,'skill_id'))
		{
			$this->session->set_flashdata('success_message','Skill has been Deleted successfully.');
			redirect('manage_skill');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_skill');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_skill';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'skill_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Skill successfully deactivated');
				redirect('manage_skill');
			}
		else
			{
				redirect('manage_skill');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_skill';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'skill_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Skill successfully activated');
				redirect('manage_skill');
			}
		else
			{
				redirect('manage_skill');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('skill_name', 'Skill Name', 'required');
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



