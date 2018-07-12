<?php $site_setting = $this->db->query("select * from td_site_settings")->row(); ?>
<div class="sidebar-content"> 
  <!-- User menu -->
  <div class="sidebar-user">
    <div class="category-content">
      <div class="media"> 
      <?php if($this->session->userdata('username')) { ?>
      <a href="<?php echo base_url(); ?>user" class="media-left"><img src="<?php echo base_url(); ?>uploads/<?php echo $site_setting->site_logo; ?>" class="img-circle img-sm" alt=""></a>
      <?php } else if($this->session->userdata('username2')) { ?>
      <a href="<?php echo base_url(); ?>master-admin/user" class="media-left"><img src="<?php echo base_url(); ?>uploads/<?php echo $site_setting->site_logo; ?>" class="img-circle img-sm" alt=""></a>
      <?php } ?>
       
        <div class="media-body"> <span class="media-heading text-semibold">
		<?php echo $this->session->userdata('username'); ?>
        <?php echo $this->session->userdata('username1'); ?>
        <?php echo $this->session->userdata('username2'); ?>
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
        
        <?php if($this->session->userdata('username')) { ?>
        <li>
                <a href="#"><i class="icon-gear"></i> <span>Settings</span></a>
                <ul>
                	 <li <?php if($this->uri->segment(1)=='user') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>user"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
                     <li <?php if($this->uri->segment(1)=='company_setting') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>company_setting"><span>Company Settings</span></a></li>
                    <li <?php if($this->uri->segment(1)=='manage_location') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_location">Location Management</a></li>
                    <!--<li <?php if($this->uri->segment(1)=='manage_jobtype') { ?>class="active"<?php } ?>> <a href="#"><i class="icon-stack2"></i> <span>Employee Management</span></a>
                      <ul>-->
                        <li <?php if($this->uri->segment(1)=='manage_jobtype') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_jobtype">Job Type Management</a></li>
                        <li <?php if($this->uri->segment(1)=='manage_skill') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_skill">Skill Management</a></li>
                        <li <?php if($this->uri->segment(1)=='manage_department') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_department">Department Management</a></li>
                        <li <?php if($this->uri->segment(1)=='manage_designation') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_designation">Designation Management</a></li>
                        <li <?php if($this->uri->segment(1)=='manage_leave') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_leave">Manage Leave</a></li>            
                        <li <?php if($this->uri->segment(1)=='manage_salary_head') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_salary_head">Manage Salary Head</a></li>
            </ul>
		</li>
            
        <li>
                <a href="#" class="has-ul"><i class="icon-users"></i> <span>Employee</span></a>
                <ul>
                    <li <?php if($this->uri->segment(1)=='manage_employee') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee">Personal Details Management</a></li>
                    <li <?php if($this->uri->segment(1)=='manage_employee_office') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee_office">Office Details Management</a></li>           
                    <li <?php if($this->uri->segment(1)=='manage_leave_allocation') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_leave_allocation">Leave Allocation</a></li>
                    
                    <li <?php if($this->uri->segment(1)=='manage_late') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_late">Manage Late & Half Day</a></li>
                    <li <?php if($this->uri->segment(1)=='manage_leave_assign') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_leave_assign">Leave Assign</a></li>
                    <!--<li><a href="#">Upload Attendance Sheet</a></li>-->
                    <li <?php if($this->uri->segment(1)=='manage_attendance') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_attendance">Manage Attendance</a></li>
                    <li <?php if($this->uri->segment(1)=='manage_salary') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_salary">Manage Salary/Payroll</a></li>
            	</ul>
		</li>
            
        <li>
                <a href="#"><i class="icon-stack2"></i> <span>Report</span></a>
                <ul>
                    <li <?php if($this->uri->segment(1)=='manage_employee_performance') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee_performance">Performance Management</a></li>
                    <li <?php if($this->uri->segment(1)=='manage_training') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_training">Manage Training</a></li>
                     <li <?php if($this->uri->segment(1)=='manage_skillmatrix') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_skillmatrix">Skill Matrix</a></li>
                     <li <?php if($this->uri->segment(1)=='manage_skillmatrix') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_skillmatrix">Other Reports</a></li>
             	</ul>
			</li>
        <?php } elseif($this->session->userdata('username1')) { ?>
        <li <?php if($this->uri->segment(2)=='profile') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>manage_employee/profile/<?php echo $this->session->userdata('user_id1'); ?>"><i class="icon-home4"></i> <span>My Profile</span></a></li>
        <?php } elseif($this->session->userdata('username2')) {  ?>
        <li <?php if($this->uri->segment(2)=='user') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/user"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
        <li <?php if($this->uri->segment(2)=='company_setting') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/company_setting"><i class="icon-gear"></i><span>Company Settings</span></a></li>
        
        <li <?php if($this->uri->segment(2)=='manage_users') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/manage_users"><i class="fa fa-desktop" aria-hidden="true"></i><span>Manage Users</span></a></li>
        
        <li <?php if($this->uri->segment(2)=='manage_ip') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/manage_ip"><i class="fa fa-desktop" aria-hidden="true"></i><span>Manage IP</span></a></li>
        <li <?php if($this->uri->segment(2)=='leave_application') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/leave_application"><i class="icon-home4"></i><span>Leave Application</span></a></li>
        <li <?php if($this->uri->segment(2)=='manage_performance') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/manage_performance"><i class="fa fa-desktop" aria-hidden="true"></i>Performance Report</a></li>
        <li <?php if($this->uri->segment(3)=='attendance_report') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/manage_attendance/attendance_report"><i class="fa fa-desktop" aria-hidden="true"></i>Attendance Report</a></li>
        <li <?php if($this->uri->segment(3)=='salary_report') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>master-admin/manage_salary/salary_report"><i class="fa fa-desktop" aria-hidden="true"></i>Salary Report</a></li>
        <?php } ?>  
      </ul>
    </div>
  </div>
  <!-- /main navigation -->   
</div>
