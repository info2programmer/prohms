<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_employee extends CI_Controller {
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
		$table['name'] = 'td_employee_personal_details';
		$order_by[0] = array('field'=>'td_employee_personal_details.emp_id','type'=>'desc');
		$join[0] = array('table'=>'td_department','field'=>'department_id','table_master'=>'td_employee_personal_details','field_table_master'=>'department_id','type'=>'inner');	
		$select = 'td_employee_personal_details.*,td_department.department_name';	
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-employee-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}
	
	function profile($id)
	{
		$table['name'] = 'td_employee_personal_details';
		$conditions=array('td_employee_personal_details.published'=>1, 'td_employee_personal_details.emp_id'=>$id);
		$order_by[0] = array('field'=>'td_employee_personal_details.emp_id','type'=>'desc');
		$join[0] = array('table'=>'td_department','field'=>'department_id','table_master'=>'td_employee_personal_details','field_table_master'=>'department_id','type'=>'inner');
		$join[1] = array('table'=>'td_employee_office_details','field'=>'emp_id','table_master'=>'td_employee_personal_details','field_table_master'=>'emp_id','type'=>'inner');
		$join[2] = array('table'=>'td_designation','field'=>'designation_id','table_master'=>'td_employee_office_details','field_table_master'=>'designation_id','type'=>'inner');
		$select = 'td_employee_personal_details.*,td_employee_office_details.*,td_department.department_name,td_designation.designation_name';	
		$data['rows'] = $this->Common_model->find_data($table,'row','',$conditions,$select,$join,'',$order_by);
		//echo '<pre>';print_r($data['rows']);die;
		/*$table['name'] = 'td_employee_performance';
		$conditions=array('published'=>1, 'emp_id'=>$id);
		$order_by[0] = array('field'=>'from_date','type'=>'desc');
		$data['rows_pfm'] = $this->Common_model->find_data($table,'array','',$conditions,'','','',$order_by);*/

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/employee-profile-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################	

	function add()
	{	

		$data['action'] = 'Add';
		
		$select = 'country_id,country_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'country_name','type'=>'ASC');
		$table['name']='td_country';
		$list = array('empty_name'=>' country Name','key'=>'country_id','value'=>'country_name');
		$data['countries']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
		$select = 'department_id,department_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'department_id','type'=>'ASC');
		$table['name']='td_department';
		$list = array('empty_name'=>' department Name','key'=>'department_id','value'=>'department_name');
		$data['departments']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$imge = $_FILES["slider_image"]["name"];
				if($imge == '')
				{
					$this->session->set_flashdata('err_message', 'Please upload an image');
					redirect(current_url());
				}
				$imageFileType = pathinfo($imge, PATHINFO_EXTENSION);
				if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG")
				{
					$this->session->set_flashdata('err_message', 'Sorry, only jpg,png,jpeg files are allowed');
					redirect(current_url());
				}
				$image = time().$imge;
				$temp = $_FILES["slider_image"]["tmp_name"];
				$image_path = 'uploads/employee/';
				//echo $image_path;die;
				move_uploaded_file($temp,$image_path.$image);
				
				$department_id = $this->input->post('department_id');
				$dept_list = $this->db->query("select * from td_department where department_id='$department_id'")->row();
				if($dept_list) { $department_prefix = $dept_list->department_prefix; }
				
				$emp_details = $this->db->query("select * from td_employee_personal_details where department_id='$department_id' order by emp_id desc")->row();
				if($emp_details) { 
				$emp_code_array = explode("/",$emp_details->emp_code);
				$c =$emp_code_array[1]+1;
				$emp_code = $department_prefix."/".str_pad($c, 5, "0", STR_PAD_LEFT);
				}
				else { 
				$emp_code = $department_prefix."/00001";
				}

		  		
				$fields = array(
				'emp_code' => $emp_code,
				'department_id' => $this->input->post('department_id'),
				'salutation' => $this->input->post('salutation'),
				'emp_name' => $this->input->post('emp_name'),
				'gender' => $this->input->post('gender'),
				'father_name' => $this->input->post('father_name'),
				'email' => $this->input->post('email'),
				'dob' => date_format(date_create($this->input->post('dob')), "Y-m-d"),
				'present_address' => $this->input->post('present_address'),
				'permanent_address' => $this->input->post('permanent_address'),
				'phone' => $this->input->post('phone'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'pin' => $this->input->post('pin'),
				'personal_email' => $this->input->post('personal_email'),
				'mobile' => $this->input->post('mobile'),
				'blood_group' => $this->input->post('blood_group'),
				'votar_no' => $this->input->post('votar_no'),
				'pan_no' => $this->input->post('pan_no'),
				'passport_no' => $this->input->post('passport_no'),
				'passport_expiry' => date_format(date_create($this->input->post('passport_expiry')), "Y-m-d"),
				'aadhar_no' => $this->input->post('aadhar_no'),
				'marital_status' => $this->input->post('marital_status'),
				'spouse_name' => $this->input->post('spouse_name'),
				'profile_image' => $image,				
				'published'	=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_employee_personal_details';
				$data = $this->Common_model->save_data($table,$fields,'','emp_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Employee successfully inserted');	
				redirect('manage_employee');
				}
				else
				{
				redirect('manage_employee');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$select = 'country_id,country_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'country_name','type'=>'ASC');
		$table['name']='td_country';
		$list = array('empty_name'=>' country Name','key'=>'country_id','value'=>'country_name');
		$data['countries']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
		
		$select = 'department_id,department_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'department_id','type'=>'ASC');
		$table['name']='td_department';
		$list = array('empty_name'=>' department Name','key'=>'department_id','value'=>'department_name');
		$data['departments']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);		

		$conditions=array('emp_id'=>$id);
		$table['name'] = 'td_employee_personal_details';
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
				$imge = $_FILES["slider_image"]["name"];
				if($imge == '')
				{
					$image = $data['row']->profile_image;
				}
				else
				{
					$imageFileType = pathinfo($imge, PATHINFO_EXTENSION);
					if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "PNG" && $imageFileType != "jpeg" && $imageFileType != "JPEG")
					{
						$this->session->set_flashdata('err_message', 'Sorry, only jpg,png,jpeg files are allowed');
						redirect(current_url());
					}
					$image = time().$imge;
					$temp = $_FILES["slider_image"]["tmp_name"];
					$image_path = 'uploads/employee/';
					//echo $image_path;die;
					move_uploaded_file($temp,$image_path.$image);				
				}
		  		
				$fields = array(
				'department_id' => $this->input->post('department_id'),
				'salutation' => $this->input->post('salutation'),
				'emp_name' => $this->input->post('emp_name'),
				'gender' => $this->input->post('gender'),
				'father_name' => $this->input->post('father_name'),
				'email' => $this->input->post('email'),
				'dob' => date_format(date_create($this->input->post('dob')), "Y-m-d"),
				'present_address' => $this->input->post('present_address'),
				'permanent_address' => $this->input->post('permanent_address'),
				'phone' => $this->input->post('phone'),
				'country' => $this->input->post('country'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'pin' => $this->input->post('pin'),
				'personal_email' => $this->input->post('personal_email'),
				'mobile' => $this->input->post('mobile'),
				'blood_group' => $this->input->post('blood_group'),
				'votar_no' => $this->input->post('votar_no'),
				'pan_no' => $this->input->post('pan_no'),
				'passport_no' => $this->input->post('passport_no'),
				'passport_expiry' => date_format(date_create($this->input->post('passport_expiry')), "Y-m-d"),
				'aadhar_no' => $this->input->post('aadhar_no'),
				'marital_status' => $this->input->post('marital_status'),
				'spouse_name' => $this->input->post('spouse_name'),
				'profile_image' => $image,				
				'published'	=> 1
				);	
			 	//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_employee_personal_details';
				$data = $this->Common_model->save_data($table,$fields,$id,'emp_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Employee successfully updated');	
				redirect('manage_employee');
				}
				else
				{
				redirect('manage_employee');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-employee-view',$data,true);
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
		$table['name'] = 'td_employee_personal_details';
		if($this->Common_model->delete_data($table,$id,'emp_id'))
		{
			$this->session->set_flashdata('success_message','Employee has been Deleted successfully.');
			redirect('manage_employee');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_employee');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_employee_personal_details';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'emp_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee successfully deactivated');
				redirect('manage_employee');
			}
		else
			{
				redirect('manage_employee');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_employee_personal_details';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'emp_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee successfully activated');
				redirect('manage_employee');
			}
		else
			{
				redirect('manage_employee');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('department_id', 'Department Name', 'required');
		$this->form_validation->set_rules('salutation', 'Salutation', 'required');
		$this->form_validation->set_rules('emp_name', 'Name', 'required');
		$this->form_validation->set_rules('gender', 'Gender', 'required');
		$this->form_validation->set_rules('father_name', 'Father Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('dob', 'Dob', 'required');
		$this->form_validation->set_rules('present_address', 'Present Address', 'required');
		$this->form_validation->set_rules('permanent_address', 'Permanent Address', 'required');
		$this->form_validation->set_rules('country', 'Country', 'required');
		$this->form_validation->set_rules('state', 'State', 'required');
		$this->form_validation->set_rules('city', 'City', 'required');
		$this->form_validation->set_rules('pin', 'Pincode', 'required');
		$this->form_validation->set_rules('personal_email', 'Personal Email', 'required');
		$this->form_validation->set_rules('mobile', 'Mobile', 'required');
		$this->form_validation->set_rules('votar_no', 'Votar No', 'required');
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



