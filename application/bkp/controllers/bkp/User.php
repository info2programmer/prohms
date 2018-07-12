<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User extends CI_Controller {

	function __construct()

	{

		parent::__construct();

		if($this->uri->segment('3')=='login')

		{

						

		}

		

	}

	

	public function index()

	{

		/*if($this->session->userdata('is_admin_logged_in')!=1)

		{

			redirect(base_url()."index.php/admin/user/login");	

		}*/

		$data['head'] = $this->load->view('admin/elements/head','',true);

		$data['header'] = $this->load->view('admin/elements/header','',true);

		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('admin/elements/footer','',true);

		$data['maincontent']=$this->load->view('admin/maincontents/home',$data,true);

		

		$this->load->view('admin/layout-after-login',$data);

	}

	

	######################################################################################

	public function login()

	{

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
									
									'user_type'=>'A'

											);

						

						$table['name'] = 'td_users';					

						$record = $this->Common_model->find_data($table,'row','',$conditions);

						

						if($record)

						{

							$sessiondata = array(

												'user_id' => $record->id,

												'username' => $record->username,

												'is_admin_logged_in' => true

												);

												

							$this->session->set_userdata($sessiondata);

							if($this->session->userdata('is_admin_logged_in') == 1)

							{

								$id= $record->id;

								$last_login = date("Y-m-d h:i:sa");

								$table['name'] = 'td_users';

								$post_update_user = array(

															'ip_address'=>$this->input->ip_address(),

															'last_login'=>$last_login,

															'last_browser_used'=>$this->input->user_agent()

														);

								$update_user = $this->Common_model->save_data($table,$post_update_user,$id,'id');

								$this->session->set_flashdata('success_message','Log in success! Please wait...');

								header("Refresh:2;url=".base_url()."index.php/admin/user");

								//redirect(base_url().'index.php/admin/user');

							}						

						}

						else

						{	

							$this->session->set_flashdata('error_message','Invalid username or password');		

							redirect(current_url());					

						}

			}

		}

		$this->load->view('admin/layout-before-login');		

	}

	

	#####################################################################################

	

	function logout()

	{

		$this->session->sess_destroy();

		redirect(base_url()."index.php/admin/user/login");

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

			return true;

		}

	}

	

	#######################################################################################

	

	function change_password()

	{

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

								redirect(current_url());

							}

							else

							{	

								$this->session->set_flashdata('error_message','Invalid username or password! Please try again.');		

								redirect(current_url());					

							}					

				}

		}

		$data['head'] = $this->load->view('admin/elements/head','',true);

		$data['header'] = $this->load->view('admin/elements/header','',true);

		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('admin/elements/footer','',true);

		$data['maincontent']=$this->load->view('admin/maincontents/add-edit-password-view',$data,true);

		

		$this->load->view('admin/layout-after-login',$data);

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



