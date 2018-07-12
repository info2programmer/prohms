<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_salary extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		if(($this->session->userdata('is_admin_logged_in2')!=1))

		{

			redirect(base_url());	

		}		
		$this->load->model(array('Common_model'));
	}

	################################################################

	function index()
	{
		$table['name'] = 'td_salary';
		$order_by[0] = array('field'=>'salary_id','type'=>'DESC');
		/*$select = 'td_leave_assign.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_leave_assign','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by,$group_by);*/
		$data['rows'] = $this->Common_model->find_data($table,'array','','','','','',$order_by);
		
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/manage-salary-list-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}
	
	public function employee_salary()
	{
		$emp_id = $this->session->userdata('user_id1');
		
		if($this->input->post('mode')=='tab') {
			$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
			$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
			$conditions = array('from_date>='=> $from_date,'to_date<='=> $to_date,'emp_id'=>$emp_id);
			$table['name'] = 'td_salary';
			$data['rows'] = $this->Common_model->find_data($table,'array','',$conditions);
		}
		else
		{
			$data['rows'] = array();	
		}
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/employee-salary-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}
	
	function salary_report()
	{
		if($this->input->post('mode')=='tab')
		{
			$from_date = $this->input->post('from_date');
			$to_date = $this->input->post('to_date');
			$table['name'] = 'td_salary';
			$conditions = array('td_salary.salary_date>='=>$from_date,'td_salary.salary_date<='=>$to_date);
			$order_by[0] = array('field'=>'td_salary.salary_id','type'=>'DESC');
			$select = 'td_salary.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
			$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_salary','field_table_master'=>'salary_id','type'=>'Inner');
			$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);
		}
		else
		{
			$data['rows'] = array();
		}
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/salary-report-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}
	
	function payroll($id)
	{
	    $table['name'] = 'td_company_settings';
		$data['rows_company'] = $this->Common_model->find_data($table,'row','','','','');
		$data['id'] = $id;
		
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
		
		
		
		$this->load->view('master-admin/maincontents/payroll-view',$data);
	}
	function leave_details($id)
	{
		$data['emp_per'] = $this->db->query("select * from td_employee_personal_details where emp_id='$id' and published=1")->row();
		$data['rows'] = $this->db->query("select * from td_leave_assign where emp_id='$id' and published=1")->result();
		
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/leave-details-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}
	
	function salary_statement()
	{
		$this->load->view('master-admin/maincontents/salary-statement');
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
				'emp_type' => $this->input->post('emp_type'),
				'from_date' => date_format(date_create($this->input->post('from_date')), "Y-m-d"),
				'to_date' => date_format(date_create($this->input->post('to_date')), "Y-m-d"),
				'salary_date' => date('Y-m-d'),
				'basic_pay' => $this->input->post('basic_pay'),
				'rate_per_hour' => $this->input->post('rate_per_hour'),
				'working_hours' => $this->input->post('working_hours'),
				'cheque_no' => $this->input->post('cheque_no'),
				'transaction_id' => $this->input->post('transaction_id'),
				'published'	=> 1
				);
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_salary';
				$data = $this->Common_model->save_data($table,$fields,'','salary_id');
				if($data)
				{
					$insert_id = $this->db->insert_id();
					$salary_head_id = $this->input->post('salary_head_id');
					//echo '<pre>';print_r($salary_head_id);
					
					$sal_heads = implode(",", $salary_head_id);
					$emp_id = $this->input->post('emp_id');
					$fields3 = array(
									'emp_id' => $emp_id,
									'basic_pay' => $this->input->post('basic_pay'),
									'rate_per_hour' => $this->input->post('rate_per_hour'),
									'emp_type' => $this->input->post('emp_type'),
									'sal_heads'	=> $sal_heads
									);
					$table['name'] = 'td_emp_salary';
									
					$emp_salary = $this->db->query("select * from td_emp_salary where emp_id='$emp_id'")->row();
					if($emp_salary)
					{
						$emp_sal_id = $emp_salary->emp_sal_id;
						$emp_salary_update = $this->Common_model->save_data($table,$fields3,$emp_sal_id,'emp_sal_id');
					}
					else
					{
						$emp_salary_insert = $this->Common_model->save_data($table,$fields3,'','emp_sal_id');
					}
					
					foreach($salary_head_id as $salary_head_id)
					{
						$salary_head_details = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id'")->row();
						if($salary_head_id==1) { $salary_head_value = $this->input->post('basic_pay'); }
						else {
							if($salary_head_details->is_fixed_percent) {
							$percent_rate = $salary_head_details->percent_rate;	
							$basic_pay = $this->input->post('basic_pay');
							$salary_head_value = ($basic_pay*$percent_rate)/100;
							}
							else
							{ $salary_head_value = 0.00; } 
						}
						$fields = array(
										'salary_id' => $insert_id,
										'salary_head_id' => $salary_head_id,
										'salary_head_type' => $salary_head_details->salary_head_type,
										'salary_head_value' => $salary_head_value
										);				
						$table['name'] = 'td_salary_details';
						$success = $this->Common_model->save_data($table,$fields,'','salary_details_id');
						
						
					}
					redirect('master-admin/manage_salary/salary_confirm/'.$insert_id);					
				}
				else
				{
					redirect('master-admin/manage_leave_assign');	
				}
			}
		}

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-salary-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}
	
	function salary_confirm($id)
	{
		$data['action'] = 'Add';
		
		$conditions=array('salary_id'=>$id);
		$table['name'] = 'td_salary';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		$data['id'] = $id;
		$data['emp_id'] = $data['row']->emp_id;
		$data['from_date'] = $data['row']->from_date;
		$data['to_date'] = $data['row']->to_date;
		
		if($this->input->post('mode')=='tab')
		{
			
			$salary_head_values = $this->input->post('salary_head_value');
			$salary_head_ids = $this->input->post('salary_head_id');
			
			for($i=0;$i<count($salary_head_values);$i++)
			{
				    $salary_head_value=$salary_head_values[$i];
					$salary_head_id=$salary_head_ids[$i];
					$success = $this->db->query("UPDATE `td_salary_details` SET `salary_head_value`='$salary_head_value' WHERE `salary_id`='$id' and `salary_head_id`='$salary_head_id'");

			}

			
			if($success)
			{
				$emp_type= $data['row']->emp_type;
				
				if($emp_type=='S') {
					
					$total_earning = $this->db->query("SELECT SUM( salary_head_value ) as total_sal_earning FROM  `td_salary_details` WHERE salary_id ='$id' and salary_head_type='E'")->row();
					$total_sal_ear = $total_earning->total_sal_earning;
					$total_deduction = $this->db->query("SELECT SUM( salary_head_value ) as total_sal_deduction FROM  `td_salary_details` WHERE salary_id ='$id' and salary_head_type='D'")->row();
					$total_sal_deduct = $total_deduction->total_sal_deduction;
					$final_total = $total_sal_ear-$total_sal_deduct;
					
					$success1 = $this->db->query("UPDATE `td_salary` SET `total_salary`='$final_total' WHERE `salary_id`='$id'");
					redirect('manage_salary');
				}
				else 
				{
					/*$total = $this->db->query("SELECT SUM( salary_head_value ) as total_sal FROM  `td_salary_details` WHERE salary_id ='$id'")->row();
					$total_sal = $total->total_sal;
					$working_hour_payment = ($data['row']->rate_per_hour*$data['row']->working_hours);
					$total_earning = $this->db->query("SELECT SUM( salary_head_value ) as total_sal_earning FROM  `td_salary_details` WHERE salary_id ='$id' and salary_head_type='E'")->row();
					$total_sal_ear = $total_earning->total_sal_earning;
					$total_deduction = $this->db->query("SELECT SUM( salary_head_value ) as total_sal_deduction FROM  `td_salary_details` WHERE salary_id ='$id' and salary_head_type='D'")->row();
					$total_sal_deduct = $total_deduction->total_sal_deduction;
					$final_total = $total_sal_ear+$working_hour_payment-$total_sal_deduct;*/
					$total_earning = $this->db->query("SELECT SUM( salary_head_value ) as total_sal_earning FROM  `td_salary_details` WHERE salary_id ='$id' and salary_head_type='E'")->row();
					$total_sal_ear = $total_earning->total_sal_earning;
					$total_deduction = $this->db->query("SELECT SUM( salary_head_value ) as total_sal_deduction FROM  `td_salary_details` WHERE salary_id ='$id' and salary_head_type='D'")->row();
					$total_sal_deduct = $total_deduction->total_sal_deduction;
					$final_total = $total_sal_ear-$total_sal_deduct;
					
					$success1 = $this->db->query("UPDATE `td_salary` SET `total_salary`='$final_total' WHERE `salary_id`='$id'");
					redirect('master-admin/manage_salary');
				}
			}
		}
		
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-salary2-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
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
					redirect('master-admin/manage_leave_assign');					
				}
				else
				{
					redirect('master-admin/manage_leave_assign');	
				}
			}
		}

		

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-salary-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
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
			redirect('master-admin/manage_leave_assign');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('master-admin/manage_leave_assign');
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
				redirect('master-admin/manage_leave_assign');
			}
		else
			{
				redirect('master-admin/manage_leave_assign');			
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
				redirect('master-admin/manage_leave_assign');
			}
		else
			{
				redirect('master-admin/manage_leave_assign');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('from_date', 'From date', 'required');
		$this->form_validation->set_rules('to_date', 'To type', 'required');
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
			$emp_type = $emp_details->emp_skill;
			$action = $_POST['action'];
			
			$emp_sal_details = $this->db->query("select * from td_emp_salary where emp_id='$emp_id'")->row();
			if($emp_sal_details)
			{
				$sal_heads = $emp_sal_details->sal_heads;
				$sal_heads = explode(",", $sal_heads);
				//print_r($sal_heads);die;
				if($emp_sal_details->emp_type=='S')
				{ $basic_pay = $emp_sal_details->basic_pay; }
				else
				{ $rate_per_hour = $emp_sal_details->rate_per_hour; }	
			}
			else
			{
				$basic_pay = '';
				$rate_per_hour = '';
				$sal_heads = array();	
			}
			
			if($emp_type=='S') {
				$new_row = '<div class="form-group">
                				<label class="control-label col-lg-3">Regular Earnings <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="number" name="basic_pay" value="'.$basic_pay.'" class="form-control" placeholder="Enter Regular Earnings">
									<input type="hidden" name="emp_type" value="'.$emp_type.'" class="form-control" placeholder="Enter employee type">
                				</div>
              				</div>';
				if($emp_details->payment_mode=='Cheque') { 
				$new_row .= '<div class="form-group">
                				<label class="control-label col-lg-3">Cheque No <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="text" name="cheque_no" value="" class="form-control" placeholder="Enter Cheque No">
                				</div>
              				</div>';
				}
				else if($emp_details->payment_mode=='Transfer') {
				$new_row .= '<div class="form-group">
                				<label class="control-label col-lg-3">Transaction Id <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="text" name="transaction_id" value="" class="form-control" placeholder="Enter Transaction Id">
                				</div>
              				</div>';	
				}
							
				$new_row .= '<div class="form-group">
                				<label class="control-label col-lg-6">Earning <hr /></label>
                				<label class="control-label col-lg-6">Deduction <hr /></label>
              				</div>
              				<div>
								<div class="col-lg-6">';
				$salary_dead_details1 = $this->db->query("select * from td_salary_head where emp_type='S' and salary_head_type='E'")->result();			
				if($salary_dead_details1) { foreach($salary_dead_details1 as $head1) { 	
					$new_row .=	'<input type="checkbox" class="styled" name="salary_head_id[]" value="'.$head1->salary_head_id.'"';
					if(in_array($head1->salary_head_id, $sal_heads)) { 
					$new_row .=	'checked="checked"';
					}
					$new_row .=	'>'.$head1->salary_head_name.'<br />';
				} }
					$new_row .=	'</div>';
				
					$new_row .=	'<div class="col-lg-6">';
				$salary_dead_details2 = $this->db->query("select * from td_salary_head where emp_type='S' and salary_head_type='D'")->result();			
				if($salary_dead_details2) { foreach($salary_dead_details2 as $head2) {
					$new_row .=	'<input type="checkbox" class="styled" name="salary_head_id[]" value="'.$head2->salary_head_id.'"';
					if(in_array($head2->salary_head_id, $sal_heads)) { 
					$new_row .=	'checked="checked"';
					}
					$new_row .=	'>'.$head2->salary_head_name.'<br />';
				} }	
					$new_row .=	'</div>				
             				</div>';
				
			}
			else {
				$new_row = '<div class="form-group">
                				<label class="control-label col-lg-3">Rate Per Hour <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="number" name="rate_per_hour" value="'.$rate_per_hour.'" class="form-control" placeholder="Enter Rate Per Hour">
									<input type="hidden" name="emp_type" value="'.$emp_type.'" class="form-control" placeholder="Enter employee type">
                				</div>
              				</div>';
							
				if($emp_details->payment_mode=='Cheque') { 
				$new_row .= '<div class="form-group">
                				<label class="control-label col-lg-3">Cheque No <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="text" name="cheque_no" value="" class="form-control" placeholder="Enter Cheque No">
                				</div>
              				</div>';
				}
				else if($emp_details->payment_mode=='Transfer') {
				$new_row .= '<div class="form-group">
                				<label class="control-label col-lg-3">Transaction Id <span class="text-danger">*</span></label>
                				<div class="col-lg-9">
                  					<input type="text" name="transaction_id" value="" class="form-control" placeholder="Enter Transaction Id">
                				</div>
              				</div>';	
				}
							
				$new_row .= '<div class="form-group">
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
					$new_row .=	'<input type="checkbox" class="styled" name="salary_head_id[]" value="'.$head3->salary_head_id.'"';
					if(in_array($head3->salary_head_id, $sal_heads)) { 
					$new_row .=	'checked="checked"';
					}
					$new_row .=	'>'.$head3->salary_head_name.'<br />';
			} }
				$new_row .=	'</div>';
				
				$new_row .=	'<div class="col-lg-6">';
			$salary_dead_details4 = $this->db->query("select * from td_salary_head where emp_type='U' and salary_head_type='D'")->result();			
			if($salary_dead_details4) { foreach($salary_dead_details4 as $head4) {
					$new_row .=	'<input type="checkbox" class="styled" name="salary_head_id[]" value="'.$head4->salary_head_id.'"';
					if(in_array($head4->salary_head_id, $sal_heads)) { 
					$new_row .=	'checked="checked"';
					}
					$new_row .=	'>'.$head4->salary_head_name.'<br />';
			} }	
				$new_row .=	'</div>';
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