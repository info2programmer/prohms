<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_location extends CI_Controller {
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
		$table['name'] = 'td_company_location';
		$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-location-list-view',$data,true);
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
				'loc_name' => $this->input->post('loc_name'),
				'loc_address' => $this->input->post('loc_address'),
				'loc_phone' => $this->input->post('loc_phone'),
				'loc_email' => $this->input->post('loc_email'),
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_company_location';
				$data = $this->Common_model->save_data($table,$fields,'','loc_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Location successfully inserted');	
				redirect('manage_location');
				}
				else
				{
				redirect('manage_location');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-location-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';		

		$conditions=array('loc_id'=>$id);
		$table['name'] = 'td_company_location';
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
				'loc_name' => $this->input->post('loc_name'),
				'loc_address' => $this->input->post('loc_address'),
				'loc_phone' => $this->input->post('loc_phone'),
				'loc_email' => $this->input->post('loc_email'),
				'published'		=> 1
				);	

				$table['name'] = 'td_company_location';
				$data = $this->Common_model->save_data($table,$fields,$id,'loc_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Location successfully updated');	
				redirect('manage_location');
				}
				else
				{
				redirect('manage_location');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-location-view',$data,true);
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
		$table['name'] = 'td_company_location';
		if($this->Common_model->delete_data($table,$id,'loc_id'))
		{
			$this->session->set_flashdata('success_message','Location has been Deleted successfully.');
			redirect('manage_location');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_location');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_company_location';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'loc_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Location successfully deactivated');
				redirect('manage_location');
			}
		else
			{
				redirect('manage_location');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_company_location';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'loc_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Location successfully activated');
				redirect('manage_location');
			}
		else
			{
				redirect('manage_location');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('loc_name', 'Location Name', 'required');
		$this->form_validation->set_rules('loc_address', 'Address', 'required');
		$this->form_validation->set_rules('loc_phone', 'Phone', 'required');
		$this->form_validation->set_rules('loc_email', 'Email', 'required');
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



