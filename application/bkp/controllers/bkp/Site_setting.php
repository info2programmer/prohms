<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Site_setting extends CI_Controller {

	function __construct()

	{

		parent::__construct();

		

		if($this->session->userdata('is_admin_logged_in')!=1)

		{

			redirect(base_url()."index.php/admin/user/login");	

		}

		

		$this->load->model('common_model');

	}

	################################################################

	function index()

	{

		$data['action'] = 'Edit';

		

		$table['name'] = 'td_site_settings';

		$data['row'] = $this->common_model->find_data($table,'row');

		//echo '<pre>';print_r($data['row']);die;

		

		if($this->input->post('mode')=='site_setting')

		{
			

			$imge = $_FILES["slider_image"]["name"];

			

			if($imge == '')

			{

				if($data['row']->site_logo=='')

				{

					$image = '';

				}

				else

				{

					$image = $data['row']->site_logo;

				}

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

			//$count_setting = $this->common_model->find_data($table,'count');

			

			$table['name'] = 'td_site_settings';

			$sucess = $this->common_model->save_data($table,$post_array,1,'site_id');

				

				

								

			

			if($sucess)

			{

				//$this->student_file_upload($image,$temp);

				 	

				$this->session->set_flashdata('success_message','Site Setting successfully updated');	

				redirect('admin/site_setting');

			}

			else

			{	

				redirect('admin/site_setting');

			}

			

		}

		

		$data['head'] = $this->load->view('admin/elements/head','',true);

		$data['header'] = $this->load->view('admin/elements/header','',true);

		$data['left_sidebar'] = $this->load->view('admin/elements/left-sidebar','',true);

		$data['footer'] = $this->load->view('admin/elements/footer','',true);

		$data['maincontent']=$this->load->view('admin/maincontents/site-setting-view',$data,true);

		$this->load->view('admin/layout-after-login',$data);

	}

	

	function student_file_upload($img,$tmp)

	   {

		   echo $image_path = base_url().'uploads/';

		   //echo $image_path;die;

		   if(move_uploaded_file($tmp,$image_path.$img))

		   return true;

	   }

	######################################################################################

	

}



