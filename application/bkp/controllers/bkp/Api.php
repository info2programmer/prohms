<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Common_model'));
	}	

	/*public function registration()
	{
		
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
			
				$table['name'] = 'td_users';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
					$last_insert_id= $this->db->insert_id();
					$record	= $this->db->query("select * from td_users where id='$last_insert_id'")->row();			
					$sessiondata1 = array(
										'id1' => $record->id,
										'username1' => $record->username,
										'is_user_logged_in1' => true
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
						redirect('admin/user');
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
				
				
				$table['name'] = 'td_users';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
					$last_insert_id= $this->db->insert_id();
					$record	= $this->db->query("select * from td_users where id='$last_insert_id'")->row();			
					$sessiondata1 = array(
										'id1' => $record->id,
										'username1' => $record->username,
										'is_user_logged_in1' => true
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
						
						redirect('admin/user');
					}
				}
			}
		
		}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/registration-view',$data,true);
		$this->load->view('home_layout',$data);
	}*/
	
	function login($mode,$username,$password)
	{
		if($mode=='login')
		{	
			/*echo $username."<br>";
			echo $password."<br>";	
			die;*/					
				$conditions = array(
									'username'=>$username,
									'password'=>$password,									
									'user_type!='=>'A'
									);					

				$table['name'] = 'td_users';
				$record = $this->Common_model->find_data($table,'row','',$conditions);
				if($record)
						{
							$sessiondata = array(
												'user_id' => $record->id,
												'username' => $record->username,
												'is_user_logged_in' => true
												);											

							$this->session->set_userdata($sessiondata);
							if($this->session->userdata('is_user_logged_in') == 1)
							{
								$user_type = $record->user_type;
								if($user_type=='C')
								{
									$image_path = 'http://sts24hours.com/bongineers/uploads/college/'.$record->logo_image;
									$data = array(
												'userID' =>  $record->id,
												'user' => $record->username,
												'image' => $image_path,
												'user_type' => $user_type,
												'status'=>1
											);	
								}
								else if($user_type=='S')
								{
									$image_path = 'http://sts24hours.com/bongineers/uploads/student/'.$record->logo_image;
									$data = array(
												'userID' => $record->id,
												'user' => $record->username,
												'image' => $image_path,
												'user_type' => $user_type,
												'status'=>1
											);
								}
								
								header('Content-Type: application/json');			
								echo $json = json_encode($data);
							}
						}
						else
						{	
							$status = array('status'=>0);
							header('Content-Type: application/json');			
							echo $json = json_encode($status);
						}			
		}
	}	
}
