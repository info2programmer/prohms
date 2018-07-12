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
            
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Team Member Performance Inputs</legend>              
                         
            <div class="form-group">
                <label class="control-label col-lg-2">Performance Sheet</label>
                <div class="col-lg-10">
                  <input type="file" name="slider_image" class="file-styled">
                </div>
          	</div>	
              
              
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