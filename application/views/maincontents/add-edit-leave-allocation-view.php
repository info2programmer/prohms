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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Leave Allocation</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_leave_allocation">Manage Leave Allocation</a></li>
            <li class="active"><?php echo $action; ?> Leave Allocation</li>
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
					$from_date = $row->from_date;
					$to_date = $row->to_date;
				} else {
					$emp_id = '';
					$from_date = '';
					$to_date = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Leave Allocation Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                  <select name="emp_id" data-placeholder="Select a Employee" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Employee</option>
                        <?php if($emps) { foreach($emps as $emp) { ?>
                        <option value="<?php echo $emp->emp_id; ?>" <?php if($action=='Edit') { if($emp->emp_id==$emp_id) { ?>selected="selected"<?php } } ?>><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
                        <?php } } else { ?>
                        <option value="No employee" selected="selected">No employee</option>
                        <?php } ?>
                  </select>
                  <?php echo form_error('emp_id'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">From date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select From date" name="from_date" value="<?php if($action == 'Edit'){echo $from_date;} else {echo set_value('from_date');} ?>">
                  	<?php echo form_error('from_date'); ?>
                    </div>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">To date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select To date" name="to_date" value="<?php if($action == 'Edit'){echo $to_date;} else {echo set_value('to_date');} ?>">
                  	<?php echo form_error('to_date'); ?>
                  	</div>
                </div>
              </div>
              <!-- /basic text input -->
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-6">Leave name </label>
                <label class="control-label col-lg-6">Alloted leave </label>
              </div>  
              <!-- /basic text input -->
              <div class="form-group">
              	<div class="field_wrapper">
                <?php $leaves = $this->db->query("select * from td_leave where published=1")->result(); 
						if($leaves) { foreach($leaves as $leave) {
							if(isset($row)){  
							$leave_allocation_id = $row->leave_allocation_id;
							$leave_id = $leave->leave_id;
							$leave_allocation_details = $this->db->query("select * from td_leave_allocation_details where leave_allocation_id='$leave_allocation_id' and leave_id='$leave_id'")->row();
							}
				?>
                	<div>
                        <div class="col-lg-6">
                        	<label class="control-label col-lg-6"><?php echo $leave->leave_name; ?> </label>
                            <input type="hidden" name="leave_id[]" value="<?php echo $leave->leave_id; ?>">
                        </div>
                        <div class="col-lg-6">
                            <input type="number" name="number_of_leave[]" value="<?php if($action == 'Edit'){echo $leave_allocation_details->number_of_leave;} ?>" class="form-control" placeholder="Enter Alloted leave">
                        </div>
                   </div>
                 <?php } } ?>  
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