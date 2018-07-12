<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_discipline extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(($this->session->userdata('is_admin_logged_in')!=1)&&($this->session->userdata('is_user_logged_in1')!=1))

		{

			redirect(base_url());	

		}		
		$this->load->model(array('Common_model'));
	}

	################################################################

	function index()
	{
		$table['name'] = 'discipline';
		$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/manage-discipline-list-view',$data,true);
		$this->load->view('admin/layout-after-login',$data);
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
				'college_category' => $this->input->post('college_category'),
				'discipline_name' => $this->input->post('discipline_name'),
				'published'		=> 1
				);
				$table['name'] = 'discipline';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Department successfully inserted');	
				redirect('admin/manage_discipline');
				}
			}
		}

		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-discipline-view',$data,true);
		$this->load->view('admin/layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';		

		$conditions=array('discipline_id'=>$id);
		$table['name'] = 'discipline';
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
				'college_category' => $this->input->post('college_category'),
				'discipline_name' => $this->input->post('discipline_name'),
				'published'		=> 1
				);	

				$table['name'] = 'discipline';
				$data = $this->Common_model->save_data($table,$fields,$id,'discipline_id');
				$this->session->set_flashdata('success_message','Department successfully updated');	
				redirect('admin/manage_discipline');
			}
		}

		

		$data['head'] = $this->load->view('admin/elements/head','',true);
		$data['header'] = $this->load->view('admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-discipline-view',$data,true);
		$this->load->view('admin/layout-after-login',$data);
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
		$table['name'] = 'discipline';
		if($this->Common_model->delete_data($table,$id,'discipline_id'))
		{
			$this->session->set_flashdata('success_message','Department has been Deleted successfully.');
			redirect('admin/manage_discipline');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('admin/manage_discipline');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'discipline';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'discipline_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Department successfully deactivated');
				redirect('admin/manage_discipline');
			}
		else
			{
				redirect('admin/manage_discipline');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'discipline';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'discipline_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Department successfully activated');
				redirect('admin/manage_discipline');
			}
		else
			{
				redirect('admin/manage_discipline');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('college_category', 'College Category', 'required');
		$this->form_validation->set_rules('discipline_name', 'Discipline Name', 'required');
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



