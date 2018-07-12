<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_leave_allocation extends CI_Controller {
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
		$table['name'] = 'td_leave_allocation';
		$order_by[0] = array('field'=>'td_leave_allocation.leave_allocation_id','type'=>'ASC');
		$select = 'td_leave_allocation.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_leave_allocation','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);
		//$data['rows'] = $this->Common_model->find_data($table,'array');

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-leave-allocation-list-view',$data,true);
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
				$table['name'] = 'td_leave_allocation';
				$data = $this->Common_model->save_data($table,$fields,'','leave_allocation_id');
				if($data)
				{						
					$insert_id = $this->db->insert_id();					
					$sets = $this->db->query("select * from td_leave where published=1")->num_rows(); 
					
					for($loop=0;$loop<$sets;$loop++)
					{
						$leave_id = $_REQUEST['leave_id'];
						$number_of_leave = $_REQUEST['number_of_leave'];
						
						$postdata2 = array(
									'leave_allocation_id'=>$insert_id,
									'leave_id'=>$leave_id[$loop],
									'number_of_leave'=>$number_of_leave[$loop],
									'leave_balance'=>$number_of_leave[$loop],
									'published'=>1
								);
						$table1['name'] = 'td_leave_allocation_details';		
						$success = $this->Common_model->save_data($table1,$postdata2,'','leave_allocation_details_id');		
					}				
					if($success) 
					{ 
						$this->session->set_flashdata('success_message','Leave Allocation details successfully inserted');	
						redirect('manage_leave_allocation');
					}
				}
				else
				{
					redirect('manage_leave_allocation');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-leave-allocation-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';	

		$conditions=array('leave_allocation_id'=>$id);
		$table['name'] = 'td_leave_allocation';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
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
				'emp_id' => $this->input->post('emp_id'),
				'from_date' => date_format(date_create($this->input->post('from_date')), "Y-m-d"),
				'to_date' => date_format(date_create($this->input->post('to_date')), "Y-m-d")
				);
				$table['name'] = 'td_leave_allocation';
				$data = $this->Common_model->save_data($table,$fields,$id,'leave_allocation_id');
				//if($data)
//				{						
					//$insert_id = $this->db->insert_id();					
					$sets = $this->db->query("select * from td_leave where published=1")->num_rows(); 
					
					for($loop=0;$loop<$sets;$loop++)
					{
						$leave_id = $_REQUEST['leave_id'];
						$number_of_leave = $_REQUEST['number_of_leave'];
								
						$table1['name'] = 'td_leave_allocation_details';
						$success = $this->db->query("UPDATE `td_leave_allocation_details` SET `number_of_leave`='$number_of_leave[$loop]' WHERE `leave_allocation_id`='$id' AND `leave_id`='$leave_id[$loop]'");
					}				
					if($success) 
					{ 
						$this->session->set_flashdata('success_message','Leave Allocation details successfully updated');	
						redirect('manage_leave_allocation');
					}
				//}
					else
					{
						redirect('manage_leave_allocation');	
					}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-leave-allocation-view',$data,true);
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
		$table['name'] = 'td_leave_allocation';
		if($this->Common_model->delete_data($table,$id,'leave_allocation_id'))
		{
			$this->session->set_flashdata('success_message','Leave allocation has been Deleted successfully.');
			redirect('manage_leave_allocation');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_leave_allocation');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_leave_allocation';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'leave_allocation_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Leave allocation successfully deactivated');
				redirect('manage_leave_allocation');
			}
		else
			{
				redirect('manage_leave_allocation');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_leave_allocation';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'leave_allocation_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Leave allocation successfully activated');
				redirect('manage_leave_allocation');
			}
		else
			{
				redirect('manage_leave_allocation');
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