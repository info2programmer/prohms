<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Company Setting</h4>
    </div>
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active"><?php echo $action; ?> Company Setting</li>
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
          <h4 class="panel-title"> Manage Company Setting </h4>
        </div>
        <div class="panel-body no-padding-bottom"> 
          
          <!--<form class="form-horizontal" action="form_basic.htm#">	-->
          
          <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');

								echo form_open_multipart('',$attributes); ?>
          <?php

									if($row)
									{  
										$com_name = $row->com_name;
										$com_address = $row->com_address;
										$com_phone = $row->com_phone;
										$com_email = $row->com_email;
										$com_logo = $row->com_logo;
									 }
									 else
									 {
										$com_name = '';
										$com_address = '';
										$com_phone = '';
										$com_email = '';
										$com_logo = '';
									 }

							?>
          <input type="hidden" name="mode" value="company_setting" />
          <div class="form-group">
            <label class="control-label col-lg-2">Company Name</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Company Name" name="com_name" value="<?php if($action == 'Edit'){echo $com_name;} else {echo set_value('com_name');} ?>">
              <?php echo form_error('com_name'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Company Address</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Company Address" name="com_address" value="<?php if($action == 'Edit'){echo $com_address;} else {echo set_value('com_address');} ?>">
              <?php echo form_error('com_address'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Company Phone</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Company Phone" name="com_phone" value="<?php if($action == 'Edit'){echo $com_phone;} else {echo set_value('com_phone');} ?>">
              <?php echo form_error('com_phone'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Company Email</label>
            <div class="col-lg-10">
              <input type="text" class="form-control" placeholder="Enter Email" name="com_email" value="<?php if($action == 'Edit'){echo $com_email;} else {echo set_value('com_email');} ?>">
              <?php echo form_error('com_email'); ?> </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-2">Company Logo</label>
            <div class="col-lg-10">
              <?php if($action == 'Edit') {
									if($row->com_logo) {
			  ?>
              <img src="<?php echo base_url();?>uploads/<?php echo $row->com_logo; ?>" height="100" width="400"/>
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
