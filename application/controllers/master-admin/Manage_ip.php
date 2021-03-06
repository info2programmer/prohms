<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_ip extends CI_Controller {
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
		$table['name'] = 'td_ip';
		$conditions = array('show_ip'=>1);
		$order_by[0] = array('field'=>'td_ip.ip_id','type'=>'ASC');
		$select = 'td_ip.*,td_company_location.loc_name';
		$join[0] = array('table'=>'td_company_location','field'=>'loc_id','table_master'=>'td_ip','field_table_master'=>'location_id','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','',$conditions,$select,$join,'',$order_by);

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/manage-ip-list-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}

	######################################################################################	

	function add()
	{	

		$data['action'] = 'Add';
		
		$select = 'loc_id,loc_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'loc_name','type'=>'ASC');
		$table['name']='td_company_location';
		$list = array('empty_name'=>' location','key'=>'loc_id','value'=>'loc_name');
		$data['locations']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$fields = array(
				'ip_address' => $this->input->post('ip_address'),
				'location_id' => $this->input->post('location_id'),
				'published'		=> 1,
				'show_ip'		=> 1
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_ip';
				$data = $this->Common_model->save_data($table,$fields,'','ip_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','IP successfully inserted');	
				redirect('master-admin/manage_ip');
				}
				else
				{
				redirect('master-admin/manage_ip');	
				}
			}
		}

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-ip-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';		

		$conditions=array('ip_id'=>$id);
		$table['name'] = 'td_ip';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		
		$select = 'loc_id,loc_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'loc_name','type'=>'ASC');
		$table['name']='td_company_location';
		$list = array('empty_name'=>' location','key'=>'loc_id','value'=>'loc_name');
		$data['locations']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);

		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$fields = array(
				'ip_address' => $this->input->post('ip_address'),
				'location_id' => $this->input->post('location_id'),
				'show_ip'		=> 1
				);
				$table['name'] = 'td_ip';
				$data = $this->Common_model->save_data($table,$fields,$id,'ip_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','IP successfully inserted');	
				redirect('master-admin/manage_ip');
				}
				else
				{
				redirect('master-admin/manage_ip');	
				}
			}
		}

		

		$data['head'] = $this->load->view('master-admin/elements/head','',true);
		$data['header'] = $this->load->view('master-admin/elements/header','',true);
		$data['left_sidebar'] = $this->load->view('master-admin/elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('master-admin/elements/footer','',true);
		$data['maincontent']=$this->load->view('master-admin/maincontents/add-edit-ip-view',$data,true);
		$this->load->view('master-admin/layout-after-login',$data);
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
		$table['name'] = 'td_ip';
		if($this->Common_model->delete_data($table,$id,'ip_id'))
		{
			$this->session->set_flashdata('success_message','IP has been Deleted successfully.');
			redirect('master-admin/manage_ip');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('master-admin/manage_ip');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_ip';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'ip_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','IP successfully deactivated');
				redirect('master-admin/manage_ip');
			}
		else
			{
				redirect('master-admin/manage_ip');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_ip';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'ip_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','IP successfully activated');
				redirect('master-admin/manage_ip');
			}
		else
			{
				redirect('master-admin/manage_ip');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('ip_address', 'IP Address', 'required|is_unique[td_ip.ip_address]');
		$this->form_validation->set_rules('location_id', 'Location', 'required');
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



