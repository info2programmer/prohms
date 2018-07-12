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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Team Member Performance</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_performance">Manage Team Member Performance</a></li>
            <li class="active"><?php echo $action; ?> Team Member Performance</li>
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
					$loc_id = $row->loc_id;
					$performance_date = $row->performance_date;
					$points = $row->points;
					$applications = $row->applications;
					$hours_login = $row->hours_login;
					$rph = $row->rph;
					$aph = $row->aph;
					$rpa = $row->rpa;
					$quality_score = $row->quality_score;
				} else {
					$emp_id = '';
					$loc_id = '';
					$performance_date = '';
					$points = '';
					$applications = '';
					$hours_login = '';
					$quality_score = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Team Member Performance Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Performance date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select Performance date" name="performance_date" id="performance_date" value="<?php if($action == 'Edit'){echo $performance_date;} else {echo set_value('performance_date');} ?>" required="required">
                  	<?php echo form_error('performance_date'); ?>
                    </div>
                </div>
              </div>
              <!-- /basic text input -->
              
              <!-- Basic text input -->
              <!--<div class="form-group">
                <label class="control-label col-lg-3">Location <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $locs = $this->db->query("select * from td_company_location where published=1")->result(); ?>
                  <select name="loc_id" id="loc_id" data-placeholder="Select a Location" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Location</option>
                        <?php if($locs) { foreach($locs as $loc) { ?>
                        <option value="<?php echo $loc->loc_id; ?>" <?php if($loc->loc_id==$loc_id) { ?>selected="selected"<?php } ?>><?php echo $loc->loc_name; ?></option>
                        <?php } } else { ?>
                        <option value="No employee" selected="selected">No location</option>
                        <?php } ?>
                  </select>
                  <?php echo form_error('loc_id'); ?>
                </div>
              </div>-->
              <!-- /basic text input -->
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                  <select name="emp_id" id="emp_id" data-placeholder="Select a Employee" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Employee</option>
                        <?php if($emps) { foreach($emps as $emp) { ?>
                        <option value="<?php echo $emp->emp_id; ?>" <?php if($emp->emp_id==$emp_id) { ?>selected="selected"<?php } ?>><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
                        <?php } } else { ?>
                        <option value="No employee" selected="selected">No employee</option>
                        <?php } ?>
                  </select>
                  <?php echo form_error('emp_id'); ?>
                </div>
              </div>
              <p id="city_id"></p>
              <!-- /basic text input -->
              
               
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Points <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="points" value="<?php if($action == 'Edit'){echo $points;} else {echo set_value('points');} ?>" class="form-control" required="required" placeholder="Enter Points">
                  <?php echo form_error('points'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Applications <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="applications" value="<?php if($action == 'Edit'){echo $applications;} else {echo set_value('applications');} ?>" class="form-control" required="required" placeholder="Enter Applications">
                  <?php echo form_error('applications'); ?>
                </div>
              </div>
              <!-- /basic text input --> 
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Login Hours<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="hours_login" id="hours_login" value="<?php if($action == 'Edit'){echo $hours_login;} else {echo set_value('hours_login');} ?>" class="form-control" required="required" placeholder="Enter Login Hours">
                  <?php echo form_error('hours_login'); ?>
                </div>
              </div>
              <!-- /basic text input -->            
             <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Quality Score <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="quality_score" value="<?php if($action == 'Edit'){echo $quality_score;} else {echo set_value('quality_score');} ?>" class="form-control" required="required" placeholder="Enter Quality Score">
                  <?php echo form_error('quality_score'); ?>
                </div>
              </div>
              <!-- /basic text input -->	
              
              
             </fieldset>
              <div class="text-right">
                
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

<script>
	$(document).ready(function(){
	
	
	
	/*$("#loc_id").on('change', function(){
		
			url ='<?php echo base_url(); ?>manage_performance/ajax_call_location';
			
			stateID = $(this).val();			
			
			$.ajax({
				type: "POST",
				url: url,
				async: false,
				data: {loc_id:stateID, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
    });*/
	
	
	
    $("#emp_id").on('change', function(){
		
			url ='<?php echo base_url(); ?>manage_performance/ajax_call';
			
			stateID = $(this).val();
			performance_date = $('#performance_date').val();
			
			
			if(stateID != "")
			{
			$("#city_dropdown").hide();	
			}
			$.ajax({
				type: "POST",
				url: url,
				async: false,
				data: {emp_id:stateID, performance_date:performance_date, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#hours_login').val(data);
				}
			})
    });
});
</script>