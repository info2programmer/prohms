<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_salary extends CI_Controller {
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
		$table['name'] = 'td_leave_assign';
		$group_by[0] = 'td_leave_assign.emp_id';
		/*$order_by[0] = array('field'=>'td_leave_assign.leave_assign_id','type'=>'ASC');
		$select = 'td_leave_assign.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_leave_assign','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by,$group_by);*/
		$data['rows'] = $this->Common_model->find_data($table,'array','','','','',$group_by);
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-salary-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}
	
	function leave_details($id)
	{
		$data['emp_per'] = $this->db->query("select * from td_employee_personal_details where emp_id='$id' and published=1")->row();
		$data['rows'] = $this->db->query("select * from td_leave_assign where emp_id='$id' and published=1")->result();
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/leave-details-view',$data,true);
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
				'leave_date' => date_format(date_create($this->input->post('leave_date')), "Y-m-d"),
				'leave_type' => $this->input->post('leave_type'),
				'published'	=> 1
				);
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_leave_assign';
				$data = $this->Common_model->save_data($table,$fields,'','leave_assign_id');
				if($data)
				{	
					$leave_allocation_id = $this->input->post('leave_type');
					$allot_details = $this->db->query("select * from td_leave_allocation_details where leave_allocation_details_id='$leave_allocation_id'")->row();
					$old_leave_balance = $allot_details->leave_balance;
					$new_leave_balance = $old_leave_balance-1;
					$fields1 = array(						
						'leave_balance'	=> $new_leave_balance
					);
					//echo '<pre>';print_r($fields);die;				
					$table1['name'] = 'td_leave_allocation_details';
					$data = $this->Common_model->save_data($table1,$fields1,$leave_allocation_id,'leave_allocation_details_id');
					$this->session->set_flashdata('success_message','Leave assign successfully inserted');	
					redirect('manage_leave_assign');					
				}
				else
				{
					redirect('manage_leave_assign');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-salary-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';	

		$conditions=array('leave_assign_id'=>$id);
		$table['name'] = 'td_leave_assign';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		$data['id'] = $id;
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
				'leave_date' => date_format(date_create($this->input->post('leave_date')), "Y-m-d"),
				'leave_type' => $this->input->post('leave_type'),
				'published'	=> 1
				);
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_leave_assign';
				$data = $this->Common_model->save_data($table,$fields,$id,'leave_assign_id');
				if($data)
				{	
					$this->session->set_flashdata('success_message','Leave assign successfully updated');	
					redirect('manage_leave_assign');					
				}
				else
				{
					redirect('manage_leave_assign');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-salary-view',$data,true);
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
		$table['name'] = 'td_leave_assign';
		if($this->Common_model->delete_data($table,$id,'leave_assign_id'))
		{
			$this->session->set_flashdata('success_message','Leave allocation has been Deleted successfully.');
			redirect('manage_leave_assign');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_leave_assign');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_leave_assign';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'leave_assign_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Leave allocation successfully deactivated');
				redirect('manage_leave_assign');
			}
		else
			{
				redirect('manage_leave_assign');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_leave_assign';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'leave_assign_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Leave allocation successfully activated');
				redirect('manage_leave_assign');
			}
		else
			{
				redirect('manage_leave_assign');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('leave_date', 'Leave date', 'required');
		$this->form_validation->set_rules('leave_type', 'Leave type', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function ajax_call() 
	{
        //Checking so that people cannot go to the page directly.
        if (isset($_POST) && isset($_POST['emp_id'])) 
		{
            $emp_id = $_POST['emp_id'];
			$from_date = date_format(date_create($_POST['from_date']), "Y-m-d");
			$to_date = date_format(date_create($_POST['to_date']), "Y-m-d");
			
			$emp_details = $this->db->query("select * from td_employee_office_details where emp_id='$emp_id'")->row();
			$emp_type = $emp_details->emp_type;
			$action = $_POST['action'];
			if($emp_type=='Full Time') {
				$new_row = '<div class="form-group">
                				<label class="control-label col-lg-3">Basic Pay <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="number" name="basic_pay" value="" class="form-control" placeholder="Enter Basic Pay">
                				</div>
              				</div>
							<div class="form-group">
                				<label class="control-label col-lg-6">Earning <hr /></label>
                				<label class="control-label col-lg-6">Deduction <hr /></label>
              				</div>
              				<div>
							<div class="col-lg-6">';
			$salary_dead_details1 = $this->db->query("select * from td_salary_head where emp_type='S' and salary_head_type='E'")->result();			
			if($salary_dead_details1) { foreach($salary_dead_details1 as $head1) { 	
				$new_row .=	'<input type="checkbox" class="styled" value="'.$head1->salary_head_id.'">  '.$head1->salary_head_name.'
				<input type="number" name="working_hours" value="" placeholder="Enter '.$head1->salary_head_name.'">
				<br />';
			} }
				$new_row .=	'</div>';
				
				$new_row .=	'<div class="col-lg-6">';
			$salary_dead_details2 = $this->db->query("select * from td_salary_head where emp_type='S' and salary_head_type='D'")->result();			
			if($salary_dead_details2) { foreach($salary_dead_details2 as $head2) {
				$new_row .=	'<input type="checkbox" class="styled" value="'.$head2->salary_head_id.'">  '.$head2->salary_head_name.'
				<input type="number" name="working_hours" value="" placeholder="Enter '.$head2->salary_head_name.'">
				<br />';
			} }	
				$new_row .=	'</div>				
             				</div>';
				$lv_allot = $this->db->query("select * from td_leave_allocation where emp_id='$emp_id'")->row();
				$leave_allocation_id = $lv_allot->leave_allocation_id;
				$lv_allot_details = $this->db->query("select * from td_leave_allocation_details where leave_allocation_id='$leave_allocation_id'")->result();										
				$new_row .=	'<div class="form-group">
					<label class="control-label col-lg-12">';
				if($lv_allot_details) { foreach($lv_allot_details as $lv_allot_detail) {
					$leave_id = $lv_allot_detail->leave_id;
					$leave_allocation_details_id = $lv_allot_detail->leave_allocation_details_id;					
					$leave_detail = $this->db->query("select * from td_leave where leave_id='$leave_id'")->row();
					$leave_assign = $this->db->query("select * from td_leave_assign where emp_id='$emp_id' and leave_date>='$from_date' and leave_date<='$to_date' and leave_type='$leave_allocation_details_id'")->num_rows();
				$new_row .=	'<input type="hidden" name="emp_id[]" value="'.$emp_id.'">
							 <input type="hidden" name="leave_id[]" value="'.$leave_id.'">
							 <input type="hidden" name="leave_taken[]" value="'.$leave_assign.'">
							 <input type="hidden" name="leave_balance[]" value="'.$lv_allot_detail->leave_balance.'">
				'; 
					
					
				$new_row .=	'<strong>'.$leave_detail->leave_name.' taken : </strong>'.$leave_assign.'  <strong>'.$leave_detail->leave_name.' balance : </strong>'.$lv_allot_detail->leave_balance.'<br>';
				} }
				$new_row .=	'</label>
				</div>';
			}
			else {
				$new_row = '<div class="form-group">
                				<label class="control-label col-lg-3">Rate Per Hour <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="number" name="rate_per_hour" value="" class="form-control" placeholder="Enter Rate Per Hour">
                				</div>
              				</div>
							<div class="form-group">
                				<label class="control-label col-lg-3">Working Hours <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="number" name="working_hours" value="" class="form-control" placeholder="Enter Working Hours">
                				</div>
              				</div>							
							<div class="form-group">
                				<label class="control-label col-lg-6">Earning <hr /></label>
                				<label class="control-label col-lg-6">Deduction <hr /></label>
              				</div>
							<div>
							<div class="col-lg-6">';
			$salary_dead_details3 = $this->db->query("select * from td_salary_head where emp_type='U' and salary_head_type='E'")->result();			
			if($salary_dead_details3) { foreach($salary_dead_details3 as $head3) { 	
				$new_row .=	'<input type="checkbox" class="styled" value="'.$head3->salary_head_id.'">'.$head3->salary_head_name.'
				<input type="number" name="working_hours" value="" placeholder="Enter '.$head3->salary_head_name.'">
				<br />';
			} }
				$new_row .=	'</div>';
				
				$new_row .=	'<div class="col-lg-6">';
			$salary_dead_details4 = $this->db->query("select * from td_salary_head where emp_type='U' and salary_head_type='D'")->result();			
			if($salary_dead_details4) { foreach($salary_dead_details4 as $head4) {
				$new_row .=	'<input type="checkbox" class="styled" value="'.$head4->salary_head_id.'">'.$head4->salary_head_name.'
				<input type="number" name="working_hours" value="" placeholder="Enter '.$head4->salary_head_name.'">
				<br />';
			} }	
				$new_row .=	'</div>
             				</div>';
			}	
			echo $new_row;
        } 
		else
		{
            redirect('site'); 
        }
    }
	
	function ajax_call_default() 
	{
        if (isset($_POST) && isset($_POST['emp_id'])) 
		{
			$action = $_POST['action'];
			echo $id = $_POST['id'];
			$arrCities = $this->db->query("SELECT * FROM  `td_leave_assign` where leave_assign_id='$id' and published=1")->result();
		
			$dropdown = '<select name="leave_type" data-placeholder="Select a Leave type" class="form-control">
                    	<option value="" selected="selected" hidden>Select a Leave type</option>';
			if($arrCities) { foreach($arrCities as $a) {
				$lv_id = $a->leave_type;
				$lv_details = $this->db->query("select * from td_leave where leave_id='$lv_id'")->row();		
              	$dropdown .= '<option value="'.$a->leave_assign_id.'">'.$lv_details->leave_name.'</option>';
			} }
            $dropdown .= '</select>';
			echo $dropdown;
        } 
		else
		{
            redirect('site'); 
        }
    }
	##################################################################################################
}