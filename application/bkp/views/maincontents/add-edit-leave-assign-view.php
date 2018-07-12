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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Leave Assign</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_leave_assign">Manage Leave Assign</a></li>
            <li class="active"><?php echo $action; ?> Leave Assign</li>
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
					$leave_date = $row->leave_date;
					$leave_type = $row->leave_type;
				} else {
					$emp_id = '';
					$leave_date = '';
					$leave_type = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Leave Assign Inputs</legend>
              <?php if($action=='Edit') { ?><input type="text" name="id" id="assign_id" value="<?php echo $id; ?>" /><?php } ?>
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                  <select name="emp_id" data-placeholder="Select a Employee" class="select" id="emp_id">
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
                <label class="control-label col-lg-3">Leave date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select Leave date" name="leave_date" value="<?php if($action == 'Edit'){echo $leave_date;} else {echo set_value('leave_date');} ?>">
                  	<?php echo form_error('leave_date'); ?>
                    </div>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Leave type <span class="text-danger">*</span></label>
                <div class="col-lg-9">                
                    <!--<select name="leave_type1" class="select" id="city_dropdown">
                    	<option value="" selected="selected" hidden>Select a Leave type</option>
                        <option value="M">Male</option>
                    </select>-->
                    <div id="city_id"></div>
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
<?php if($action=='Add') { ?>
<script>
	$(document).ready(function(){
		assign_id = $('#assign_id').val();					
			$.ajax({
				type: "POST",
				url: "ajax_call_default",
				async: false,
				data: {action:'<?php echo $action; ?>',id:assign_id},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			});
    $("#emp_id").on('change', function(){
			/*$("#city_dropdown").show();*/
			
			stateID = $(this).val();
			if(stateID != "")
			{
			$("#city_dropdown").hide();	
			}
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {emp_id:stateID, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
						$("#city_dropdown").remove();
                        $('#city_id').html(data);
				}
			})
    });
});
</script>
<?php } else if($action=='Edit') { ?>
<script>
	$(document).ready(function(){
		assign_id = $('#assign_id').val();					
			$.ajax({
				type: "POST",
				url: "ajax_call_default",
				async: false,
				data: {action:'<?php echo $action; ?>',id:assign_id},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			});
    $("#emp_id").on('change', function(){
			/*$("#city_dropdown").show();*/
			
			stateID = $(this).val();
			if(stateID != "")
			{
			$("#city_dropdown").hide();	
			}
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {emp_id:stateID, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
						$("#city_dropdown").remove();
                        $('#city_id').html(data);
				}
			})
    });
});
</script>
<?php } ?>