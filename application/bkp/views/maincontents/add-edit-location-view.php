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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Location</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_jobtype">Manage Location</a></li>
            <li class="active"><?php echo $action; ?> Location</li>
          </ul>
        </div>
      </div>
      <!-- /page header --> 
      
      <!-- Content area -->
      <div class="content"> 
        
        <!-- Form validation -->
        <div class="panel panel-flat">
          <div class="panel-heading">
            <!--<h5 class="panel-title">Form validation</h5>-->
            <div class="heading-elements">
              <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
              </ul>
            </div>
          </div>
          <div class="panel-body">
            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'myform');echo form_open_multipart('',$attributes); ?>
            <?php
				if(isset($row)){  
					$loc_name = $row->loc_name;
					$loc_address = $row->loc_address;
					$loc_phone = $row->loc_phone;
					$loc_email = $row->loc_email;
				} else {
					$loc_name = '';
					$loc_address = '';
					$loc_phone = '';
					$loc_email = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Location Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Location Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="loc_name" value="<?php if($action == 'Edit'){echo $loc_name;} else {echo set_value('loc_name');} ?>" class="form-control" required="required" placeholder="Enter Location Name">
                  <?php echo form_error('loc_name'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Address <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="loc_address" value="<?php if($action == 'Edit'){echo $loc_address;} else {echo set_value('loc_address');} ?>" class="form-control" required="required" placeholder="Enter Address">
                  <?php echo form_error('loc_address'); ?>
                </div>
              </div>
              <!-- /basic text input -->
               <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Phone <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="loc_phone" value="<?php if($action == 'Edit'){echo $loc_phone;} else {echo set_value('loc_phone');} ?>" class="form-control" required="required" placeholder="Enter Phone">
                  <?php echo form_error('loc_phone'); ?>
                </div>
              </div>
              <!-- /basic text input -->
               <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Email <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="loc_email" value="<?php if($action == 'Edit'){echo $loc_email;} else {echo set_value('loc_email');} ?>" class="form-control" required="required" placeholder="Enter Email">
                  <?php echo form_error('loc_email'); ?>
                </div>
              </div>
              <!-- /basic text input -->
             </fieldset> 
              <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
        <!-- /form validation --> 
        
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