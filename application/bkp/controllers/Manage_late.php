<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_late extends CI_Controller {
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
		$table['name'] = 'td_late';
		$order_by[0] = array('field'=>'td_late.late_id','type'=>'ASC');
		$select = 'td_late.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_late','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-late-list-view',$data,true);
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
				'from_date' => date_format(date_create($this->input->post('from_date')), "Y-m-d"),
				'to_date' => date_format(date_create($this->input->post('to_date')), "Y-m-d"),
				'late' => $this->input->post('late'),
				'half_day' => $this->input->post('half_day'),
				'published'		=> 1
				);				
				$table['name'] = 'td_late';
				$data = $this->Common_model->save_data($table,$fields,'','late_id');
				if($data)
				{						
					$this->session->set_flashdata('success_message','Late successfully inserted');	
					redirect('manage_late');
					
				}
				else
				{
					redirect('manage_late');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-late-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';
		
		/*$select = 'department_id,department_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'department_id','type'=>'ASC');
		$table['name']='td_department';
		$list = array('empty_name'=>' department Name','key'=>'department_id','value'=>'department_name');
		$data['departments']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);*/		

		$conditions=array('late_id'=>$id);
		$table['name'] = 'td_late';
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
				'from_date' => date_format(date_create($this->input->post('from_date')), "Y-m-d"),
				'to_date' => date_format(date_create($this->input->post('to_date')), "Y-m-d"),
				'late' => $this->input->post('late'),
				'half_day' => $this->input->post('half_day'),
				'published'		=> 1
				);	

				$table['name'] = 'td_late';
				$data = $this->Common_model->save_data($table,$fields,$id,'late_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Late successfully updated');	
				redirect('manage_late');
				}
				else
				{
				redirect('manage_late');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-late-view',$data,true);
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
		$table['name'] = 'td_late';
		if($this->Common_model->delete_data($table,$id,'late_id'))
		{
			$this->session->set_flashdata('success_message','Late has been Deleted successfully.');
			redirect('manage_late');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_late');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_late';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'late_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Late successfully deactivated');
				redirect('manage_late');
			}
		else
			{
				redirect('manage_late');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_late';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'late_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Late successfully activated');
				redirect('manage_late');
			}
		else
			{
				redirect('manage_late');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('from_date', 'From date', 'required');
		$this->form_validation->set_rules('to_date', 'To date', 'required');
		$this->form_validation->set_rules('late', 'Late number', 'required');
		$this->form_validation->set_rules('half_day', 'Half day', 'required');
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