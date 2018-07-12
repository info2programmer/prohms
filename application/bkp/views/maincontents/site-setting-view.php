<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Site Setting</h4>
    </div>
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active"><?php echo $action; ?> Site Setting</li>
    </ul>
  </div>
</div>
<!-- /page header --> 

<!-- Content area -->

<div class="content">
  <div class="row">
    <div class="col-md-12">
      <?php if($this->session->flashdata('error_message')) { ?>
      <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
      <?php } ?>
      <?php if($this->session->flashdata('success_message')) { ?>
      <h5 style="color:green;"><?php echo $this->session->flashdata('success_message'); ?></h5>
      <?php } ?>
      <div class="panel panel-flat">
        <div class="panel-heading">
          <h4 class="panel-title"> Manage Site Setting </h4>
        </div>
        <div class="panel-body no-padding-bottom"> 
          
          <!--<form class="form-horizontal" action="form_basic.htm#">	-->
          
          <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');

								echo form_open_multipart('',$attributes); ?>
          <?php

									if($row)
									{  
										$site_name = $row->site_name;
										$site_email_address = $row->site_email_address;
										$site_phone = $row->site_phone;
										$site_meta = $row->site_meta;
										$site_desc = $row->site_desc;
										$site_fblink = $row->site_fblink;
										$site_twtlink = $row->site_twtlink;
									 }
									 else
									 {
										$site_name = '';
										$site_email_address = '';
										$site_phone = '';
										$site_meta = '';
										$site_desc = '';
										$site_fblink = '';
										$site_twtlink = '';
									 }

							?>
          <input type="hidden" name="mode" value="site_setting" />
          <div class="form-group">
            <label class="control-label col-lg-2">Site Title</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Site Title" name="site_name" value="<?php if($action == 'Edit'){echo $site_name;} else {echo set_value('site_name');} ?>">
              <?php echo form_error('site_name'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Email Address</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Site Email Address" name="site_email_address" value="<?php if($action == 'Edit'){echo $site_email_address;} else {echo set_value('site_email_address');} ?>">
              <?php echo form_error('site_email_address'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Phone</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Site Phone" name="site_phone" value="<?php if($action == 'Edit'){echo $site_phone;} else {echo set_value('site_phone');} ?>">
              <?php echo form_error('site_phone'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Meta Name</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Meta Name" name="site_meta" value="<?php if($action == 'Edit'){echo $site_meta;} else {echo set_value('site_meta');} ?>">
              <?php echo form_error('site_meta'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Address</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Address" name="site_desc" value="<?php if($action == 'Edit'){echo $site_desc;} else {echo set_value('site_desc');} ?>">
              <?php echo form_error('site_desc'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Facebook Link</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Facebook Link" name="site_fblink" value="<?php if($action == 'Edit'){echo $site_fblink;} else {echo set_value('site_fblink');} ?>">
              <?php echo form_error('site_fblink'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Twitter Link</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Twitter Link" name="site_twtlink" value="<?php if($action == 'Edit'){echo $site_twtlink;} else {echo set_value('site_twtlink');} ?>">
              <?php echo form_error('site_twtlink'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Site Logo</label>
            <div class="col-lg-10">
              <?php if($action == 'Edit') {
									if($row->site_logo) {
			  ?>
              <img src="<?php echo base_url();?>uploads/<?php echo $row->site_logo; ?>" height="100" width="400"/>
              <?php } else { ?>
              <img src="<?php echo base_url(); ?>material/admin/no-user-image.jpg" width="100" height="100" /><br />
              <br />
              <?php } ?>
              <?php } ?>
              <input type="file" name="slider_image" class="file-styled">
              <?php if($this->session->flashdata('err_message')) { echo $this->session->flashdata('err_message'); } ?>
            </div>
          </div>
         
          
          
          
          
          <div class="form-group">
            <label class="control-label col-lg-2"></label>
            <div class="col-lg-10">
              <button type="submit" class="btn btn-primary"><?php echo $action; ?> Site Setting</button>
            </div>
          </div>
          <?php echo form_close(); ?> </div>
      </div>
    </div>
    <!-- Footer -->
    <div class="footer text-muted"> 
      <?php echo $footer; ?>
    </div>
    <!-- /footer -->
  </div>
</div>
