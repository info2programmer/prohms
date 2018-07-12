<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company_setting extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('is_admin_logged_in2')!=1)
		{
			redirect(base_url()."master-admin/user/login");
		}
		$this->load->model('Common_model');
	}
	################################################################
	function index()
	{
		$data['action'] = 'Edit';
		$table['name'] = 'td_company_settings';
		$data['row'] = $this->Common_model->find_data($table,'row');
		//echo '<pre>';print_r($data['row']);die;	

		if($this->input->post('mode')=='company_setting')
		{
			$imge = $_FILES["slider_image"]["name"];
			if($imge == '')
			{
				if($data['row']->com_logo=='')
				{ $image = ''; }
				else
				{ $image = $data['row']->com_logo; }
			}
			else
			{
				$exp = explode('.',$imge);				
				$imageFileType = $exp[1];				

				$image = $exp[0].time().'.'.$exp[1];
				$temp = $_FILES["slider_image"]["tmp_name"];
				$image_path = 'uploads/';
				move_uploaded_file($temp,$image_path.$image);
			}
			
			$post_array = array(
								'com_name'=>$this->input->post('com_name'),
								'com_address'=>$this->input->post('com_address'),
								'com_phone'=>$this->input->post('com_phone'),
								'com_email'=>$this->input->post('com_email'),
								'com_logo'=>$image,
								'single_absent_in_lates'=>$this->input->post('single_absent_in_lates')
								);
			$table['name'] = 'td_company_settings';
			$sucess = $this->Common_model->save_data($table,$post_array,1,'com_id');

			if($sucess)
			{
				//$this->student_file_upload($image,$temp);
				$this->session->set_flashdata('success_message','Company Setting successfully updated');	
				redirect('master-admin/company_setting');
			}
			else
			{	
				redirect('master-admin/company_setting');
			}
		}
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/company-setting-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
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



