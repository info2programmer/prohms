<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Manage_employee_office extends CI_Controller {

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

		$table['name'] = 'td_employee_office_details';

		$order_by[0] = array('field'=>'td_employee_office_details.office_details_id','type'=>'asc');

		$join[0] = array('table'=>'td_designation','field'=>'designation_id','table_master'=>'td_employee_office_details','field_table_master'=>'designation_id','type'=>'inner');

		$join[1] = array('table'=>'td_employee_personal_details','field'=>'emp_id','table_master'=>'td_employee_office_details','field_table_master'=>'office_details_id','type'=>'inner');	

		$select = 'td_employee_office_details.*,td_designation.designation_name,td_employee_personal_details.emp_name,td_employee_personal_details.salutation,td_employee_personal_details.emp_code';	

		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);



		$data['head'] = $this->load->view('elements/head','',true);

		$data['header'] = $this->load->view('elements/header','',true);

		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('elements/footer','',true);

		$data['maincontent']=$this->load->view('maincontents/manage-employee-office-list-view',$data,true);

		$this->load->view('layout-after-login',$data);

	}



	######################################################################################	



	function add()

	{	



		$data['action'] = 'Add';

		

		$select = 'emp_id,emp_name';

		$conditions=array('published'=>1);

		$order_by[0] = array('field'=>'emp_name','type'=>'ASC');

		$table['name']='td_employee_personal_details';

		$list = array('empty_name'=>' employee','key'=>'emp_id','value'=>'emp_name');

		$data['emps']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		//echo '<pre>';print_r($data['emps']);die;

		

		$select = 'designation_id,designation_name';

		$conditions=array('published'=>1);

		$order_by[0] = array('field'=>'designation_id','type'=>'ASC');

		$table['name']='td_designation';

		$list = array('empty_name'=>' designation Name','key'=>'designation_id','value'=>'designation_name');

		$data['designations']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
		
		
		$select = 'loc_id,loc_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'loc_name','type'=>'ASC');
		$table['name']='td_company_location';
		$list = array('empty_name'=>' location','key'=>'loc_id','value'=>'loc_name');
		$data['locations']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);



		if($this->input->post('mode')=='tab')

		{

			/*if($this->form_validate() == FALSE)

			{

				$data['error_message']=validation_errors();

				echo "papu";die;

			}

			else

			{*/

				$fields = array(

				'emp_id' => $this->input->post('emp_id'),

				'joining_date' => $this->input->post('joining_date'),

				'confirmation_period' => $this->input->post('confirmation_period'),

				'emp_type' => $this->input->post('emp_type'),

				'designation_id' => $this->input->post('designation_id'),

				'payment_mode' => $this->input->post('payment_mode'),

				'location' => $this->input->post('location'),

				'increment_date' => $this->input->post('increment_date'),

				'resignation_date' => $this->input->post('resignation_date'),

				'last_working_date' => $this->input->post('last_working_date'),

				'is_pf' => $this->input->post('is_pf'),

				'pf_no' => $this->input->post('pf_no'),

				'epf_no' => $this->input->post('epf_no'),

				'relationship' => $this->input->post('relationship'),

				'pf_enrollment_date' => $this->input->post('pf_enrollment_date'),

				'is_esi' => $this->input->post('is_esi'),

				'esi_date' => $this->input->post('esi_date'),

				'bank_acc_no' => $this->input->post('bank_acc_no'),

				'bank_name' => $this->input->post('bank_name'),

				'bank_acc_holder_name' => $this->input->post('bank_acc_holder_name'),

				'bank_ifsc_code' => $this->input->post('bank_ifsc_code'),

				'username' => $this->input->post('username'),

				'password' => $this->input->post('password'),

				'published'	=> 1

				);

				//echo '<pre>';print_r($fields);die;

				$table['name'] = 'td_employee_office_details';

				$data = $this->Common_model->save_data($table,$fields,'','office_details_id');

				if($data)

				{

				$this->session->set_flashdata('success_message','Employee office details successfully inserted');	

				redirect('manage_employee_office');

				}

				else

				{

				redirect('manage_employee_office');	

				}

			//}

		}



		$data['head'] = $this->load->view('elements/head','',true);

		$data['header'] = $this->load->view('elements/header','',true);

		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('elements/footer','',true);

		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-office-view',$data,true);

		$this->load->view('layout-after-login',$data);

	}



	######################################################################################



	



	function edit($id)

	{

		$data['action'] = 'Edit';

		

		$select = 'emp_id,emp_name';

		$conditions=array('published'=>1);

		$order_by[0] = array('field'=>'emp_name','type'=>'ASC');

		$table['name']='td_employee_personal_details';

		$list = array('empty_name'=>' employee','key'=>'emp_id','value'=>'emp_name');

		$data['emps']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		//echo '<pre>';print_r($data['emps']);die;

		

		$select = 'designation_id,designation_name';

		$conditions=array('published'=>1);

		$order_by[0] = array('field'=>'designation_id','type'=>'ASC');

		$table['name']='td_designation';

		$list = array('empty_name'=>' designation Name','key'=>'designation_id','value'=>'designation_name');

		$data['designations']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
		$select = 'loc_id,loc_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'loc_name','type'=>'ASC');
		$table['name']='td_company_location';
		$list = array('empty_name'=>' location','key'=>'loc_id','value'=>'loc_name');
		$data['locations']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		

		$conditions=array('office_details_id'=>$id);

		$table['name'] = 'td_employee_office_details';

		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);

		//echo '<pre>';print_r($data['row']);die;

		

		if($this->input->post('mode')=='tab')

		{

			/*if($this->form_validate() == FALSE)

			{

				$data['error_message']=validation_errors();

			}

			else

			{*/		  		

				$fields = array(

				'emp_id' => $this->input->post('emp_id'),

				'joining_date' => date_format(date_create($this->input->post('joining_date')), "Y-m-d"),

				'confirmation_period' => date_format(date_create($this->input->post('confirmation_period')), "Y-m-d"),

				'emp_type' => $this->input->post('emp_type'),

				'emp_skill' => $this->input->post('emp_skill'),

				'designation_id' => $this->input->post('designation_id'),

				'payment_mode' => $this->input->post('payment_mode'),

				'location' => $this->input->post('location'),

				'increment_date' => date_format(date_create($this->input->post('increment_date')), "Y-m-d"),

				'resignation_date' => date_format(date_create($this->input->post('resignation_date')), "Y-m-d"),

				'last_working_date' => date_format(date_create($this->input->post('last_working_date')), "Y-m-d"),

				'is_pf' => $this->input->post('is_pf'),

				'pf_no' => $this->input->post('pf_no'),

				'epf_no' => $this->input->post('epf_no'),

				'relationship' => $this->input->post('relationship'),

				'pf_enrollment_date' => $this->input->post('pf_enrollment_date'),

				'is_esi' => $this->input->post('is_esi'),

				'esi_date' => $this->input->post('esi_date'),

				'bank_acc_no' => $this->input->post('bank_acc_no'),

				'bank_name' => $this->input->post('bank_name'),

				'bank_acc_holder_name' => $this->input->post('bank_acc_holder_name'),

				'bank_ifsc_code' => $this->input->post('bank_ifsc_code'),

				'username' => $this->input->post('username'),

				'password' => $this->input->post('password'),

				'published'	=> 1

				);

				//echo '<pre>';print_r($fields);die;

				$table['name'] = 'td_employee_office_details';

				$data = $this->Common_model->save_data($table,$fields,$id,'office_details_id');

				if($data)

				{

				$this->session->set_flashdata('success_message','Employee office details successfully updated');	

				redirect('manage_employee_office');

				}

				else

				{

				redirect('manage_employee_office');	

				}

			//}

		}



		



		$data['head'] = $this->load->view('elements/head','',true);

		$data['header'] = $this->load->view('elements/header','',true);

		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('elements/footer','',true);

		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-office-view',$data,true);

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

		$table['name'] = 'td_employee_office_details';

		if($this->Common_model->delete_data($table,$id,'office_details_id'))

		{

			$this->session->set_flashdata('success_message','Employee office details has been Deleted successfully.');

			redirect('manage_employee_office');

		}

		else

		{

			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');

			redirect('manage_employee_office');

		}

	}	



	##############################################################################################	



	function deactive($id)

	{

		$postdata = array(

							'published' => 0

						);

		$table['name'] = 'td_employee_office_details';

		$deactive = $this->Common_model->save_data($table,$postdata,$id,'office_details_id');	



		if($deactive)

			{	

				$this->session->set_flashdata('success_message','Employee office details successfully deactivated');

				redirect('manage_employee_office');

			}

		else

			{

				redirect('manage_employee_office');			

		}

	}





	function active($id)

	{

		$postdata = array(

							'published' => 1

						);

		$table['name'] = 'td_employee_office_details';	

		$deactive = $this->Common_model->save_data($table,$postdata,$id,'office_details_id');

		if($deactive)

			{	

				$this->session->set_flashdata('success_message','Employee office details successfully activated');

				redirect('manage_employee_office');

			}

		else

			{

				redirect('manage_employee_office');

			}

	}



	##############################################################################################



	function mail($id)

	{

				$office_details = $this->db->query("select * from td_employee_office_details where office_details_id='$id'")->row();

				$emp_id = $office_details->emp_id;

				

				$employee_details = $this->db->query("select * from td_employee_personal_details where emp_id='$emp_id'")->row();

				$email = $employee_details->email;

				

				$username = $office_details->username;

				$password = $office_details->password;

		

				$to = $email;

				$subject = "Credential for employee login";

				$message = "<table width='600' style='max-width:100%; font-family:verdana,arial,sans-serif;'>

								<tr>

								<td align='center' style='padding-bottom: 25px' colspan='2'>";

								$logo = base_url()."uploads/logo1482000521.png";

								$message .="<a href='".base_url()."employee'><img src='".$logo."'></a>

								</td>

								</tr>

								<tr>

								<td style='font-weight:600;font-size:22px'>Username</td>

								<td style='font-weight:600;font-size:22px'>$username</td>

								</tr>

								<tr>

								<td style='font-weight:600;font-size:22px'>Password</td>

								<td style='font-weight:600;font-size:22px'>$password</td>

								</tr>

							</table>";

				$txt = $message;

				

				

				$headers  = 'MIME-Version: 1.0' . "\r\n";

				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				//$headers .= 'To: <$email>' . "\r\n";

				$headers .= "From: FlexProHRM <donotreply@gmail.com>" . "\r\n";

		

				//$headers .= "From: The Hotels Of India <naamnei@naamnei.xyz>" . "\r\n";

				

				if(mail($to,$subject,$txt,$headers))

				{

					$this->session->set_flashdata('success_message','Employee credential successfully send');	

					redirect('manage_employee_office');

				}

				else

				{

					$this->session->set_flashdata('error_message','Please try again.');		

					redirect('manage_employee_office');	

				}

	}



	/*function form_validate()

	{

		$this->load->library('form_validation');

		$this->form_validation->set_rules('department_id', 'Department Name', 'required');

		if ($this->form_validation->run() == FALSE)

		{

			return FALSE;

		}

		else

		{

			return true;

		}

	}*/

	##################################################################################################

}







