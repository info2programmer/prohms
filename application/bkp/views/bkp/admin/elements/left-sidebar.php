<div class="sidebar sidebar-main hidden-xs">
  <div class="sidebar-content"> 
    
    <!-- User menu -->
    
    <div class="sidebar-user">
      <div class="category-content">
        <div class="media"> <a href="index.htm#" class="media-left"><img src="<?php echo base_url(); ?>material/admin_logo_bongineers.jpg" class="img-circle img-sm" alt=""></a>
          <div class="media-body"> <span class="media-heading text-semibold">
		  <?php if($this->session->userdata('username')) { echo $this->session->userdata('username'); }  ?>
          <?php if($this->session->userdata('username1')) { echo $this->session->userdata('username1'); }  ?>
          </span>
          <?php if($this->session->userdata('username')=='admin') { ?>
            <div class="text-size-mini text-muted"> Admin </div>            
            <?php } ?>
            <div class="text-size-mini text-muted"> <a target="_blank" href="<?php echo base_url(); ?>">Visit Website</a> </div>
          </div>
          <div class="media-right media-middle"> 
            
            <!--<ul class="icons-list">

							<li>

								<a href="<?php echo base_url(); ?>index.php/admin/user/logout"><i class="fa fa-sign-out"></i></a>

							</li>

						</ul>--> 
            
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
          <li> <a href="<?php echo base_url(); ?>index.php/admin/user/logout"><i class="fa fa-sign-out"> </i><span>Logout</span></a> </li>
          <li <?php if(($this->uri->segment(3)=='index')) { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/user/index"><i class="fa fa-desktop"></i> <span>Dashboard</span></a> </li>
          <?php } ?>
          <?php if($this->session->userdata('username1')) { ?>
          <li> <a href="<?php echo base_url(); ?>index.php/admin/user/front_logout"><i class="fa fa-sign-out"> </i><span>Signout</span></a> </li>
          <?php } ?>         
          
          <li <?php if($this->uri->segment(3)=='change_password') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/user/change_password"><i class="fa fa-desktop"></i> <span>Change Password</span></a> </li>
          
          <!-- /Main --> 
          
          <!-- Content -->
          
          <li class="navigation-header"><span>Content</span> <i class="fa fa-bars" title="Content"></i></li>
          
          <!-- ADMIN -->
          <?php if($this->session->userdata('username')) { ?>
          <li <?php if($this->uri->segment(2)=='site_setting') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/site_setting"><i class="fa fa-th"></i> <span>Site Setting</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_slider') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_slider"><i class="fa fa-th"></i> <span>Manage Banner</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_discipline') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_discipline"><i class="fa fa-th"></i> <span>Manage Department</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_facilities') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_facilities"><i class="fa fa-th"></i> <span>Manage Facilities</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_notice') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_notice"><i class="fa fa-th"></i> <span>File Upload</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_college') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_college"><i class="fa fa-th"></i> <span>Manage College</span></a> </li> 
          <li <?php if($this->uri->segment(2)=='manage_student') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_student"><i class="fa fa-th"></i> <span>Manage Student</span></a> </li> 
          <li <?php if($this->uri->segment(2)=='manage_review') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_review"><i class="fa fa-th"></i> <span>Manage Review</span></a> </li>  
          <li> <a href="index.htm#"><i class="fa fa-th"></i> <span>Manage Forum Topic</span></a>
            <ul>
              <li <?php if($this->uri->segment(3)=='main_page') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_menu/main_page">Main Topic</a></li>
              <li <?php if($this->uri->segment(3)=='sub_page') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_menu/sub_page">Sub Topic</a></li>
            </ul>
          </li>          
          <li <?php if(($this->uri->segment(2)=='post')&&($this->uri->segment(3)=='')) { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/profile/post"><i class="fa fa-th"></i> <span>Post Management</span></a> </li>
          <li <?php if($this->uri->segment(3)=='sticky') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/forum_post_sticky/sticky"><i class="fa fa-th"></i> <span>Forum Post Sticky</span></a> </li>
          <!--<li <?php if($this->uri->segment(2)=='manage_forum') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_forum"><i class="fa fa-th"></i> <span>Forum Post Management</span></a> </li>-->              
          <?php } ?>
          <!-- ADMIN -->
          
          <!-- USER -->
          <?php if($this->session->userdata('username1')) { 
		  if($this->session->userdata('user_type1')=='C') { 
		  ?>
              	<li <?php if(($this->uri->segment(2)=='profile')&&($this->uri->segment(3)=='')) { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/profile"><i class="fa fa-th"></i> <span>Edit/View Profile</span></a> </li>
              	<li <?php if($this->uri->segment(3)=='social') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/profile/social"><i class="fa fa-th"></i> <span>Social link</span></a> </li>
             	 <li <?php if($this->uri->segment(2)=='manage_placement') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_placement"><i class="fa fa-th"></i> <span>Manage Placement</span></a> </li>
              	<li <?php if($this->uri->segment(2)=='manage_department') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_department"><i class="fa fa-th"></i> <span>Manage Department</span></a> </li>
              	<li <?php if($this->uri->segment(2)=='manage_college_facilities') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_college_facilities"><i class="fa fa-th"></i> <span>Manage Facilities</span></a> </li>
              	<li <?php if($this->uri->segment(2)=='manage_gallery') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_gallery"><i class="fa fa-th"></i> <span>Manage Gallery</span></a> </li>
              	<li <?php if($this->uri->segment(2)=='manage_awards') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_awards"><i class="fa fa-th"></i> <span>Manage Awards</span></a> </li>
                <li <?php if($this->uri->segment(2)=='manage_recruiter') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_recruiter"><i class="fa fa-th"></i> <span>Manage Recruiter</span></a> </li>
                <li <?php if($this->uri->segment(2)=='manage_message') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_message"><i class="fa fa-th"></i> <span>Manage Message</span></a> </li>
                
                
          <?php } else if($this->session->userdata('user_type1')=='S') { ?>
          		<li <?php if(($this->uri->segment(2)=='profile')&&($this->uri->segment(3)=='')) { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/profile"><i class="fa fa-th"></i> <span>Edit/View Profile</span></a> </li>
          		<li <?php if($this->uri->segment(2)=='manage_notice') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_notice"><i class="fa fa-th"></i> <span>File Upload</span></a> </li>
                <li <?php if($this->uri->segment(2)=='manage_student_message') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_student_message"><i class="fa fa-th"></i> <span>Manage Message</span></a> </li>
                
          <?php }  else if($this->session->userdata('user_type1')=='P') { ?>
          
          		<li <?php if(($this->uri->segment(2)=='profile')&&($this->uri->segment(3)=='')) { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/profile"><i class="fa fa-th"></i> <span>Edit/View Profile</span></a> </li>
                <li <?php if(($this->uri->segment(2)=='post')&&($this->uri->segment(3)=='')) { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/profile/post"><i class="fa fa-th"></i> <span>Post Management</span></a> </li>
                
          <?php } ?> 
          <?php } ?>
          <!-- USER -->
          
          <!--       
          
          <li <?php if($this->uri->segment(2)=='manage_sub_committee') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_sub_committee"><i class="fa fa-th"></i> <span>Manage Sub Committee</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_subject') { ?>class="active"<?php } ?>><a href="<?php echo base_url(); ?>index.php/admin/manage_subject"><i class="fa fa-th"></i> <span>Manage Subject</span></a> </li>
          
          <li <?php if($this->uri->segment(2)=='manage_tab') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_tab"><i class="fa fa-th"></i> <span>Non-Teaching Staff Category</span></a> </li>
          
          <li <?php if($this->uri->segment(2)=='manage_page_content') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_page_content"><i class="fa fa-th"></i> <span>Manage Page Content</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_link') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_link"><i class="fa fa-th"></i> <span>Manage Userfull Links</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_principal') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_principal"><i class="fa fa-th"></i> <span>Manage Principal Image</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_magazine_prospectus') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_magazine_prospectus"><i class="fa fa-th"></i> <span>Calendar Magazine Prospectus</span></a> </li>
          <li <?php if($this->uri->segment(2)=='manage_books') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_books"><i class="fa fa-th"></i> <span>Manage Books</span></a> </li>
          <li <?php if($this->uri->segment(2)=='ssr') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/ssr"><i class="fa fa-th"></i> <span>Manage SSR</span></a> </li>
          <li <?php if($this->uri->segment(2)=='iqac') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_iqac"><i class="fa fa-th"></i> <span>Manage IQAC</span></a> </li>
          <li <?php if($this->uri->segment(2)=='aqar') { ?>class="active"<?php } ?>> <a href="<?php echo base_url(); ?>index.php/admin/manage_aqar"><i class="fa fa-th"></i> <span>Manage AQAR</span></a> </li>-->
        </ul>
      </div>
    </div>
    
    <!-- /main navigation --> 
    
  </div>
</div>
