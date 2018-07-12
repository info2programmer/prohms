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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Attendance</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_attendance">Manage Attendance</a></li>
            <li class="active"><?php echo $action; ?> Attendance</li>
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
					$attendance_date = $row->attendance_date;
					$branch_id = $row->branch_id;
				} else {
					$attendance_date = '';
					$branch_id = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <!--<legend class="text-bold">Attendance Date : <?php echo date('d-M-Y'); ?></legend>-->
              
              
              <div class="form-group">
                <label class="control-label col-lg-3">Enter Attendance Date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select Attendance Date" name="attendance_date">
                    </div>
                </div>
              </div>
              
              
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Select Branch <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <?php 
					$js = 'class="select" id="emp_id"';
					echo form_dropdown('branch_id',$locs,$branch_id,$js);
					echo form_error('branch_id'); 
				  	?>
                </div>
              </div>
              
             <p id="city_id"></p>
             </fieldset>
              <div class="text-right">
                <!--<button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>-->
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
		
		stateID = $("#emp_id").val();
		url = '<?php echo base_url();?>manage_attendance/ajax_call';
		<?php if($action=='Edit') { ?>
		$.ajax({
				type: "POST",
				url: url,
				async: false,
				data: {emp_id:stateID, id:'<?php echo $id; ?>',action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			});
		<?php } ?>	
		
    $("#emp_id").on('change', function(){			
			stateID = $(this).val();
						
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {emp_id:stateID, action:'<?php echo $action; ?>'},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
    });
});
</script>