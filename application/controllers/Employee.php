<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee extends CI_Controller {
	function __construct()
	{
		parent::__construct();		
		date_default_timezone_set("Asia/Kolkata");
		
		
		
	}
	public function index()
	{	
		if(($this->session->userdata('is_admin_logged_in')!=1))
		{
			redirect(base_url());
		}		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontent']=$this->load->view('maincontents/home',$data,true);
		$this->load->view('layout-after-login',$data);
	}	
	
	

	######################################################################################

	public function login()
	{
		$hostname = $_SERVER['REMOTE_ADDR'];		
		$query = $this->db->query("select ip_address from td_ip where published=1");		
		$ips = array_column($query->result_array(),'ip_address');
		
		if (!in_array($hostname, $ips))
		{
			$this->load->view('layout-error');		
		}
		else {
				
		if($this->input->post('mode')=='login')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$conditions = array(
									'username'=>$this->input->post('username'),
									'password'=>$this->input->post('password'),
									'published'=>1
									);
				$table['name'] = 'td_employee_office_details';
				$record = $this->Common_model->find_data($table,'row','',$conditions);
				if($record)
				{
							$sessiondata1 = array(
												'user_id1' => $record->emp_id,
												'username1' => $record->username,
												'is_admin_logged_in' => true
												);												

							$this->session->set_userdata($sessiondata1);
							//echo '<pre>';print_r($sessiondata);die;
							if($this->session->userdata('is_admin_logged_in') == 1)
							{
								$id= $record->office_details_id;
								$last_login = date("Y-m-d h:i:sa");
								$table['name'] = 'td_employee_office_details';
								$post_update_user = array(
															'last_login'=>$last_login
														);
								$update_user = $this->Common_model->save_data($table,$post_update_user,$id,'office_details_id');
								
								$postdata_login = array(
														'emp_id' => $record->emp_id,
														'login_time' => date('Y-m-d H:i:s')
														);
								//echo '<pre>';print_r($postdata_login);die;						
								$table3['name'] = 'td_login';						
								$insert_login = $this->Common_model->save_data($table3,$postdata_login,'','login_id');
								$last_insert_login_id = $this->db->insert_id();
								$this->session->set_userdata(array('last_insert_id' =>$last_insert_login_id));
								$this->session->set_flashdata('success_message','Log in success! Please wait...');
								header("Refresh:2;url=".base_url()."user");
								//redirect(base_url().'admin/user');
							}
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password');	
							redirect(current_url());
						}
			}
		}
		$this->load->view('layout-before-login');	
		}
	}

	

	#####################################################################################

	

	function logout()
	{
		$emp_id = $this->session->userdata('user_id1');
		$id = $this->session->userdata('last_insert_id');
		$postdata_login = array(
								'logout_time' => date('Y-m-d H:i:s')
								);						
		$table3['name'] = 'td_login';						
		$insert_login = $this->Common_model->save_data($table3,$postdata_login,$id,'login_id');
		$this->session->sess_destroy();
		redirect(base_url()."employee/login");
	}
	
	function front_logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
	#####################################################################################	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	#######################################################################################

	function change_password()
	{
		if($this->session->userdata('is_admin_logged_in')!=1)
		{
			redirect(base_url());
		}
		if($this->input->post('mode')=='change_pass')
		{	
			if($this->password_validate() == FALSE)
				{
					$data['error_message']=validation_errors();
				}
				else
				{
							$postdata_ch_pass = array(
												'password'=>$this->input->post('new_password')
												);							

							if($this->session->userdata('user_id'))
							{
							$user_id = $this->session->userdata('user_id');
							}
							else if($this->session->userdata('user_id1'))
							{
							$user_id = $this->session->userdata('user_id1');	
							}	

							$table['name'] = 'td_users';
							$success = $this->Common_model->save_data($table,$postdata_ch_pass,$user_id,'id');
							if($success)
							{	
								$this->session->set_flashdata('success_message','Password changed successfully');
								redirect('user/logout');
							}
							else
							{	
								$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');
								redirect(current_url());
							}
				}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-password-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	

	function password_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_existing_password');
		$this->form_validation->set_rules('new_password', 'New Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[new_password]');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}

	function existing_password($str)
	{
		$old_password =  $str;		
		if($this->session->userdata('user_id'))
		{
		$user_id1 = $this->session->userdata('user_id');
		}
		else if($this->session->userdata('user_id1'))
		{
		$user_id1 = $this->session->userdata('user_id1');	
		}
		
		$table['name'] = 'td_users';
		$conditions = array('id'=>$user_id1);
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['row']);die;
		$existing_password = $data['row']->password;
		if ($existing_password != $old_password)
		{
			$this->form_validation->set_message('existing_password', 'Old Password is incorrect!');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	########################################################################################################
}



