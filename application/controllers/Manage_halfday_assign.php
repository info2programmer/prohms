<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manage_halfday_assign extends CI_Controller {

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
		$table['name'] = 'td_half_day_assign';
		$group_by[0] = 'td_half_day_assign.emp_id';
		/*$order_by[0] = array('field'=>'td_half_day_assign.halfday_assign_id','type'=>'ASC');
		$select = 'td_half_day_assign.*,td_employee_personal_details.emp_name,td_employee_personal_details.emp_code';
		$join[0] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_half_day_assign','field_table_master'=>'emp_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by,$group_by);*/
		$data['rows'] = $this->Common_model->find_data($table,'array','','','','',$group_by);		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-halfday-assign-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	

	function halfday_details($id)

	{

		$data['emp_per'] = $this->db->query("select * from td_employee_personal_details where emp_id='$id' and published=1")->row();
		$data['rows'] = $this->db->query("select * from td_half_day_assign where emp_id='$id' and published=1 order by halfday_date desc")->result();		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/halfday-details-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}
	
	/*function halfday_leave_details()
	{
		$emp_id = $_POST['emp_id'];
		
		
		$table['name'] = 'td_half_day_assign';
		$order_by[0] =array('field'=>'td_half_day_assign.halfday_date','type'=>'desc');
		$join[0] = array('table'=>'td_leave_allocation_details','field'=>'leave_allocation_details_id','table_master'=>'td_half_day_assign','field_table_master'=>'halfday_type','type'=>'Inner');
		$join[1] = array('table'=>'td_leave','field'=>'leave_id','table_master'=>'td_leave_allocation_details','field_table_master'=>'leave_id','type'=>'Inner');
		$conditions = array('td_half_day_assign.emp_id'=>$emp_id,'td_half_day_assign.published'=>1);
		$rows = $this->Common_model->find_data($table,'array','',$conditions,'*',$join,'',$order_by);
		$this->output->set_content_type("application/json")->set_output(json_encode($rows));
	}*/



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
				'halfday_date' => date_format(date_create($this->input->post('halfday_date')), "Y-m-d"),
				'halfday_type' => $this->input->post('halfday_type'),
				'published'	=> 1
				);
			

				$table['name'] = 'td_half_day_assign';
				$data = $this->Common_model->save_data($table,$fields,'','halfday_assign_id');

				if($data)
				{	
					$insert_id = $this->db->insert_id();
					$leave_allocation_id = $halfday_type;
					$allot_details = $this->db->query("select * from td_leave_allocation_details where leave_allocation_details_id='$leave_allocation_id'")->row();
					$old_leave_balance = $allot_details->leave_balance;
					
					$new_leave_balance_assign = $old_leave_balance-0.5;
					$succ = $this->db->query("UPDATE `td_half_day_assign` SET `leave_left`='$new_leave_balance_assign' WHERE halfday_type='$leave_allocation_id' and halfday_assign_id='$insert_id'");

					if($old_leave_balance!=0) { 
					$new_leave_balance = $old_leave_balance-0.5;

					$fields1 = array(
						'leave_balance'	=> $new_leave_balance
					);

					//echo '<pre>';print_r($fields);die;
					$table1['name'] = 'td_leave_allocation_details';
					$rows = $this->Common_model->save_data($table1,$fields1,$leave_allocation_id,'leave_allocation_details_id');
					$this->output->set_content_type("application/json")->set_output(json_encode($rows));
					}
					$this->session->set_flashdata('success_message','Halfday assign successfully inserted');
					redirect('manage_halfday_assign');
				}
				else
				{
					redirect('manage_halfday_assign');	
				}
			}
		}



		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-halfday-assign-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}



	######################################################################################



	



	function edit($id)

	{

		$data['action'] = 'Edit';	



		$conditions=array('halfday_assign_id'=>$id);

		$table['name'] = 'td_half_day_assign';

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

				'halfday_date' => date_format(date_create($this->input->post('halfday_date')), "Y-m-d"),

				'leave_type' => $this->input->post('leave_type'),

				'published'	=> 1

				);

				//echo '<pre>';print_r($fields);die;				

				$table['name'] = 'td_half_day_assign';

				$data = $this->Common_model->save_data($table,$fields,$id,'halfday_assign_id');

				if($data)

				{	

					$this->session->set_flashdata('success_message','Leave assign successfully updated');	

					redirect('manage_halfday_assign');					

				}

				else

				{

					redirect('manage_halfday_assign');	

				}

			}

		}



		



		$data['head'] = $this->load->view('elements/head','',true);

		$data['header'] = $this->load->view('elements/header','',true);

		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('elements/footer','',true);

		$data['maincontent']=$this->load->view('maincontents/add-edit-halfday-assign-view',$data,true);

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

		$table['name'] = 'td_half_day_assign';

		if($this->Common_model->delete_data($table,$id,'halfday_assign_id'))

		{

			$this->session->set_flashdata('success_message','Leave allocation has been Deleted successfully.');

			redirect('manage_halfday_assign');

		}

		else

		{

			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');

			redirect('manage_halfday_assign');

		}

	}	



	##############################################################################################	



	function deactive($id)

	{

		$postdata = array(

							'published' => 0

						);

		$table['name'] = 'td_half_day_assign';

		$deactive = $this->Common_model->save_data($table,$postdata,$id,'halfday_assign_id');	



		if($deactive)

			{	

				$this->session->set_flashdata('success_message','Leave allocation successfully deactivated');

				redirect('manage_halfday_assign');

			}

		else

			{

				redirect('manage_halfday_assign');			

		}

	}





	function active($id)

	{

		$postdata = array(

							'published' => 1

						);

		$table['name'] = 'td_half_day_assign';	

		$deactive = $this->Common_model->save_data($table,$postdata,$id,'halfday_assign_id');

		if($deactive)

			{	

				$this->session->set_flashdata('success_message','Leave allocation successfully activated');

				redirect('manage_halfday_assign');

			}

		else

			{

				redirect('manage_halfday_assign');

			}

	}



	##############################################################################################

	function form_validate()

	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('emp_id', 'Employee Name', 'required');

		$this->form_validation->set_rules('halfday_date', 'Leave date', 'required');

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

			$action = $_POST['action'];

			/*if($action == 'Edit') {

			$sayantan = $_POST['sayantan']; 

			}

			if($action == 'Edit' && $sayantan == 'ready') {

			$id = $_POST['id']; }*/			

			

		/*$table['name'] = 'td_leave_allocation';

		$order_by[0] = array('field'=>'td_leave_allocation_details.leave_allocation_details_id','type'=>'ASC');

		$select = 'td_leave_allocation_details.leave_allocation_details_id,td_leave_allocation_details.number_of_leave,td_leave.leave_name';

		$join[0] = array('table'=>'td_leave_allocation_details','field'=>'leave_allocation_id','table_master'=>'td_leave_allocation','field_table_master'=>'leave_allocation_id','type'=>'Inner');

		$join[1] = array('table'=>'td_leave','field'=>'leave_id','table_master'=>'td_leave_allocation_details','field_table_master'=>'leave_id','type'=>'Inner');

		$conditions = array('td_leave_allocation.emp_id'=>'$emp_id','td_leave_allocation_details.number_of_leave!='=>'0');

		$list = array('key'=>'td_leave_allocation_details.leave_allocation_details_id','value'=>'td_leave.leave_name','empty_name'=>' leave type');*/

		$arrCities = $this->db->query("SELECT a.*,b.leave_id,b.leave_allocation_details_id FROM `td_leave_allocation` as a inner join td_leave_allocation_details as b on b.leave_allocation_id=a.leave_allocation_id where a.emp_id='$emp_id' and b.number_of_leave!='0'")->result();

		//print_r($arrCities);die;

			/*if($action == 'Edit' && $sayantan == 'ready')

			{

				

				$conditions=array('thi_hotels.id'=>$id);

				$data['row'] = $this->hotel_model->find_data('thi_hotels.id,thi_hotels.city_id,thi_hotels.hotel_name,thi_cities.id,thi_cities.city_name',$conditions,'row');

				

				$city_name = $data['row']->city_id; 

			}*/

			

			/*$js = 'class="select" id="leave_type"';

			if($action == 'Add')

			 {

            	echo form_dropdown('leave_type',$arrCities,'',$js);

			 }

			 else if($action == 'Edit' && $sayantan == 'ready')

			 {

				 echo form_dropdown('city_id',$arrCities,$city_name,$js);

			 }

			 else if($action == 'Edit' && $sayantan == 'change')

			 {

				 echo form_dropdown('city_id',$arrCities,'',$js);

			 }*/

			 

			 	$dropdown = '<select name="halfday_type" data-placeholder="Select a Halfday type" class="form-control">

                    	<option value="" selected="selected" hidden>Select a Halfday type</option>';

				if($arrCities) { foreach($arrCities as $a) {

					$lv_id = $a->leave_id;

					$lv_details = $this->db->query("select * from td_leave where leave_id='$lv_id'")->row();		

              		$dropdown .= '<option value="'.$a->leave_allocation_details_id.'">'.$lv_details->leave_name.'</option>';

				} }

                $dropdown .= '</select>';

				echo $dropdown;

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

			echo $id = $_POST['id'];die;

			$arrCities = $this->db->query("SELECT * FROM  `td_half_day_assign` where halfday_assign_id='$id' and published=1")->result();

		

			$dropdown = '<select name="halfday_type" data-placeholder="Select a Halfday type" class="form-control">

                    	<option value="" selected="selected" hidden>Select a Halfday type</option>';

			if($arrCities) { foreach($arrCities as $a) {

				$lv_id = $a->halfday_type;

				$lv_details = $this->db->query("select * from td_leave where leave_id='$lv_id'")->row();		

              	$dropdown .= '<option value="'.$a->halfday_assign_id.'">'.$lv_details->leave_name.'</option>';

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