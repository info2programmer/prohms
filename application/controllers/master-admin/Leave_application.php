<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leave_application extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		if(($this->session->userdata('is_admin_logged_in2')!=1))

		{

			redirect(base_url());	

		}		
		$this->load->model(array('Common_model'));
	}

	################################################################

	function index()
	{
		if($this->session->userdata('username')) {
		$sender = $this->session->userdata('username');
		}
		else if($this->session->userdata('username1')) {
		$sender = $this->session->userdata('username1');
		$sn_id = $this->session->userdata('user_id1');
		}
		else if($this->session->userdata('username2')) {
		$sender = $this->session->userdata('username2');
		$sn_id = $this->session->userdata('user_id2');
		}
		$table['name'] = 'td_application';
		if($sender!='master admin') { 
		$conditions = array('sender_id'=>$sn_id);
		}
		if($sender!='master admin') { 
		$data['rows'] = $this->Common_model->find_data($table,'array','',$conditions);
		}
		else {
		$data['rows'] = $this->Common_model->find_data($table,'array');
		}

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/manage-leave-application-list-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}

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
				$sender_id = $this->session->userdata('user_id1');
				$sender_name = $this->session->userdata('username1');
				if($sender_name!='admin' || $sender_name!='master admin')
				{
					$receiver_id = 'admin,master admin';
				}
		
				$fields = array(
				'sender_id' => $sender_id,
				'receiver_id' => $receiver_id,
				'application_subject' => $this->input->post('application_subject'),
				'description' => $this->input->post('description'),
				'application_date' => date('Y-m-d')
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_application';
				$data = $this->Common_model->save_data($table,$fields,'','');
				if($data)
				{
				$this->session->set_flashdata('success_message','Leave application successfully send');	
				redirect('master-admin/leave_application');
				}
				else
				{
				redirect('master-admin/leave_application');	
				}
			}
		}

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-leave-application-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}

	######################################################################################

	
	function view($id)
	{
		$data['action'] = 'View';
		
		$data['row'] = $this->db->query("select * from td_application where application_id='$id'")->row();
		
		if($this->session->userdata('username')) {			
			$update = $this->db->query("UPDATE `td_application_reply` SET `is_admin_read`=1 WHERE `application_id`='$id'");
		}
		elseif($this->session->userdata('username1')) {	
			$update = $this->db->query("UPDATE `td_application_reply` SET `is_agent_read`=1 WHERE `application_id`='$id'");
		}
		
		
		
		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/leave-application-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}
	
	function reply()
	{
		if($this->input->post('mode')=='tab')
		{
			
			$fields = array(
				'application_id' => $this->input->post('application_id'),
				'reply_sender' => $this->input->post('reply_sender'),
				'reply_receiver' => $this->input->post('reply_receiver'),
				'reply_description' => $this->input->post('reply_description'),
				'reply_date' => date('Y-m-d')
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_application_reply';
				$data = $this->Common_model->save_data($table,$fields,'','');
				if($data)
				{
				$application_id = $this->input->post('application_id');	
				$this->session->set_flashdata('success_message','Leave application reply successfully send');	
				redirect('master-admin/leave_application/view/'.$application_id);
				}
				else
				{
				redirect('master-admin/leave_application/view/'.$application_id);
				}
		}
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
		$table['name'] = 'td_employee_skill_matrix';
		if($this->Common_model->delete_data($table,$id,'sm_id'))
		{
			$this->session->set_flashdata('success_message','Skill Matrix has been Deleted successfully.');
			redirect('master-admin/leave_application');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('master-admin/leave_application');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_employee_skill_matrix';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'sm_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Skill Matrix successfully deactivated');
				redirect('master-admin/leave_application');
			}
		else
			{
				redirect('master-admin/leave_application');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_employee_skill_matrix';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'sm_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Skill Matrix successfully activated');
				redirect('master-admin/leave_application');
			}
		else
			{
				redirect('master-admin/leave_application');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('application_subject', 'Application subject', 'required');
		$this->form_validation->set_rules('description', 'Application details', 'required');
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



