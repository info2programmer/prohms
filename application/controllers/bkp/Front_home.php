<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Front_home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model(array('Common_model'));
		date_default_timezone_set("Asia/Kolkata");
	}	

	public function index()
	{		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/home',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	##################### search result ###############################################
	
	public function college_details()
	{			
		$college_cat = $this->input->post('college_cat');
		$college_name = $this->input->post('college_name');
		
		$data['college_name_for_no_data'] = $this->input->post('college_name');
		
		$user_details = $this->db->query("select * from td_users where college_name='$college_name'")->row();
		if($user_details)
		{
		$data['college_id'] = $user_details->id;
		
		$data['row'] = $this->db->query("select * from td_users where college_cat='$college_cat' and college_name='$college_name'")->row(); 
		}
		else
		{
			
		}
			
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		
		$data['maincontents'] = $this->load->view('maincontents/search-result-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	public function colleges($college,$cat)
	{			
		$college_cat = $cat;
		$college_name = $college;
		
		$data['college_name_for_no_data'] = $college;
		
		$user_details = $this->db->query("select * from td_users where college_name='$college_name'")->row();
		if($user_details)
		{
		$data['college_id'] = $user_details->id;
		
		$data['row'] = $this->db->query("select * from td_users where college_cat='$college_cat' and college_name='$college_name'")->row(); 
		}
		else
		{
			
		}
			
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);
		
		$data['maincontents'] = $this->load->view('maincontents/search-result-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	##################### search result ###############################################
	
	public function review()
	{
		if($this->input->post('mode')=='review')
		{
				$fields = array(
				'college_id' => $this->input->post('collge_id'),
				'name' => $this->input->post('txt_name'),
				'email' => $this->input->post('txt_email'),
				'review_content' => $this->input->post('txt_desc'),
				'review_date' => date("Y-m-d"),
				'rating' => $this->input->post('score'),
				'college_category' => $this->input->post('college_category'),
				'published' => 0
				);
				//echo '<pre>';print_r($fields);die;
				$table['name'] = 'td_review_ratings';
				$data = $this->Common_model->save_data($table,$fields,'','id');
				if($data)
				{
				$this->session->set_flashdata('success_message','Review successfully inserted');	
				redirect(base_url());
				}
		}
	}
	
	public function study_material()
	{
		$data['results'] = array();
		if($this->input->post('mode')=='study_material')
		{
			$tag = $this->input->post('tag');
			$data['results'] = $this->db->query("select * from td_notice_tender where title LIKE '%$tag%' and role='Study_Material'")->result();
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/study-material-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	public function coaching_information()
	{
		$data['results'] = array();
		if($this->input->post('mode')=='Coching')
		{
			$tag = $this->input->post('tag');
			$data['results'] = $this->db->query("select * from td_notice_tender where title LIKE '%$tag%' and role='Coching'")->result();
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/coaching-information-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	public function previous_year_questions()
	{
		$data['results'] = array();
		if($this->input->post('mode')=='Previous_Year_Questions')
		{
			$tag = $this->input->post('tag');
			$data['results'] = $this->db->query("select * from td_notice_tender where title LIKE '%$tag%' and role='Previous_Year_Questions'")->result();
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/previous-year-questions-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	public function placement_papers()
	{
		$data['results'] = array();
		if($this->input->post('mode')=='Placement_Paper')
		{
			$tag = $this->input->post('tag');
			$data['results'] = $this->db->query("select * from td_notice_tender where title LIKE '%$tag%' and role='Placement_Paper'")->result();
		}
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/placement-paper-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	public function accommodation()
	{		
		$table['name'] = 'td_pg_post';
		$conditions = array('published'=>1);
		$order_by[0] = array('field'=>'pg_id','type'=>'DESC');
		$data['results'] = $this->Common_model->find_data($table,'array','',$conditions,'','','',$order_by);
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/accommodation-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	public function accommodation_details($id)
	{		
		$table['name'] = 'td_pg_post';
		$conditions = array('published'=>1,'pg_id'=>$id);
		$data['result'] = $this->Common_model->find_data($table,'row','',$conditions);
		//echo '<pre>';print_r($data['result']);die;
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/accommodation-details-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	
	##################################### FORUM #############################################
	public function forum()
	{
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/forum-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	public function forum_thread_list($maincat,$subcat)
	{
		$data['maincat'] = $maincat;
		$data['subcat'] = $subcat;
		
		$data['maincat_details'] = $this->db->query("select * from td_category where cat_id='$maincat'")->row();
		if($maincat==6)
		{
			$data['subcat_details'] = $this->db->query("select * from td_area where id='$subcat'")->row();	
			//echo '<pre>';print_r($data['subcat_details']);die;
		}
		else
		{
			$data['subcat_details'] = $this->db->query("select * from td_category where cat_id='$subcat'")->row();
		}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/forum-thread-list-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	public function forum_new_thread($maincat,$subcat)
	{
		$data['maincat'] = $maincat;
		$data['subcat'] = $subcat;
		
		$data['maincat_details'] = $this->db->query("select * from td_category where cat_id='$maincat'")->row();
		$data['maincat_details'] = $this->db->query("select * from td_category where cat_id='$maincat'")->row();
		if($maincat==6)
		{
			$data['subcat_details'] = $this->db->query("select * from td_area where id='$subcat'")->row();	
		}
		else
		{
			$data['subcat_details'] = $this->db->query("select * from td_category where cat_id='$subcat'")->row();
		}
		
		if($this->input->post('mode')=='new_thread')
		{
			if($this->form_validate() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$row_id = rand();
				$user_id = $this->session->userdata('user_id1');
				if($maincat!=6) { 
				$post_array = array(
									'row_id'=>$row_id,
									'maincat_id'=>$maincat,									
									'subcat_id'=>$subcat,
									'thread_title'=>$this->input->post('title'),
									'thread_desc'=>$this->input->post('desc'),
									'thread_user_id'=>$user_id,
									'thread_date'=>date("Y-m-d h:i:s"),
									'thread_is_important'=>0,
									'published'=>1									
									);
				}
				else
				{
					$post_array = array(
									'row_id'=>$row_id,
									'maincat_id'=>$maincat,									
									'area_id'=>$subcat,
									'thread_title'=>$this->input->post('title'),
									'thread_desc'=>$this->input->post('desc'),
									'thread_user_id'=>$user_id,
									'thread_date'=>date("Y-m-d h:i:s"),
									'thread_is_important'=>0,
									'published'=>1									
									);
				}
				//echo '<pre>';print_r($post_array);die;
				$table['name'] = 'td_forum_thread';	
				$record = $this->Common_model->save_data($table,$post_array,'','thread_id');	
				$insert_id = $this->db->insert_id();		
				if($record)
				{	
					redirect('front_home/forum_thread/'.$insert_id);
				}
				else
				{
					redirect(current_url());	
				}
				
 			}
		}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/forum-new-thread-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	public function forum_thread($thread_id)
	{
		$data['thread_details'] = $this->db->query("select * from td_forum_thread where thread_id=$thread_id")->row();
		//echo '<pre>';print_r($thread_details);die;
		
		if($this->input->post('mode')=='reply')
		{			
			if($this->form_validate_reply() == FALSE)
			{
				$data['error_message']=validation_errors();
			}
			else
			{
				$row_id = rand();
				$user_id = $this->session->userdata('user_id1');
				$post_array = array(
									'row_id'=>$row_id,
									'thread_id'=>$this->input->post('thread_id'),									
									'reply_desc'=>$this->input->post('reply_desc'),
									'reply_user_id'=>$this->input->post('reply_user_id'),
									'reply_date'=>date("Y-m-d h:i:s"),
									'published'=>1									
									);
				//echo '<pre>';print_r($post_array);die;
				$table['name'] = 'td_thread_reply';	
				$record = $this->Common_model->save_data($table,$post_array,'','reply_id');	
				$insert_id = $this->input->post('thread_id');		
				if($record)
				{	
					$this->session->set_flashdata('success_message','Reply successfully placed...');
					redirect('front_home/forum_thread/'.$insert_id);
				}
				else
				{
					redirect(current_url());	
				}
				
 			}
		}
		
		$data['head'] = $this->load->view('elements/head','',true);
		$data['header'] = $this->load->view('elements/header','',true);
		$data['footer'] = $this->load->view('elements/footer','',true);		
		$data['maincontents'] = $this->load->view('maincontents/forum-thread-view',$data,true);
		$this->load->view('home_layout',$data);
	}
	####################################### FORUM #################################################
	public function message()
	{
		$a = $this->input->post('collge_id');
		$clg_details = $this->db->query("select * from td_users where id='$a'")->row();
		$college_name =  $clg_details->college_name;
		$college_cat =  $clg_details->college_cat;
		
		$post_message = array(
								'college_id'=>$this->input->post('collge_id'),
								'user_id'=>$this->input->post('user_id'),
								'is_important'=>0
								);
		//echo '<pre>';print_r($post_message);
		$table['name'] = 'td_messages';
		$succ1 = $this->Common_model->save_data($table,$post_message,'','message_id');
		$last_id = $this->db->insert_id();
		if($succ1)
		{
			$post_message_details = array(
								'college_id'=>$this->input->post('college_id'),
								'message_id'=>$last_id,								
								'subject'=>$this->input->post('subject'),
								'description'=>$this->input->post('txt_desc'),
								'from_msg'=>$this->input->post('from_msg'),
								'to_msg'=>$this->input->post('to_msg'),
								'date'=>date('Y-m-d'),
								'is_read'=>0
								);
			//echo '<pre>';print_r($post_message_details);
			$table2['name'] = 'td_message_details';
			$succ2 = $this->Common_model->save_data($table2,$post_message_details,'','id');
			if($succ2)
			{
				$this->session->set_flashdata('success_message','Message successfully send to college');	
				redirect('front_home/colleges/'.$college_name.'/'.$college_cat.'#Message');
			}
			else			
			{
				$this->session->set_flashdata('error_message','Message not send to college');	
				redirect('front_home/colleges/'.$college_name.'/'.$college_cat.'#Message');
			}
		}								
	}
	
	#################################### VALIDATION ###################################
	
	function form_validate()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('title', 'Title', 'required|min_length[5]|max_length[43]');
		$this->form_validation->set_rules('desc', 'Description', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			return FALSE;
		}
		else
		{
			return true;
		}
	}
	
	function form_validate_reply()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('reply_desc', 'Description', 'required');
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
			
			
			$js = 'class="form-control" id="college_name" required';			
            echo form_dropdown('college_name',$arrCities,set_select('college_name',$college_name),$js);			 		 
        }		
    }
	
	#################################### AJAX #########################################
}

