<!-- Page container -->

<div class="page-container"> 
  
  <!-- Page content -->
  <div class="page-content"> 
    <!-- Main content -->
    <div class="content-wrapper"> 
      
      <!-- Page header -->
      <div class="page-header">
        <div class="page-header-content">
          <div class="page-title">
            <h4><!--<i class="icon-arrow-left52 position-left"></i>--> <span class="text-semibold"><?php echo $row->application_subject; ?></span></h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>leave_application">Manage Leave Application</a></li>
            <li class="active"><?php echo $action; ?> Leave Application</li>
          </ul>
        </div>
      </div>
      <!-- /page header --> 
      
      <!-- Content area -->
      <div class="content"> 
        
        <!-- CKEditor default -->
					<div class="panel panel-flat">
						<div class="row">
						<div class="col-md-12">
    <span style="color:#090;"><?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?></span>
    <span style="color:#F00;"><?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('error_message'); } ?></span> <br />
							<div class="panel panel-default border-grey">
								<div class="panel-heading">
									<h6 class="panel-title">
									<?php 
									$sender_id = $row->sender_id; 
									$emp_detail = $this->db->query("select * from td_employee_personal_details where emp_id='$sender_id'")->row();
									echo $emp_detail->emp_name." ( ".$emp_detail->emp_code." )";
									?></h6>
									<div class="heading-elements">
										<span style="font-size:12px;"><?php echo date_format(date_create($row->application_date), "d M, Y"); ?></span>
				                	</div>
								</div>

								<div class="panel-body">
									<?php echo $row->description; ?>
								</div>
							</div>
                            <?php
							$application_id = $row->application_id;
							$reply_detail = $this->db->query("select * from td_application_reply where application_id='$application_id'")->result();
							if($reply_detail) { foreach($reply_detail as $reply) {
							?>
                            <div class="panel panel-default border-grey">
								<div class="panel-heading">
									<h6 class="panel-title">
									<?php
									if($reply->reply_sender!='admin') { 
									$reply_sender = $reply->reply_sender; 
									$emps = $this->db->query("select * from td_employee_personal_details where emp_id='$reply_sender'")->row();
									echo $emps->emp_name." ( ".$emps->emp_code." )";
									}
									else
									{
										echo $reply->reply_sender;
									}
									?></h6>
									<div class="heading-elements">
										<span style="font-size:12px;"><?php echo date_format(date_create($reply->reply_date), "d M, Y"); ?></span>
				                	</div>
								</div>

								<div class="panel-body">
									<?php echo $reply->reply_description; ?>                                    
								</div>
							</div>
                            <?php } } ?>
                            <?php
                            if($this->session->userdata('username'))
							{ $sender1 = $this->session->userdata('username'); }
							else if($this->session->userdata('username1'))
							{ $sender1 = $this->session->userdata('username1'); }
							else if($this->session->userdata('username2'))
							{ $sender1 = $this->session->userdata('username2'); }
							if($sender1!=='admin')
							{ $sender = $this->session->userdata('user_id1'); $receiver = 'admin,master admin';}
							else
							{ $sender = 'admin'; $receiver = $row->sender_id; } 
							?> 
                            <form action="<?php echo base_url();?>leave_application/reply" method="post">
                            	<input type="hidden" name="mode" value="tab" />
                            	<input type="hidden" name="application_id" value="<?php echo $row->application_id; ?>" />
                            	<input type="hidden" name="reply_sender" value="<?php echo $sender; ?>" />
                                <input type="hidden" name="reply_receiver" value="<?php echo $receiver; ?>" />
                            	<textarea rows="10" cols="5" name="reply_description" class="form-control" required="required" placeholder="Reply"></textarea>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Send Reply<i class="icon-arrow-right14 position-right"></i></button>
                                  </div>
                            </form>
                            
						</div>
                      </div>  						
					</div>
					<!-- /CKEditor default --> 
        
       <!-- Footer -->
    <div class="footer text-muted"> 
      <?php echo $footer; ?>
    </div>
    <!-- /footer -->
        
      </div>
      <!-- /content area --> 
      
    </div>
    <!-- /main content --> 
    
  </div>
  <!-- /page content --> 
  
</div>
<!-- /page container -->