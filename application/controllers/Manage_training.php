<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_training extends CI_Controller {
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
		$table['name'] = 'td_training';
		$order_by[0] = array('field'=>'td_training.trn_id','type'=>'ASC');
		$select = 'td_training.*,td_skill.skill_name';
		$join[0] = array('table'=>'td_skill','field'=>'skill_id','table_master'=>'td_training','field_table_master'=>'trn_skill','type'=>'Inner');
		$data['rows'] = $this->Common_model->find_data($table,'array','','',$select,$join,'',$order_by);

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/manage-training-list-view',$data,true);
		$this->load->view('layout-after-login',$data);
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
				$fields = array(
				'trn_name' => $this->input->post('trn_name'),
				'from_date' => date_format(date_create($this->input->post('from_date')), "Y-m-d"),
				'to_date' => date_format(date_create($this->input->post('to_date')), "Y-m-d"),
				'trn_skill' => $this->input->post('trn_skill'),
				'published'		=> 1
				);				
				$table['name'] = 'td_training';
				$data = $this->Common_model->save_data($table,$fields,'','');
				if($data)
				{
					$insert_id = $this->db->insert_id();
					$sets=$this->input->post('num');
					$total = 0;
					for($loop=0;$loop<$sets;$loop++)
					{
						$emp_id = $_REQUEST['emp_id'][$loop];
						$note = $_REQUEST['note'][$loop];
						
						
						$total += $sale_amount[$loop];
						
						$postdata2 = array(
									'trn_id'=>$insert_id,
									'emp_id'=>$emp_id,
									'note'=>$note,
								);
					   $table['name'] = 'td_training_details';
				       $success2 = $this->Common_model->save_data($table,$postdata2,'','');			
					}
					//echo '<pre>';print_r($postdata2);die;				
					if($success2) { 	
						$this->session->set_flashdata('success_message','Training successfully inserted');	
						redirect('manage_training');
					}
				}
				else
				{
					redirect('manage_training');	
				}
			}
		}

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-training-view',$data,true);
		$this->load->view('layout-after-login',$data);
	}

	######################################################################################

	

	function edit($id)
	{
		$data['action'] = 'Edit';
		
		$select = 'department_id,department_name';
		$conditions=array('published'=>1);
		$order_by[0] = array('field'=>'department_id','type'=>'ASC');
		$table['name']='td_department';
		$list = array('empty_name'=>' department Name','key'=>'department_id','value'=>'department_name');
		$data['departments']=$this->Common_model->find_data($table,'list',$list,$conditions,$select,'','',$order_by);		

		$conditions=array('designation_id'=>$id);
		$table['name'] = 'td_employee_performance';
		$data['row'] = $this->Common_model->find_data($table,'row','',$conditions);
		if($this->input->post('mode')=='tab')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$fields = array(
				'department_id' => $this->input->post('department_id'),
				'designation_name' => $this->input->post('designation_name'),
				'published'		=> 1
				);	

				$table['name'] = 'td_employee_performance';
				$data = $this->Common_model->save_data($table,$fields,$id,'designation_id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Designation successfully updated');	
				redirect('manage_training');
				}
				else
				{
				redirect('manage_training');	
				}
			}
		}

		

		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['left_sidebar'] = $this->load->view('elements/left-sidebar','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		$data['maincontent']=$this->load->view('maincontents/add-edit-training-view',$data,true);
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
		$table['name'] = 'td_employee_performance';
		if($this->Common_model->delete_data($table,$id,'emp_performance_id'))
		{
			$this->session->set_flashdata('success_message','Employee performance has been Deleted successfully.');
			redirect('manage_training');
		}
		else
		{
			$this->session->set_flashdata('error_message','Some error occurred during delete! Please try again.');
			redirect('manage_training');
		}
	}	

	##############################################################################################	

	function deactive($id)
	{
		$postdata = array(
							'published' => 0
						);
		$table['name'] = 'td_employee_performance';
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'emp_performance_id');	

		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee performance successfully deactivated');
				redirect('manage_training');
			}
		else
			{
				redirect('manage_training');			
		}
	}


	function active($id)
	{
		$postdata = array(
							'published' => 1
						);
		$table['name'] = 'td_employee_performance';	
		$deactive = $this->Common_model->save_data($table,$postdata,$id,'emp_performance_id');
		if($deactive)
			{	
				$this->session->set_flashdata('success_message','Employee performance successfully activated');
				redirect('manage_training');
			}
		else
			{
				redirect('manage_training');
			}
	}

	##############################################################################################

	

	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('trn_name', 'Training Name', 'required');
		$this->form_validation->set_rules('trn_skill', 'Training Skill', 'required');
		$this->form_validation->set_rules('emp_id[]', 'Employee Name', 'required');
		$this->form_validation->set_rules('from_date', 'From date', 'required');
		$this->form_validation->set_rules('to_date', 'To date', 'required');
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