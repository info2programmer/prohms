<?php $site_setting = $this->db->query("select * from td_site_settings")->row(); ?>



<?php

	   /*if($this->session->userdata('username'))

	   { $sn_id = $this->session->userdata('user_id'); 

	   $admin_unread = $this->db->query("select * from td_application_reply where is_admin_read=0")->num_rows();

	   }

	   elseif($this->session->userdata('username1'))

	   { $sn_id = $this->session->userdata('user_id1'); }

	   $count = 0;

	   $applications = $this->db->query("select * from td_application where sender_id='$sn_id'")->result();

	   foreach($applications as $application) {

		   $app_id = $application->application_id;

		   if($this->session->userdata('username1')) { 		   

		   	$reply_unread_count = $this->db->query("select * from td_application_reply where application_id='$app_id' and is_agent_read=0")->num_rows();

			$count+=$reply_unread_count;

		   }

	   }*/	   

?>

       

<div class="sidebar-content"> 

  <!-- User menu -->

  <div class="sidebar-user">

    <div class="category-content">

      <div class="media"> <a href="<?php echo base_url(); ?>prohms/user" class="media-left"><img src="<?php echo base_url(); ?>uploads/<?php echo $site_setting->site_logo; ?>" class="img-circle img-sm" alt=""></a>

        <div class="media-body"> <span class="media-heading text-semibold">

			<?php echo $this->session->userdata('username'); ?>

            <?php echo $this->session->userdata('username1'); ?>

            </span>

          <div class="text-size-mini text-muted"> <i class="icon-pin text-size-small"></i> &nbsp;Kolkata, West Bengal </div>

        </div>

        <div class="media-right media-middle">

        </div>

      </div>

    </div>

  </div>

  <!-- /user menu -->   

  <!-- Main navigation -->

  <div class="sidebar-category sidebar-category-visible">

    <div class="category-content no-padding">

      <ul class="navigation navigation-main navigation-accordion">

        

        <!-- Main -->

        <li <?php if($this->uri->segment(1)=='user') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>user"><i class="icon-home4"></i> <span>Dashboard</span></a></li>

        <?php if($this->session->userdata('username')) { ?>

        <?php if(($this->session->userdata('username')=='hr')||($this->session->userdata('username')=='admin')) { ?>

        <li>

                <a href="#"><i class="icon-gear"></i> <span>Settings</span></a>

                <ul>

                     <li <?php if($this->uri->segment(1)=='company_setting') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>company_setting"><span>Company Settings</span></a></li>

                    <li <?php if($this->uri->segment(1)=='manage_location') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_location">Location Management</a></li>

                    

                    <li <?php if($this->uri->segment(1)=='manage_jobtype') { ?>class="active"<?php } ?>> <a href="#"><i class="icon-stack2"></i> <span>Employee Management</span></a>

                      <ul>

                        <li <?php if($this->uri->segment(1)=='manage_jobtype') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_jobtype">Job Type Management</a></li>

                        

                        <li <?php if($this->uri->segment(1)=='manage_skill') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_skill">Skill Management</a></li>

                        <li <?php if($this->uri->segment(1)=='manage_department') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_department">Department Management</a></li>

                        <li <?php if($this->uri->segment(1)=='manage_designation') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_designation">Designation Management</a></li>

                        

                        <li <?php if($this->uri->segment(1)=='manage_leave') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_leave">Manage Leave</a></li>        

                         

                        <li <?php if($this->uri->segment(1)=='manage_salary_head') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_salary_head">Manage Salary Head</a></li>

            </ul>

		</li>

        <?php } ?>    

        <li>

                <a href="#" class="has-ul"><i class="icon-users"></i> <span>Team Member</span></a>

                <ul>

                <?php if(($this->session->userdata('username')=='hr')||($this->session->userdata('username')=='admin')) { ?>

                    <li <?php if($this->uri->segment(1)=='manage_employee') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee">Personal Details Management</a></li>

                    <li <?php if($this->uri->segment(1)=='manage_employee_office') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee_office">Office Details Management</a></li> 

                <?php } ?>    

                <?php if(($this->session->userdata('username')=='operations')) { ?>

                    <li <?php if($this->uri->segment(1)=='leave_application') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>leave_application"><span class="label bg-blue-400"><?php echo $admin_unread; ?></span>Leave Application</a></li>   

                <?php } ?>    

                           

                    <li <?php if($this->uri->segment(1)=='manage_leave_allocation') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_leave_allocation">Leave Allocation</a></li>

                    

                    <li <?php if($this->uri->segment(1)=='manage_late') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_late">Manage Late & Half Day</a></li>

                    <li <?php if($this->uri->segment(1)=='manage_leave_assign') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_leave_assign">Leave Assign</a></li>

                    <!--<li><a href="#">Upload Attendance Sheet</a></li>-->

                    

                   <?php if(($this->session->userdata('username')=='admin')) { ?> 

                    <li <?php if($this->uri->segment(1)=='manage_attendance'&&$this->uri->segment(2)=='') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_attendance">Manage Attendance</a></li>

                   <?php } ?> 

                    

               <?php if(($this->session->userdata('username')=='hr')||($this->session->userdata('username')=='admin')) { ?>    

                    <li <?php if($this->uri->segment(1)=='manage_salary') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_salary">Manage Salary/Payroll</a></li>

               <?php } ?>     

            	</ul>

		</li>

            

        <li>

                <a href="#"><i class="icon-stack2"></i> <span>Report</span></a>

                <ul>

                <?php if(($this->session->userdata('username')=='operations')) { ?>

                    <li <?php if($this->uri->segment(1)=='manage_performance') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_performance">Performance Management</a></li>

                <?php } ?>    

                    

                <?php if(($this->session->userdata('username')=='admin')) { ?>

                    <li <?php if($this->uri->segment(2)=='attendance_report') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_attendance/attendance_report">Attendance Report</a></li>

                <?php } ?>    

                <?php if(($this->session->userdata('username')=='hr')||($this->session->userdata('username')=='admin')) { ?>     

                    <li <?php if($this->uri->segment(2)=='salary_report') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_salary/salary_report">Salary Report</a></li>

                <?php } ?>

                    

                    <li <?php if($this->uri->segment(1)=='manage_training') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_training">Manage Training</a></li>

                     <li <?php if($this->uri->segment(1)=='manage_skillmatrix') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_skillmatrix">Skill Matrix</a></li>

                     <li <?php if($this->uri->segment(1)=='manage_skillmatrix') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_skillmatrix">Other Reports</a></li>

             	</ul>

			</li>

        <?php } elseif($this->session->userdata('username1')) { ?>

        <li <?php if($this->uri->segment(2)=='profile') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee/profile/<?php echo $this->session->userdata('user_id1'); ?>"><i class="icon-home4"></i> <span>My Profile</span></a></li>        

        <li <?php if($this->uri->segment(1)=='leave_application') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>leave_application"><i class="icon-home4"></i> <span>Leave Application</span><span class="label bg-blue-400"><?php echo $count; ?></span></a></li>

        <li <?php if($this->uri->segment(1)=='manage_employee_attendance') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee_attendance"><i class="icon-home4"></i> <span>Attendance View</span></a></li>

        <li <?php if($this->uri->segment(2)=='employee_salary') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_salary/employee_salary"><i class="icon-home4"></i> <span>Pay-in-slip View</span></a></li>

        <li <?php if($this->uri->segment(1)=='manage_employee_performance') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee_performance"><i class="icon-home4"></i>Performance report</a></li>

        <?php }elseif($this->session->userdata('username1')) {  ?>

        

        <?php } ?>     

      </ul>

    </div>

  </div>

  <!-- /main navigation -->   

</div>

