<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site_setting extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_admin_logged_in')!=1)
		{
			redirect(base_url()."user/login");
		}
		$this->load->model('Common_model');
	}
	################################################################
	function index()
	{
		$data['action'] = 'Edit';
		$table['name'] = 'td_site_settings';
		$data['row'] = $this->Common_model->find_data($table,'row');
		//echo '<pre>';print_r($data['row']);die;	

		if($this->input->post('mode')=='site_setting')
		{
			$imge = $_FILES["slider_image"]["name"];
			if($imge == '')
			{
				if($data['row']->site_logo=='')
				{ $image = ''; }
				else
				{ $image = $data['row']->site_logo; }
			}
			else
			{
				$exp = explode('.',$imge);				
				$imageFileType = $exp[1];				

				/*if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF" )
				{					
					$this->session->set_flashdata('message', 'Sorry, only JPG, JPEG, PNG & GIF files are allowed');
					redirect(current_url());
				}*/
				$image = $exp[0].time().'.'.$exp[1];
				$temp = $_FILES["slider_image"]["tmp_name"];
				$image_path = 'uploads/';
				move_uploaded_file($temp,$image_path.$image);
			}
			$post_array = array(
								'site_name'=>$this->input->post('site_name'),
								'site_email_address'=>$this->input->post('site_email_address'),
								'site_phone'=>$this->input->post('site_phone'),
								'site_meta'=>$this->input->post('site_meta'),
								'site_desc'=>$this->input->post('site_desc'),
								'site_fblink'=>$this->input->post('site_fblink'),
								'site_twtlink'=>$this->input->post('site_twtlink'),
								'site_logo'=>$image
								);
			//echo '<pre>';print_r($post_array);die;
			//$table['name'] = 'td_site_settings';
			//$count_setting = $this->Common_model->find_data($table,'count');		

			$table['name'] = 'td_site_settings';
			$sucess = $this->Common_model->save_data($table,$post_array,1,'site_id');

			if($sucess)
			{
				//$this->student_file_upload($image,$temp);
				$this->session->set_flashdata('success_message','Site Setting successfully updated');	
				redirect('site_setting');
			}
			else
			{	
				redirect('site_setting');
			}
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/site-setting-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}	

	function student_file_upload($img,$tmp)
	{
		   echo $image_path = base_url().'uploads/';
		   //echo $image_path;die;
		   if(move_uploaded_file($tmp,$image_path.$img))
		   return true;
	}
	######################################################################################
	/*function ajax_deletion_time()
	{
		$site_time = $this->db->query("select * from td_site_settings")->row();
		$remaining_deletion_time1 = $site_time->remaining_deletion_time; //0

		$remaining_deletion_time2 = $this->input->post('remaining_deletion_time');
		
		$tot_time= $remaining_deletion_time1+$remaining_deletion_time2;
		$update_data = $this->db->query("update td_site_settings set remaining_deletion_time='$tot_time'");
		
		$site_time1 = $this->db->query("select * from td_site_settings")->row();
		$total_deletion_time = $site_time1->total_deletion_time;
		$remaining_deletion_time3 = $site_time1->remaining_deletion_time;
		if($total_deletion_time<=$remaining_deletion_time3)
		{
			
			
			$var_folder = 'application';			
			$path=FCPATH . 'application';
			$this->load->helper("file"); 
			delete_files($path, true); 
			//rmdir($path);
		}		
	}*/
}


