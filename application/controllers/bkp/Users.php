<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Common_model'));
	}	

	public function registration()
	{
		//$data['tab_string'] = $tab_string;
		
		$data = array();
		if($this->input->post('mode')=='student')
		{
			if($this->student_form_validate() == FALSE)
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
				if(($imageFileType != "jpg")&&($imageFileType != "JPG")&&($imageFileType != "png")&&($imageFileType != "PNG")&&($imageFileType != "JPEG")&&($imageFileType != "jpeg"))	
				{	
					$this->session->set_flashdata('err_message', 'Sorry, only PDF files are allowed');	
					redirect(current_url());	
				}	
				$image = time().$imge;	
				$temp = $_FILES["slider_image"]["tmp_name"];
				$image_path = 'uploads/student/';
				move_uploaded_file($temp,$image_path.$image);
			
				$fields = array(
				'user_type' => 'S',
				'student_name' => $this->input->post('student_name'),
				'phone' => $this->input->post('student_phone'),
				'email' => $this->input->post('student_email'),
				'address' => $this->input->post('student_address'),
				'username' => $this->input->post('student_username'),
				'password' => $this->input->post('student_password'),
				'logo_image' => $image,
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_users';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
					$last_insert_id= $this->db->insert_id();
					$record	= $this->db->query("select * from td_users where id='$last_insert_id'")->row();			
					$sessiondata1 = array(
										'user_id1' => $record->id,
										'username1' => $record->username,
										'is_user_logged_in1' => true,
										'user_type1' => $record->user_type
										);											
					//echo '<pre>';print_r($sessiondata1);die;
					$this->session->set_userdata($sessiondata1);
					if($this->session->userdata('is_user_logged_in1') == 1)
					{
						$id= $record->id;
						$last_login = date("Y-m-d h:i:sa");						
						$post_update_user = array(
													'ip_address'=>$this->input->ip_address(),
													'last_login'=>$last_login,
													'last_browser_used'=>$this->input->user_agent()
												);
						$update_user = $this->Common_model->save_data($table,$post_update_user,$id,'id');
						//$this->session->set_flashdata('college_success_message','College successfully registered. Redirecting... Please wait...');
						//header("Refresh:10;url=".base_url()."index.php/admin/user");
						
						$to = $this->input->post('student_email');
						$subject = "Bongineers registration credentials";
						$message = "
						<table width='600' style='max-width:100%; font-family:verdana,arial,sans-serif;'>
						<tr>
							<td align='center' colspan='2' style='padding-bottom: 25px'>
							<a href='http://thehotelsofindia.com/rc'><img src='http://thehotelsofindia.com/rc/assets/images/thoi.jpg'></a>
							</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>".$this->input->post('student_username')."</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>".$this->input->post('student_password')."</td>
						</tr>
						</table>
						";
						$txt = $message;					
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: Bongineers <subhomoy.projukti@gmail.com>" . "\r\n";
						
						if(@mail($to,$subject,$txt,$headers))
						{
							echo "succ";	
						}
						else
						{
							echo "failed";
						}
						redirect('admin/profile');
					}
				}
			}
		}
		else if($this->input->post('mode')=='college')
		{
			
			if($this->college_form_validate() == FALSE)
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
				if(($imageFileType != "jpg")&&($imageFileType != "JPG")&&($imageFileType != "png")&&($imageFileType != "PNG")&&($imageFileType != "JPEG")&&($imageFileType != "jpeg"))	
				{	
					$this->session->set_flashdata('err_message', 'Sorry, only PDF files are allowed');	
					redirect(current_url());	
				}	
				$image = time().$imge;	
				$temp = $_FILES["slider_image"]["tmp_name"];
				$image_path = 'uploads/college/';
				move_uploaded_file($temp,$image_path.$image);	
						
				$fields = array(
				'user_type' => 'C',
				'college_cat' => $this->input->post('college_cat'),
				'college_name' => $this->input->post('college_name'),
				'logo_image' => $image,
				'address' => $this->input->post('address'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'published'		=> 1
				);
				
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_users';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
					$last_insert_id= $this->db->insert_id();
					$record	= $this->db->query("select * from td_users where id='$last_insert_id'")->row();			
					$sessiondata1 = array(
										'user_id1' => $record->id,
										'username1' => $record->username,
										'is_user_logged_in1' => true,
										'user_type1' => $record->user_type
										);											

					$this->session->set_userdata($sessiondata1);
					if($this->session->userdata('is_user_logged_in1') == 1)
					{
						$id= $record->id;
						$last_login = date("Y-m-d h:i:sa");						
						$post_update_user = array(
													'ip_address'=>$this->input->ip_address(),
													'last_login'=>$last_login,
													'last_browser_used'=>$this->input->user_agent()
												);
						$update_user = $this->Common_model->save_data($table,$post_update_user,$id,'id');
						//$this->session->set_flashdata('college_success_message','College successfully registered. Redirecting... Please wait...');
						//header("Refresh:10;url=".base_url()."index.php/admin/user");
						
						$to = $this->input->post('email');
						$subject = "Bongineers registration credentials";
						$message = "
						<table width='600' style='max-width:100%; font-family:verdana,arial,sans-serif;'>
						<tr>
							<td align='center' colspan='2' style='padding-bottom: 25px'>
							<a href='http://sts24hours.com/bongineers/'><img src='http://sts24hours.com/bongineers/material/assets/img/logo.png'></a>
							</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>".$this->input->post('username')."</td>
						</tr>
						<tr>
							<td>Password</td>
							<td>".$this->input->post('password')."</td>
						</tr>
						</table>
						";
						$txt = $message;					
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: Bongineers <subhomoy.projukti@gmail.com>" . "\r\n";
						
						if(@mail($to,$subject,$txt,$headers))
						{
							echo "succ";	
						}
						else
						{
							echo "failed";
						}
						
						redirect('admin/profile');
					}
				}
			}
		
		}
		else if($this->input->post('mode')=='pg')
		{
			if($this->student_form_validate() == FALSE)
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
				if(($imageFileType != "jpg")&&($imageFileType != "JPG")&&($imageFileType != "png")&&($imageFileType != "PNG")&&($imageFileType != "JPEG")&&($imageFileType != "jpeg"))	
				{	
					$this->session->set_flashdata('err_message', 'Sorry, only jpg,png,jpeg files are allowed');	
					redirect(current_url());	
				}	
				$image = time().$imge;	
				$temp = $_FILES["slider_image"]["tmp_name"];
				$image_path = 'uploads/pg/';
				move_uploaded_file($temp,$image_path.$image);
			
				$fields = array(
				'user_type' => 'P',
				'student_name' => $this->input->post('student_name'),
				'phone' => $this->input->post('student_phone'),
				'email' => $this->input->post('student_email'),
				'address' => $this->input->post('student_address'),
				'username' => $this->input->post('student_username'),
				'password' => $this->input->post('student_password'),
				'logo_image' => $image,
				'published'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_users';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
					$last_insert_id= $this->db->insert_id();
					$record	= $this->db->query("select * from td_users where id='$last_insert_id'")->row();			
					$sessiondata1 = array(
										'user_id1' => $record->id,
										'username1' => $record->username,
										'is_user_logged_in1' => true,
										'user_type1' => $record->user_type
										);
					$this->session->set_userdata($sessiondata1);
					if($this->session->userdata('is_user_logged_in1') == 1)
					{
						$id= $record->id;
						$last_login = date("Y-m-d h:i:sa");						
						$post_update_user = array(
													'ip_address'=>$this->input->ip_address(),
													'last_login'=>$last_login,
													'last_browser_used'=>$this->input->user_agent()
												);
						$update_user = $this->Common_model->save_data($table,$post_update_user,$id,'id');
						//$this->session->set_flashdata('college_success_message','College successfully registered. Redirecting... Please wait...');
						//header("Refresh:10;url=".base_url()."index.php/admin/user");
						
						$to = $this->input->post('student_email');
						$subject = "Bongineers registration credentials";
						$message = "
						<table width='600' style='max-width:100%; font-family:verdana,arial,sans-serif;'>
						<tr>
							<td align='center' colspan='2' style='padding-bottom: 25px'>
							<a href='http://thehotelsofindia.com/rc'><img src='http://thehotelsofindia.com/rc/assets/images/thoi.jpg'></a>
							</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>".$this->input->post('student_username')."</td>
						</tr>
						<tr>
							<td>Username</td>
							<td>".$this->input->post('student_password')."</td>
						</tr>
						</table>
						";
						$txt = $message;					
						
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= "From: Bongineers <subhomoy.projukti@gmail.com>" . "\r\n";
						
						if(@mail($to,$subject,$txt,$headers))
						{
							echo "succ";	
						}
						else
						{
							echo "failed";
						}
						redirect('admin/profile');
					}
				}
			}
		}
		$data['mode']=$this->input->post('mode');
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/registration-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	function login($url_to_be_send)
	{
		$decoded_str=base64_decode(urldecode($url_to_be_send));
		
		if($this->input->post('mode')=='login')
		{			
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				//$user_type = $this->input->post('user_type');
						
			
				$conditions = array(
									'username'=>$this->input->post('username'),
									'password'=>$this->input->post('password')
									);					

				$table['name'] = 'td_users';
				$record = $this->Common_model->find_data($table,'row','',$conditions);
				if($record)
						{
							$sessiondata1 = array(
												'user_id1' => $record->id,
												'username1' => $record->username,
												'is_user_logged_in1' => true,
												'user_type1' => $record->user_type
												);											

							$this->session->set_userdata($sessiondata1);
							if($this->session->userdata('is_user_logged_in1') == 1)
							{
								$id= $record->id;
								$last_login = date("Y-m-d");
								$table['name'] = 'td_users';
								$post_update_user = array(
															'ip_address'=>$this->input->ip_address(),
															'last_login'=>$last_login,
															'last_browser_used'=>$this->input->user_agent()
														);
								$update_user = $this->Common_model->save_data($table,$post_update_user,$id,'id');
								//echo $decoded_str;die;
								if($this->uri->segment(3)!='')
								{
									redirect($decoded_str);
								}
								else
								{
									redirect('admin/profile');
								}
							}
						}
						else
						{	
							$this->session->set_flashdata('error_message','Invalid username or password');
							redirect(current_url());
						}
			}
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/login-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	#################################### VALIDATION ###################################
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		//$this->form_validation->set_rules('user_type', 'Type', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	
	function student_form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('student_name', 'Name', 'required');
		$this->form_validation->set_rules('student_phone', 'Phone Number', 'required');
		$this->form_validation->set_rules('student_email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('student_address', 'Adress', 'required');
		$this->form_validation->set_rules('student_username', 'Username', 'required|is_unique[td_users.username]');
		$this->form_validation->set_rules('student_password', 'Password', 'required');
		$this->form_validation->set_rules('student_agree', 'Agree', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function college_form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('college_cat', 'College Category', 'required');
		$this->form_validation->set_rules('college_name', 'College Name', 'required|is_unique[td_users.college_name]');
		$this->form_validation->set_rules('phone', 'College Phone', 'required');
		$this->form_validation->set_rules('email', 'College Email', 'required|valid_email|is_unique[td_users.email]');
		$this->form_validation->set_rules('address', 'College Adress', 'required');
		$this->form_validation->set_rules('username', 'College Username', 'required|is_unique[td_users.username]');
		$this->form_validation->set_rules('password', 'College Password', 'required');
		$this->form_validation->set_rules('agree', 'agree', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	#################################### VALIDATION ###################################
	
	#################################### AJAX #########################################
	
	function ajax_call() 
	{
        if (isset($_POST) && isset($_POST['state'])) 
		{
            $state = $_POST['state'];
			$college_name = $_POST['college_name'];				
			
			$select = 'id,college_name';
			$conditions=array('college_category'=>$state,'published'=>1,);
			$order_by[0] = array('field'=>'college_name','type'=>'ASC');
			$table['name']='td_colleges';
			$list = array('empty_name'=>' College','key'=>'id','value'=>'college_name');
			$arrCities =$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);
			
			
			$js = 'class="form-control" id="college_name"';			
            echo form_dropdown('college_name',$arrCities,set_select('college_name',$college_name),$js);			 		 
        }		
    }
	
	#################################### AJAX #########################################
}
