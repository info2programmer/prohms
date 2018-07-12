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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Generate Salary</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_halfday_assign">Manage Generate Salary</a></li>
            <li class="active"><?php echo $action; ?> Generate Salary</li>
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
            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'salary-form');echo form_open_multipart('',$attributes); ?>
            
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Generate Salary Inputs</legend>              
              
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">From date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate-accessibility" placeholder="Select From date" name="from_date" value="" id="from_date">
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
					<input type="text" class="form-control pickadate-accessibility" placeholder="Select To date" name="to_date" value="" id="to_date">
                  	<?php echo form_error('to_date'); ?>
                    </div>
                </div>
              </div>
              <!-- /basic text input -->
              
              
             </fieldset>
              <div class="text-right">
                <button type="submit" class="btn btn-primary" id="btn_add">Generate <i class="icon-arrow-right14 position-right"></i></button>
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

/////////////////////////Add Data//////////////////////////
$("#btn_add").click(function (e) {
    e.preventDefault();
    /*var data=$('#employee-personal-form').serialize();*/
    $("#btn_add").prop('disabled', true);
    var formdata = new FormData($("#salary-form")[0]);
    /*for (var [key, value] of formdata.entries()) {
     console.log(key, value);
     }*/
    //console.log(formdata);

    $.ajax({
        type: "POST",
        contentType: false,
        cache: false,
        processData: false,
        data: formdata,
        url: "<?php echo base_url(); ?>generate_salary/generate_salary",
        success: function (data) {
            window.location.href = "<?php echo base_url(); ?>generate_salary";
        },
        error: function (data) {
            window.location.href = "<?php echo base_url(); ?>generate_salary";
        }
    });

});
/////////////////////////Add//////////////////////////
</script>