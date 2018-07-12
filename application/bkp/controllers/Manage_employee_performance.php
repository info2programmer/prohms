<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_employee_performance extends CI_Controller {
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
		$table['name'] = 'td_employee_performance';
		$order_by[0] = array('field'=>'td_employee_performance.emp_performance_id','type'=>'ASC');
		$select = 'td_employee_performance.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_employee_performance','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-employee-performance-list-view',$data,true);
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
				'published'		=> 1
				);				
				$table['name'] = 'td_employee_performance';
				$data = $this->Common_model->save_data($table,$fields,'','emp_performance_id');
				if($data)
				{
					$insert_id = $this->db->insert_id();
					$sets=$this->input->post('num');
					$total = 0;
					for($loop=0;$loop<$sets;$loop++)
					{
						$sale_details = $_REQUEST['sale_details'];
						$sale_amount = $_REQUEST['sale_amount'];
						$sale_note = $_REQUEST['sale_note'];
						
						
						$total += $sale_amount[$loop];
						
						$postdata2 = array(
									'sale_details'=>implode(",", $sale_details),
									'sale_amount'=>implode(",", $sale_amount),
									'sale_note'=>implode(",", $sale_note),
									'sale_total'=>$total
								);
					}
					//echo '<pre>';print_r($postdata2);die;				
					$success2 = $this->Common_model->save_data($table,$postdata2,$insert_id,'emp_performance_id');
					if($success2) { 	
						$this->session->set_flashdata('success_message','Employee performance successfully inserted');	
						redirect('manage_employee_performance');
					}
				}
				else
				{
					redirect('manage_employee_performance');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-performance-view',$data,true);
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
		$table['name'] = 'td_employee_performance';
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

				$table['name'] = 'td_employee_performance';
				$data = $this->Common_model->save_data($table,$fields,$id,'designation_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Designation successfully updated');	
				redirect('manage_employee_performance');
				}
				else
				{
				redirect('manage_employee_performance');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-performance-view',$data,true);
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
		$table['name'] = 'td_employee_performance';
		if($this->Common_model->delete_data($table,$id,'emp_performance_id'))
		{
			$this->session->set_flashdata('success_message','Employee performance has been Deleted successfully.');
			redirect('manage_employee_performance');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_employee_performance');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_employee_performance';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'emp_performance_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee performance successfully deactivated');
				redirect('manage_employee_performance');
			}
		else
			{
				redirect('manage_employee_performance');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_employee_performance';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'emp_performance_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee performance successfully activated');
				redirect('manage_employee_performance');
			}
		else
			{
				redirect('manage_employee_performance');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('from_date', 'From date', 'required');
		$this->form_validation->set_rules('to_date', 'To date', 'required');
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