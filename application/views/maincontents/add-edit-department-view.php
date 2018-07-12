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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Department</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_jobtype">Manage Department</a></li>
            <li class="active"><?php echo $action; ?> Department</li>
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
					$department_name = $row->department_name;
					$department_prefix = $row->department_prefix;
				} else {
					$department_name = '';
					$department_prefix = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Department Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Department Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="department_name" value="<?php if($action == 'Edit'){echo $department_name;} else {echo set_value('department_name');} ?>" class="form-control" required="required" placeholder="Enter Department Name">
                  <?php echo form_error('department_name'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Department Prefix <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="department_prefix" value="<?php if($action == 'Edit'){echo $department_prefix;} else {echo set_value('department_prefix');} ?>" class="form-control" required="required" placeholder="Enter Department Prefix">
                  <?php echo form_error('department_prefix'); ?>
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