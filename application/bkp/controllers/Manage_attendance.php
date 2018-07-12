<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_attendance extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		if(($this->session->userdata('is_admin_logged_in')!=1))

		{

			redirect(base_url());	

		}		
		$this->load->model(array('Common_model'));
		//date_default_timezone_set("Asia/calcutta");
	}

	################################################################

	function index()
	{
		$table['name'] = 'td_attendance';
		$order_by[0] = array('field'=>'attendance_date','type'=>'DESC');
		$data['rows'] = $this->Common_model->find_data($table,'array','','','','','',$order_by);
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-attendance-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}
	function payroll($id)
	{
	    $table['name'] = 'td_company_settings';
		$data['rows_company'] = $this->Common_model->find_data($table,'row','','','','');
		
		$table['name'] = 'td_salary';
		$conditions=array('salary_id'=>$id);
		$select = 'td_salary.*,td_employee_personal_details.*,td_employee_office_details.*,td_department.department_name,td_designation.designation_name';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_salary','field_table_master'=>'emp_id','type'=>'Inner');
		$join[1] = array('table'=>'td_department','field'=>'department_id','table_master'=>'td_employee_personal_details','field_table_master'=>'department_id','type'=>'Inner');
		$join[2] = array('table'=>'td_employee_office_details','field'=>'emp_id','table_master'=>'td_employee_personal_details','field_table_master'=>'emp_id','type'=>'Inner');
		$join[3] = array('table'=>'td_designation','field'=>'designation_id','table_master'=>'td_employee_office_details','field_table_master'=>'designation_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'row','',$conditions,$select,$join,'');	
		
		$data['rows_ern'] = $this->db->query('select * from td_salary_details JOIN td_salary_head ON td_salary_details.salary_head_id=td_salary_head.salary_head_id where td_salary_details.salary_head_type="E" and salary_id='.$id)->result();
		
		$data['rows_ded'] = $this->db->query('select * from td_salary_details JOIN td_salary_head ON td_salary_details.salary_head_id=td_salary_head.salary_head_id where td_salary_details.salary_head_type="D" and salary_id='.$id)->result();
		
		
		
		$this->load->view('maincontents/payroll-view',$data);
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
	
	function salary_statement()
	{
		$this->load->view('maincontents/salary-statement');
	}

	######################################################################################	

	function add()
	{	
		
		$data['action'] = 'Add';
		
		
		$select = 'loc_id,loc_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'loc_name','type'=>'ASC');
		$table['name']='td_company_location';
		$list = array('empty_name'=>' location','key'=>'loc_id','value'=>'loc_name');
		$data['locs']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);		
		
		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{				
				$counter = $this->input->post('counter');
				$branch_id = $this->input->post('branch_id');
				
				
				$fields = array(
								'attendance_date'=>date('Y-m-d'),
								'branch_id'=>$branch_id,
								'published'=>1							
								);
				$present_id = $this->input->post('present_id');	
				if(!empty($present_id)) {				
					$present_id1  = implode(",", $present_id);
					$fields['present_id'] = $present_id1;
				}
				$late_id = $this->input->post('late_id');
				if(!empty($late_id)) {				
					$late_id1  = implode(",", $late_id);
					$fields['late_id'] = $late_id1;
				}
								
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_attendance';
				$data = $this->Common_model->save_data($table,$fields,'','attendance_id');
				if($data)
				{	
					$this->session->set_flashdata('success_message','Attendance successfully inserted');	
					redirect('manage_attendance');					
				}
				else
				{
					redirect('manage_attendance');	
				}				
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-attendance-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}	
	
	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$select = 'loc_id,loc_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'loc_name','type'=>'ASC');
		$table['name']='td_company_location';
		$list = array('empty_name'=>' location','key'=>'loc_id','value'=>'loc_name');
		$data['locs']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);		

		$conditions=array('attendance_id'=>$id);
		$table['name'] = 'td_attendance';
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
				$counter = $this->input->post('counter');
				$branch_id = $this->input->post('branch_id');
				
				
				$fields = array(
								'attendance_date'=>date('Y-m-d'),
								'branch_id'=>$branch_id,
								'published'=>1							
								);
				$present_id = $this->input->post('present_id');	
				if(!empty($present_id)) {				
					$present_id1  = implode(",", $present_id);
					$fields['present_id'] = $present_id1;
				}
				$late_id = $this->input->post('late_id');
				if(!empty($late_id)) {				
					$late_id1  = implode(",", $late_id);
					$fields['late_id'] = $late_id1;
				}
								
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_attendance';
				$data = $this->Common_model->save_data($table,$fields,$id,'attendance_id');
				if($data)
				{	
					$this->session->set_flashdata('success_message','Attendance successfully updated');	
					redirect('manage_attendance');					
				}
				else
				{
					redirect('manage_attendance');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-attendance-view',$data,true);
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
			redirect('manage_attendance');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_attendance');
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
				redirect('manage_attendance');
			}
		else
			{
				redirect('manage_attendance');			
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
				redirect('manage_attendance');
			}
		else
			{
				redirect('manage_attendance');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
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
        if (isset($_POST) && isset($_POST['emp_id'])) 
		{
			$newrow = '<div class="form-group">
							<div class="col-lg-4">
								<strong>Employee Name (Employee Code)</strong>
							</div>
							<div class="col-lg-4">
								<strong>Present</strong>
							</div>
							<div class="col-lg-4">
								<strong>Late</strong>
							</div>
              		</div>';
			  
            $loc_id = $_POST['emp_id'];
			$action = $_POST['action'];
			$id = $_POST['id'];
			
			$newrow .= '<input type="hidden" class="styled" name="branch_id" value="'.$loc_id.'">';	
			
			$emp_details = $this->db->query("select * from td_employee_office_details where location='$loc_id' and published=1")->result();	
			$i=0;
			
			$attendance_details = $this->db->query("select * from td_attendance where attendance_id='$id' and published=1")->row();	
			$present_id = $attendance_details->present_id;
			$present_id1 = explode(",", $present_id);
			$late_id = $attendance_details->late_id;
			$late_id1 = explode(",", $late_id);
			
			if($emp_details) { foreach($emp_details as $emp_detail) {
				$aa = $emp_detail->emp_id;
				$emp  = $this->db->query("select * from td_employee_personal_details where emp_id='$aa'")->row();				
				$newrow .= '<div class="form-group">
								<div class="col-lg-4">
									'.$emp->emp_name.' ('.$emp->emp_code.')
								</div>
								<div class="col-lg-4">
									<input type="checkbox" ';
										if($action=='Add') {					
										$newrow .= 'checked="checked"';
										}
										if($action=='Edit') {
											if (in_array($aa, $present_id1)) {
												$newrow .= 'checked="checked"';
											}
										}
				
										$newrow .= 'class="styled" name="present_id[]" value="'.$emp_detail->emp_id.'">
								</div>
								<div class="col-lg-4">
									<input type="checkbox" ';
										if($action=='Add') {					
										$newrow .= 'checked="checked"';
										}
										if($action=='Edit') {
											if (in_array($aa, $late_id1)) {
												$newrow .= 'checked="checked"';
											}
										}
				
										$newrow .= 'class="styled" name="late_id[]" value="'.$emp_detail->emp_id.'">
								</div>
              				</div>';
							
				
				$i++;			
			 } 
			 $newrow .= '<input type="hidden" class="styled" name="counter" value="'.($i-1).'">';
			 }
			echo $newrow;		
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
			$newrow = '<div class="form-group">
							<div class="col-lg-4">
								<strong>Employee Name (Employee Code)</strong>
							</div>
							<div class="col-lg-4">
								<strong>Present</strong>
							</div>
							<div class="col-lg-4">
								<strong>Late</strong>
							</div>
              		</div>';
			  
            $loc_id = $_POST['emp_id'];
			$newrow .= '<input type="hidden" class="styled" name="branch_id" value="'.$loc_id.'">';	
			
			$emp_details = $this->db->query("select * from td_employee_office_details where location='$loc_id' and published=1")->result();	
			$i=0;
			if($emp_details) { foreach($emp_details as $emp_detail) {
				$aa = $emp_detail->emp_id;
				$emp  = $this->db->query("select * from td_employee_personal_details where emp_id='$aa'")->row();				
				$newrow .= '<div class="form-group">
								<div class="col-lg-4">
									'.$emp->emp_name.' ('.$emp->emp_code.')
								</div>
								<div class="col-lg-4">
									<input type="checkbox" checked="checked" class="styled" name="present_id[]" value="'.$emp_detail->emp_id.'">
								</div>
								<div class="col-lg-4">
									<input type="checkbox" class="styled" name="late_id[]" value="'.$emp_detail->emp_id.'">
								</div>
              				</div>';
							
				
				$i++;			
			 } 
			 $newrow .= '<input type="text" class="styled" name="counter" value="'.($i-1).'">';
			 }
			echo $newrow;		
        } 
		else
		{
            redirect('site'); 
        }
    }
	
	##################################################################################################
}