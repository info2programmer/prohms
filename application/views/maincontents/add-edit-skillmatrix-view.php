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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Skill Matrix</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_jobtype">Manage Skill Matrix</a></li>
            <li class="active"><?php echo $action; ?> Skill Matrix</li>
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
					$emp_id = $row->emp_id;
					$sm_details = $row->sm_details;
				} else {
					$emp_id = '';
					$sm_details = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Skill Matrix Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                              <select name="emp_id" data-placeholder="Select a Employee" class="select" required="required">
                                    <option value="" selected="selected" hidden>Select a Employee</option>
                                    <?php if($emps) { foreach($emps as $emp) { ?>
                                    <option value="<?php echo $emp->emp_id; ?>"<?php if($emp->emp_id==$emp_id){echo 'selected';}?>><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
                                    <?php } } else { ?>
                                    <option value="No employee" selected="selected">No employee</option>
                                    <?php } ?>
                              </select>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Skill Matrix Details <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <textarea name="sm_details" class="form-control" required="required" placeholder="Skill Matrix Details"><?php if($action == 'Edit'){echo $sm_details;} else {echo set_value('sm_details');} ?></textarea>
                  <?php echo form_error('sm_details'); ?>
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