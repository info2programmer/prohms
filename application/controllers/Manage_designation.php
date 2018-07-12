<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_designation extends CI_Controller {
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
		$table['name'] = 'td_designation';
		$order_by[0] = array('field'=>'td_designation.designation_name','type'=>'ASC');
		$select = 'td_designation.*,td_department.department_name';
		$join[0] = array('table'=>'td_department','field'=>'department_id','table_master'=>'td_designation','field_table_master'=>'department_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-designation-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################	

	function add()
	{	

		$data['action'] = 'Add';
		
		$select = 'department_id,department_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'department_id','type'=>'ASC');
		$table['name']='td_department';
		$list = array('empty_name'=>' department Name','key'=>'department_id','value'=>'department_name');
		$data['departments']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$fields = array(
				'department_id' => $this->input->post('department_id'),
				'designation_name' => $this->input->post('designation_name'),
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_designation';
				$data = $this->Common_model->save_data($table,$fields,'','designation_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Designation successfully inserted');	
				redirect('manage_designation');
				}
				else
				{
				redirect('manage_designation');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-designation-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$select = 'department_id,department_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'department_id','type'=>'ASC');
		$table['name']='td_department';
		$list = array('empty_name'=>' department Name','key'=>'department_id','value'=>'department_name');
		$data['departments']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);		

		$conditions=array('designation_id'=>$id);
		$table['name'] = 'td_designation';
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
				'department_id' => $this->input->post('department_id'),
				'designation_name' => $this->input->post('designation_name'),
				'published'		=> 1
				);	

				$table['name'] = 'td_designation';
				$data = $this->Common_model->save_data($table,$fields,$id,'designation_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Designation successfully updated');	
				redirect('manage_designation');
				}
				else
				{
				redirect('manage_designation');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-designation-view',$data,true);
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
		$table['name'] = 'td_designation';
		if($this->Common_model->delete_data($table,$id,'designation_id'))
		{
			$this->session->set_flashdata('success_message','Designation has been Deleted successfully.');
			redirect('manage_designation');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_designation');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_designation';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'designation_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Designation successfully deactivated');
				redirect('manage_designation');
			}
		else
			{
				redirect('manage_designation');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_designation';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'designation_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Designation successfully activated');
				redirect('manage_designation');
			}
		else
			{
				redirect('manage_designation');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('department_id', 'Department Name', 'required');
		$this->form_validation->set_rules('designation_name', 'Designation Name', 'required');
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



