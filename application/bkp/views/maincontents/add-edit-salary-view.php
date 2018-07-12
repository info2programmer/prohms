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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Salary</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_salary">Manage Salary</a></li>
            <li class="active"><?php echo $action; ?> Salary</li>
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
              <legend class="text-bold">Salary Inputs</legend>
              <?php if($action=='Edit') { ?><input type="text" name="id" id="assign_id" value="<?php echo $id; ?>" /><?php } ?>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">From date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select From date" name="from_date" id="from_date" value="<?php if($action == 'Edit'){echo $from_date;} else {echo set_value('from_date');} ?>" required="required">
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
					<input type="text" class="form-control pickadate" placeholder="Select To date" name="to_date" id="to_date" value="<?php if($action == 'Edit'){echo $to_date;} else {echo set_value('to_date');} ?>" required="required">
                  	<?php echo form_error('to_date'); ?>
                  	</div>
                </div>
              </div>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                  <select name="emp_id" data-placeholder="Select an Employee" class="select" required="required" id="emp_id">
                    	<option value="" selected="selected" hidden>Select an Employee</option>
                        <?php if($emps) { foreach($emps as $emp) { ?>
                        <option value="<?php echo $emp->emp_id; ?>" <?php if($action=='Edit') { if($emp->emp_id==$emp_id) { ?>selected="selected"<?php } } ?>><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
                        <?php } } else { ?>
                        <option value="No employee" selected="selected">No employee</option>
                        <?php } ?>
                  </select>
                  <?php echo form_error('emp_id'); ?>
                </div>
              </div>
               
              
              
              <p id="city_id"></p>
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
<script>
	$(document).ready(function(){
    $("#emp_id").on('change', function(){
			
			stateID = $(this).val();
			from_date = $('#from_date').val();
			to_date = $('#to_date').val();
			
			if(stateID != "")
			{
			$("#city_dropdown").hide();	
			}
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {emp_id:stateID, from_date:from_date, to_date:to_date, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
    });
});
</script>