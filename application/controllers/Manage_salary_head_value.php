<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_salary_head_value extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('Common_model'));
	}
	################################################################
	function index()
	{
		$table['name'] = 'td_salary_head_value';
		$order_by[0] =array('field'=>'td_salary_head_value.salary_head_value_id','type'=>'asc');
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_salary_head_value','field_table_master'=>'emp_id','type'=>'inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','','*',$join,'',$order_by);
		
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-salary-head-value-list-view',$data,true);
		$this->load->view('layout-after-login',$data);	
	}
	
	############################### ADD #####################################
	
	function add()
	{    		
		$data['action'] = 'Add'; 
		
		$select = 'emp_id,emp_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'emp_id','type'=>'ASC');
		$table['name']='td_employee_personal_details';
		$list = array('empty_name'=>' employee Name','key'=>'emp_id','value'=>'emp_name');
		$data['emps']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-salary-head-value-view',$data,true);
		$this->load->view('layout-after-login',$data);	                				
	}	
	
	function head_generate()
	{
		$tb_name = $_POST['tb_name'];
		$leaves = $this->db->query("select * from $tb_name where salary_head_id!=1")->result();
		$this->output->set_content_type("application/json")->set_output(json_encode($leaves));	
	}
	
	function salary_head_value_add()
	{
		$emp_id = $_POST['emp_id'];
		$basic_pay = $_POST['basic_pay'];
		$total = $_POST['total'];		
		
		
		$table['name'] = 'td_salary_head_value';
		$field1 = array(
						'emp_id'=>$emp_id,
						'basic_pay'=>$basic_pay,
						'total'=>$total
						);
		$succ = $this->Common_model->save_data($table,$field1,'','salary_head_value_id');
		if($succ) {
			$last_id = $this->db->insert_id();			
			$sets = $this->db->query("select * from td_salary_head")->num_rows();
			for($loop=0;$loop<$sets;$loop++)
			{
				$salary_head_id = $_POST['salary_head_id'];
				$s_h_id = $salary_head_id[$loop];
				$head_details = $this->db->query("select * from td_salary_head where salary_head_id='$s_h_id'")->row();
				$salary_head_type = $head_details->salary_head_type;
				$salary_head_value = $_POST['salary_head_value'];
									
				$table1['name'] = 'td_salary_head_value_details';
				$field2 = array(
						'salary_head_value_id'=>$last_id,
						'salary_head_id'=>$salary_head_id[$loop],
						'salary_head_type'=>$salary_head_type,
						'salary_head_value'=>$salary_head_value[$loop]
						);
				$success = $this->Common_model->save_data($table1,$field2,'','salary_head_value_details_id');				
			}
			
			if($success){$msg='Insert successfully.';}else{$msg='Some error occurred during delete! Please try again.';}
			$this->output->set_content_type("application/json")->set_output(json_encode($msg));	
		}
	}
	
	####################################### ADD ##########################################
	
	function dropdown()
	{		
		$table['name'] = $_POST['table_dropdown'];
		$rows = $this->Common_model->find_data($table,'array');
		$this->output->set_content_type("application/json")->set_output(json_encode($rows));
	}	
	
	
	######################################################################################
	
	function edit($id)
	{ 
		$data['action'] = 'Edit'; 		
		$data['salary_head_value_id'] = $id;
		
		//$data['row'] = $this->db->query("select * from td_salary_head_value where salary_head_value_id='$id'");
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/edit-salary-head-value-view',$data,true);
		$this->load->view('layout-after-login',$data);	
	}
	
		
	
	
	
	######################################################################################
	
	function delete()
	{
	    $table['name'] = $_POST['tb_name'];	
		$id = $_POST['id'];
		$field = $_POST['field'];
        $success = $this->Common_model->delete_data($table,$id,$field);
		if($success){$msg='Deleted successfully.';}else{$msg='Some error occurred during delete! Please try again.';}
		$this->output->set_content_type("application/json")->set_output(json_encode($msg));
	}	
	
	##############################################################################################
	
	function deactive($id)
	{
		$postdata = array(
							'active' => 0
						);
		$table['name'] = $_POST['tb_name'];	
		$id = $_POST['id'];
		$field = $_POST['field'];
		$success = $this->Common_model->save_data($table,$postdata,$id,$field);
		if($success){$msg='Deactivated successfully.';}else{$msg='Some error occurred during delete! Please try again.';}
		$this->output->set_content_type("application/json")->set_output(json_encode($msg));

	}

	

	function active($id)
	{
		$postdata = array(
							'active' => 0
						);
		$table['name'] = $_POST['tb_name'];	
		$id = $_POST['id'];
		$field = $_POST['field'];
		$success = $this->Common_model->save_data($table,$postdata,$id,$field);
		if($success){$msg='Activated successfully.';}else{$msg='Some error occurred during delete! Please try again.';}
		$this->output->set_content_type("application/json")->set_output(json_encode($msg));
	}

	
	
	

	################################## salary head value #####################################################
	
	
	
	
	function salary_head_value_edit()
	{
		$salary_head_value_id = $_POST['salary_head_value_id'];
		$table['name'] = 'td_salary_head_value';
		$join[0] = array('table'=>'td_salary_head_value_details','field'=>'salary_head_value_id','table_master'=>'td_salary_head_value','field_table_master'=>'salary_head_value_id','type'=>'inner');
		$join[1] = array('table'=>'td_salary_head','field'=>'salary_head_id','table_master'=>'td_salary_head_value_details','field_table_master'=>'salary_head_value_id','type'=>'inner');
		$conditions = array('td_salary_head_value.salary_head_value_id'=>$salary_head_value_id);
		$rows = $this->Common_model->find_data($table,'array','',$conditions,'*',$join);
		$this->output->set_content_type("application/json")->set_output(json_encode($rows));
	}
	
	function salary_head_value_fetch()
	{
		$salary_head_value_id = $_POST['salary_head_value_id'];
		$salary_head_id = $_POST['salary_head_id'];	
		$row = $this->db->query("select * from td_salary_head_value_details where salary_head_value_id='$salary_head_value_id' and salary_head_id='$salary_head_id'")->row();
		$this->output->set_content_type("application/json")->set_output(json_encode($row));
	}
	
	function salary_head_value_update()
	{
		$emp_id = $_POST['emp_id'];
		$basic_pay = $_POST['basic_pay'];
		$total = $_POST['total'];		
		$salary_head_value_id = $_POST['salary_head_value_id'];
		
		$table['name'] = 'td_salary_head_value';
		$field1 = array(
						'basic_pay'=>$basic_pay,
						'total'=>$total
						);
		$succ = $this->Common_model->save_data($table,$field1,$salary_head_value_id,'salary_head_value_id');
		if($succ) {
			$last_id = $salary_head_value_id;			
			$sets = $this->db->query("select * from td_salary_head")->num_rows();
			for($loop=0;$loop<$sets;$loop++)
			{
				$salary_head_id = $_POST['salary_head_id'];
				$s_h_id = $salary_head_id[$loop];
				$head_details = $this->db->query("select * from td_salary_head where salary_head_id='$s_h_id'")->row();
				$salary_head_type = $head_details->salary_head_type;
				$salary_head_value = $_POST['salary_head_value'];
									
				
				$success = $this->db->query("UPDATE `td_salary_head_value_details` SET `salary_head_value`=$salary_head_value[$loop] WHERE salary_head_value_id='$salary_head_value_id' and salary_head_id='$salary_head_id[$loop]'");				
			}
			
			if($success){$msg='Update successfully.';}else{$msg='Some error occurred during delete! Please try again.';}
			$this->output->set_content_type("application/json")->set_output(json_encode($msg));	
		}
	}
	
	################################## salary head value #####################################################
	
	################################## salary ################################################################
	
	function salary_list()
	{
		$tb_name = $_POST['tb_name'];		
		$rows= $this->db->query("SELECT from_date, to_date, month_year FROM $tb_name GROUP BY from_date, to_date")->result();
		$this->output->set_content_type("application/json")->set_output(json_encode($rows));
	}
	
	function generate_salary()
	{
		$from_date = $_POST['from_date'];
		$to_date = $_POST['to_date'];
		$from_date_array = explode("-", $from_date);
		$year = $from_date_array[0];
		$month = $from_date_array[1];
			
		$emp_details = $this->db->query("select * from td_employee_personal_details where published=1")->result();
		if($emp_details) { $payslip_no = $year.$month."1"; $month_year = $year.$month;
			foreach($emp_details as $emp_detail) {
				$emp_id = $emp_detail->emp_id;
				$td_salary_head_value_detail =  $this->db->query("select * from td_salary_head_value where emp_id='$emp_id'")->row();
				//echo $this->db->last_query();
				//print_r($td_salary_head_value_detail);die;
				
				$basic_pay = $td_salary_head_value_detail->basic_pay;
				$total = $td_salary_head_value_detail->total;
				
				
				
				$fin_particulars = "Salary/".date('Y-m-d')."/".$emp_detail->emp_name."/".$td_salary_head_value_detail->total;
				$field3 =array(
								'fin_purpose'=>'Salary',
								'fin_type'=>'Debit',
								'fin_date'=>date('Y-m-d'),
								'fin_particulars'=>$fin_particulars,
								'fin_amount'=>$total,
								'fin_uniq_no'=>$payslip_no				
								);
				$table3['name'] = 'td_finance';				
				$succ = $this->Common_model->save_data($table3,$field3,'','salary_id');
				
				$field1 =array(
								'from_date'=>$from_date,
								'to_date'=>$to_date,
								'month_year'=>$month_year,
								'emp_id'=>$emp_id,
								'payslip_no'=>$payslip_no,
								'basic_pay'=>$basic_pay,
								'total_salary'=>$total						
								);
				$table1['name'] = 'td_salary';				
				$success1 = $this->Common_model->save_data($table1,$field1,'','salary_id');
				
				if($success1) {
					$last_insert_id = $this->db->insert_id(); 
					$head_val_details = $this->db->query("select * from td_salary_head_value as a inner join td_salary_head_value_details as b on b.salary_head_value_id=a.salary_head_value_id where a.emp_id='$emp_id'")->result();
					if($head_val_details) {
						foreach($head_val_details as $head_val_detail) {
							
							$salary_head_id = $head_val_detail->salary_head_id;
							$salary_head_type = $head_val_detail->salary_head_type;
							$salary_head_value = $head_val_detail->salary_head_value;
							
							$field2 =array(
								'salary_id'=>$last_insert_id,
								'emp_id'=>$emp_id,
								'salary_head_id'=>$salary_head_id,
								'salary_head_type'=>$salary_head_type,
								'salary_head_value'=>$salary_head_value						
								);
								$table2['name'] = 'td_salary_detail';				
								$success2 = $this->Common_model->save_data($table2,$field2,'','salary_detail_id');
						}
					}
				}
			} 
		}
	}
	
	################################## salary ################################################################	
	
	################################## pay-in-slip ################################################################	
	
	function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = "Rupees ".$rettxt;

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." Paise"; 
} 
return $rettxt;}
	
	function emp_details()
	{
		$month_year = $_POST['month_year'];
		
		$company_setting = $this->db->query("select * from td_company_settings")->row();
		
		$salary_details = $this->db->query("select * from td_salary where month_year='$month_year'")->result();
		if($salary_details) { 
			foreach($salary_details as $salary_detail) {
			$emp_id = $salary_detail->emp_id;
			$from_date = $salary_detail->from_date;
			$to_date = $salary_detail->to_date;
			
			$emp_details = $this->db->query("select * from td_employee_personal_details where emp_id='$emp_id'")->result();
			if($emp_details) { 
			$payslip_block ='';
			$extra_leave = 0;
			
			foreach($emp_details as $emp_detail) {
				$department_id = $emp_detail->department_id;
				$department =  $this->db->query("select * from td_department where department_id='$department_id'")->row();				
				
				$emp_office =  $this->db->query("select * from td_employee_office_details where emp_id='$emp_id'")->row();
				$designation_id = $emp_office->designation_id;
				$designation =  $this->db->query("select * from td_designation where designation_id='$designation_id'")->row();	
				
			$payslip_block .= '<table align="center" class="autogap">
									<thead>
									<tr>
										<th class="header center" colspan="6" id="company-name">'.$company_setting->com_name.'</th>
									</tr>
									<tr>
										<th class="center" colspan="6" id="company-address">'.$company_setting->com_address.'</th>
									</tr>
									<tr>
										<th class="center" colspan="6" id="company-phone">'.$company_setting->com_phone.' | '.$company_setting->com_email.'<br></th>
									</tr>
									<tr>
										<th class="secondary-header center" colspan="6">Pay Slip for the period of '.date_format(date_create($salary_detail->from_date), "M, Y").'</th>
									</tr>
									</thead>
									<tbody>
									<tr>								
										<td>Employee ID</td>
										<td>:</td>
										<td>'.$emp_detail->emp_code.'</td>
										<td>Name</td>
										<td>:</td>
										<td>'.$emp_detail->emp_name.'</td>
									</tr>
									<tr>
										<td>Department</td>
										<td>:</td>
										<td>'.$department->department_name.'</td>
										<td>Designation</td>
										<td>:</td>
										<td>'.$designation->designation_name.'</td>
									</tr>
									<tr>
										<td>Date Of Joining</td>
										<td>:</td>
										<td>'.date_format(date_create($emp_office->joining_date), "d-m-Y").'</td>
										<td>Confirmation Period</td>
										<td>:</td>
										<td>'.date_format(date_create($emp_office->confirmation_period), "d-m-Y").'</td>
									</tr>
									<tr>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border">
											<table>
												<tr>
													<td width="75%" class="subheader extra-pad">Leave Name</td>
													<td width="25%" class="subheader extra-pad right">Balance</td>
												</tr>
											</table>
										</td>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
											<table>
												<tr>
													<td width="50%" class="subheader extra-pad">Leave Name</td>
													<td width="75%" class="subheader extra-pad right">Taken On</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="no-pad right-border">
											<table>'; 
							$allocation = $this->db->query("select * from td_leave_allocation where emp_id='$emp_id' and from_date='$from_date' and to_date='$to_date'")->row();
							$leave_allocation_id = $allocation->leave_allocation_id;
							
							$allocation_details = $this->db->query("select a.*,b.leave_name from td_leave_allocation_details as a inner join td_leave as b on b.leave_id=a.leave_id where a.leave_allocation_id='$leave_allocation_id' and a.number_of_leave!=''")->result();
							
							
							if($allocation_details) { foreach($allocation_details as $allocation_detail) {
								$leave_allocation_details_id = $allocation_detail->leave_allocation_details_id;								
								
								$leave_assign = $this->db->query("SELECT * FROM td_leave_assign WHERE leave_date >= '$from_date' AND leave_date <= '$to_date' AND leave_type='$leave_allocation_details_id' order by leave_assign_id desc limit 1")->row();
																
							 $payslip_block .= '<tr>
													<td width="75%">'.$allocation_detail->leave_name.'</td>
													<td width="25%" class="right">';
							if($leave_assign) { 						
							$payslip_block .= ($leave_assign->leave_left>0)?$leave_assign->leave_left:0;
							
							
							
							}
							else  { $payslip_block .= $allocation_detail->number_of_leave; } 
							$payslip_block .= '( '.$allocation_detail->number_of_leave.' )</td>
												</tr>';
							
								} 
							}
												              
						$payslip_block .= '</table>
										</td>
									  <td colspan="3" class="no-pad">
											<table>';
							$leave_assigns1 = $this->db->query("SELECT * FROM td_leave_assign WHERE leave_date >= '$from_date' AND leave_date <= '$to_date' AND emp_id='$emp_id'")->result();
								
							if($leave_assigns1) { foreach($leave_assigns1 as $leave_assign1) {
								$leave_type1 = $leave_assign1->leave_type;
								$allocation_detail1 = $this->db->query("select a.*,b.leave_name from td_leave_allocation_details as a inner join td_leave as b on b.leave_id=a.leave_id where a.leave_allocation_details_id='$leave_type1'")->row();
								 			
							 $payslip_block .= '<tr>
													<td width="75%">'.$allocation_detail1->leave_name.'</td>
													<td width="25%" class="right">'.date_format(date_create($leave_assign1->leave_date), "d M, Y").'</td>
												</tr>';
							} }
						$payslip_block .= '</table>
										</td>
									</tr>
									<tr>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border">
											<table>
												<tr>
													<td width="75%" class="subheader extra-pad">Earning</td>
													<td width="25%" class="subheader extra-pad right">Amount</td>
												</tr>
											</table>
										</td>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
											<table>
												<tr>
													<td width="50%" class="subheader extra-pad">Deduction</td>
													<td width="75%" class="subheader extra-pad right">Amount</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="no-pad right-border">
											<table>';
						   $basic_pay = $this->db->query("select * from td_salary_head_value where emp_id='$emp_id'")->row();
						   $bp = $basic_pay->basic_pay;				
						   $payslip_block .='<tr>
												<td width="75%">Basic Pay</td>
												<td width="25%" class="right">'.$basic_pay->basic_pay.'</td>
											</tr>';
										$earning_total = 0.00;
										$salary_details1 = $this->db->query("select * from td_salary_head_value as a inner join td_salary_head_value_details as b on b.salary_head_value_id=a.salary_head_value_id where a.emp_id='$emp_id' and b.salary_head_type='E'")->result();	
										
										if($salary_details1) { foreach($salary_details1 as $salary_detail1) {
											$salary_head_id1 = $salary_detail1->salary_head_id;
											$head_detail1 = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id1'")->row(); 
										$payslip_block .= '<tr>
													<td width="75%">'.$head_detail1->salary_head_name.'</td>
													<td width="25%" class="right">'.$salary_detail1->salary_head_value.'</td>
												</tr>';
										$earning_total +=$salary_detail1->salary_head_value;
										} }
										$earning_total = $earning_total+$bp;		
										$payslip_block .= '</table>
										</td>
										<td colspan="3" class="no-pad">
											<table>';
							$deduction_total = 0.00;
							$salary_details2 = $this->db->query("select * from td_salary_head_value as a inner join td_salary_head_value_details as b on b.salary_head_value_id=a.salary_head_value_id where a.emp_id='$emp_id' and b.salary_head_type='D'")->result();	
										if($salary_details2) { foreach($salary_details2 as $salary_detail2) {
											$salary_head_id2 = $salary_detail2->salary_head_id;
											$head_detail2 = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id2'")->row(); 
										$payslip_block .= '<tr>
													<td width="75%">'.$head_detail2->salary_head_name.'</td>
													<td width="25%" class="right">'.$salary_detail2->salary_head_value.'</td>
												</tr>';
										$deduction_total +=$salary_detail2->salary_head_value;		
										} }
							
							
							$late_attendance = $this->db->query("SELECT * FROM `td_attendance` WHERE attendance_date>='$from_date' and attendance_date<='$to_date' and `late_id` LIKE '%$emp_id%'")->num_rows();
							$one_day_sal = $earning_total/30;
							$deduction_for_late = floor($late_attendance/3);
							$deduction_for_late_amt = $deduction_for_late*$one_day_sal;
							$payslip_block .= '<tr>
												   <td width="75%">Deduction for late</td>
												   <td width="25%" class="right">'.round($deduction_for_late_amt,2).'</td>
												</tr>';
							$deduction_for_extra_leaves = $this->db->query("select * from td_leave_assign where leave_date>='$from_date' and leave_date<='$to_date' and emp_id='$emp_id' and leave_left<0")->result();
							
							if($deduction_for_extra_leaves) {
								 
								foreach($deduction_for_extra_leaves as $deduction_for_extra_leave) {
									$leave_left = abs($deduction_for_extra_leave->leave_left);
									$extra_leave = $extra_leave+$leave_left;
								}
							}
							$extra_leave_amount = $extra_leave*$one_day_sal;
							$deduction_total = round(($deduction_total+$extra_leave_amount+$deduction_for_late_amt),2);
							
							
							$payslip_block .= '<tr>
												   <td width="75%">Deduction for extra leave</td>
												   <td width="25%" class="right">'.$extra_leave_amount.'</td>
												</tr>
												</table>
										</td>
									</tr>
									<tr>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border">
											<table>
												<tr>
													<td width="75%" class="subheader extra-pad">Total Earning</td>
													<td width="25%" class="subheader extra-pad right">'.$earning_total.'</td>
												</tr>
											</table>
										</td>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
											<table>
												<tr>
													<td width="75%" class="subheader extra-pad">Total Deduction</td>
													<td width="25%" class="subheader extra-pad right">'.$deduction_total.'</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
											<table>
												<tr>
													<td width="50%" class="subheader extra-pad"></td>
													<td width="25%" class="subheader extra-pad right">&nbsp;</td>
													<td width="25%" class="subheader extra-pad right"></td>
												</tr>
											</table>
										</td>';
										$net_pay = $earning_total-$deduction_total;
						$payslip_block .='<td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
											<table>
												<tr>
													<td width="50%" class="subheader extra-pad">Net Pay (Rounded)</td>
													<td width="25%" class="subheader extra-pad right">&nbsp;</td>
													<td width="25%" class="subheader extra-pad right">'.$net_pay.'</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr class="bottom-border">
										<td colspan="6" class="extra-pad">
											<strong>Amount in words:</strong>
											'.$this->numtowords($net_pay).' Only
										</td>
									</tr>
									<tr class="bottom-border">
										<td colspan="6" class="extra-pad">
											<strong>Note:</strong>
										</td>
									</tr>
									<tr>
										<td colspan="3" class="extra-pad">
											<div class="signature-box-left"></div>
											Employer\'s Signature
										</td>
										<td colspan="3" class="extra-pad right">
											<div class="signature-box-right"></div>
											Employee\'s Signature
										</td>
									</tr>
									</tbody>
								</table>';
			}
			echo $payslip_block;
			}
		  }
		}
		
	}
	
	################################## pay-in-slip ################################################################	
}

