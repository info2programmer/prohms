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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Leave</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_leave">Manage Leave</a></li>
            <li class="active"><?php echo $action; ?> Leave</li>
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
					$leave_name = $row->leave_name;
					$leave_type = $row->leave_type;
				} else {
					$leave_name = '';
					$leave_type = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Leave Inputs</legend>
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Leave Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="leave_name" value="<?php if($action == 'Edit'){echo $leave_name;} else {echo set_value('leave_name');} ?>" class="form-control" required="required" placeholder="Enter Leave Name">
                  <?php echo form_error('leave_name'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Leave Type <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<select name="leave_type" data-placeholder="Select a Leave Type" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Type</option>
                        <option value="Paid" <?php if($leave_type=='Paid') { ?>selected="selected"<?php } ?>>Paid</option>
                        <option value="Unpaid" <?php if($leave_type=='Unpaid') { ?>selected="selected"<?php } ?>>Unpaid</option>
                    </select>
                  	<?php echo form_error('leave_type'); ?>
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