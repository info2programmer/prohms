<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_performance extends CI_Controller {
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
		if($this->input->post('mode')=='tab') {
			$from_date = date_format(date_create($this->input->post('from_date')), "Y-m-d");
			$to_date = date_format(date_create($this->input->post('to_date')), "Y-m-d");
			$emp_id = $this->input->post('emp_id');
			
			$table['name'] = 'td_employee_performance';
			$order_by[0] = array('field'=>'td_employee_performance.emp_performance_id','type'=>'ASC');
			
			if($emp_id=='')
			{ $conditions = array('td_employee_performance.performance_date>='=>$from_date,'td_employee_performance.performance_date<='=>$to_date); }
			else { $conditions = array('td_employee_performance.performance_date>='=>$from_date,'td_employee_performance.performance_date<='=>$to_date,'td_employee_performance.emp_id'=>$emp_id); }
			
			$select = 'td_employee_performance.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
			$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_employee_performance','field_table_master'=>'emp_id','type'=>'Inner');
			$data['rows'] = $this->Common_model->find_data($table,'array','',$conditions,$select,$join,'',$order_by);
			$data['row_count'] = $this->Common_model->find_data($table,'count','',$conditions,$select,$join,'',$order_by);
			
		}
		else {
		$table['name'] = 'td_employee_performance';
		$order_by[0] = array('field'=>'td_employee_performance.emp_performance_id','type'=>'ASC');
		$select = 'td_employee_performance.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_employee_performance','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);
		$data['row_count'] = $this->Common_model->find_data($table,'count','','',$select,$join,'',$order_by);
		}
		
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/manage-performance-list-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
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
				$points = $this->input->post('points');
				$applications = $this->input->post('applications');
				$hours_login = $this->input->post('hours_login');
				$rph = $points/$hours_login;
				$aph = $applications/$hours_login;
				$rpa = $points/$applications;
								
				$fields = array(
				'emp_id' => $this->input->post('emp_id'),
				'performance_date' => date_format(date_create($this->input->post('performance_date')), "Y-m-d"),
				'points' => $this->input->post('points'),
				'applications' => $this->input->post('applications'),
				'hours_login' => $this->input->post('hours_login'),
				'rph' => $rph,
				'aph' => $aph,
				'rpa' => $rpa,
				'quality_score' => $this->input->post('quality_score'),
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_employee_performance';
				$data = $this->Common_model->save_data($table,$fields,'','emp_performance_id');
				if($data)
				{					
					$this->session->set_flashdata('success_message','Team member performance successfully inserted');	
					redirect('master-admin/manage_performance');
					
				}
				else
				{
					redirect('master-admin/manage_performance');	
				}
			}
		}

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-performance-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';				

		$conditions=array('emp_performance_id'=>$id);
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
				$points = $this->input->post('points');
				$applications = $this->input->post('applications');
				$hours_login = $this->input->post('hours_login');
				$rph = $points/$hours_login;
				$aph = $applications/$hours_login;
				$rpa = $points/$applications;
								
				$fields = array(
				'emp_id' => $this->input->post('emp_id'),
				'performance_date' => date_format(date_create($this->input->post('performance_date')), "Y-m-d"),
				'points' => $this->input->post('points'),
				'applications' => $this->input->post('applications'),
				'hours_login' => $this->input->post('hours_login'),
				'rph' => $rph,
				'aph' => $aph,
				'rpa' => $rpa,
				'quality_score' => $this->input->post('quality_score'),
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;				
				$table['name'] = 'td_employee_performance';
				$data = $this->Common_model->save_data($table,$fields,$id,'emp_performance_id');
				if($data)
				{					
					$this->session->set_flashdata('success_message','Team member performance successfully updated');	
					redirect('master-admin/manage_performance');
					
				}
				else
				{
					redirect('master-admin/manage_performance');	
				}
			}
		}

		

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-performance-view',$data,true);
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
		$table['name'] = 'td_employee_performance';
		if($this->Common_model->delete_data($table,$id,'emp_performance_id'))
		{
			$this->session->set_flashdata('success_message','Employee performance has been Deleted successfully.');
			redirect('master-admin/manage_performance');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('master-admin/manage_performance');
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
				redirect('master-admin/manage_performance');
			}
		else
			{
				redirect('master-admin/manage_performance');			
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
				redirect('master-admin/manage_performance');
			}
		else
			{
				redirect('master-admin/manage_performance');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('performance_date', 'Performance date', 'required');
		$this->form_validation->set_rules('points', 'Points', 'required');
		$this->form_validation->set_rules('applications', 'Applications', 'required');
		$this->form_validation->set_rules('hours_login', 'Login Hours', 'required');
		$this->form_validation->set_rules('quality_score', 'Quality Score', 'required');
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
	
	function ajax_call()
	{
		$emp_id =	$_POST['emp_id'];	
		$performance_date =  date_format(date_create($_POST['performance_date']), 'Y-m-d');
		$login_time_details = $this->db->query("SELECT *  FROM `td_login` WHERE `emp_id` = '$emp_id' AND `login_time` LIKE '%$performance_date%' AND `logout_time` LIKE '%$performance_date%'")->row();
		$login_time = strtotime($login_time_details->login_time);
		$logout_time = strtotime($login_time_details->logout_time);
		$hours = (int)(($logout_time - $login_time) / 3600);
		echo $working_hours = $hours-1;
	}
	
	function ajax_call_location()
	{
		$loc_id = $_POST['loc_id'];
		
		$new_row = '<div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">';
                $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result();
                  $new_row .= '<select name="emp_id" id="emp_id" data-placeholder="Select a Employee" class="form-control" required="required">
                    			<option value="" selected="selected" hidden>Select a Employee</option>';
                        		if($emps) { foreach($emps as $emp) {
                      $new_row .= '<option value="'.$emp->emp_id.'" ';
					  /*if($emp->emp_id==$emp_id) {
						  $new_row .= 'selected="selected"';
						  }*/
						  $new_row .= '>'.$emp->emp_name.'('.$emp->emp_code.')</option>';
                        } } else {
                        $new_row .= '<option value="No employee" selected="selected">No employee</option>';
                        }
                  $new_row .= '</select>';
                form_error('emp_id');
                $new_row .=  '</div>
              </div>';
			  echo $new_row;	
	}
}