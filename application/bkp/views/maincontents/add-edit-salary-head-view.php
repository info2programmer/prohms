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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Salary Head</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_salary_head">Manage Salary Head</a></li>
            <li class="active"><?php echo $action; ?> Salary Head</li>
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
					$salary_head_name = $row->salary_head_name;
					$salary_head_description = $row->salary_head_description;
					$emp_type = $row->emp_type;
					$salary_head_type = $row->salary_head_type;
					$is_fixed_percent = $row->is_fixed_percent;
					$percent_rate = $row->percent_rate;
					$is_optional = $row->is_optional;
				} else {
					$salary_head_name = '';
					$salary_head_description = '';
					$emp_type = '';
					$salary_head_type = '';
					$is_fixed_percent = '';
					$percent_rate = '';
					$is_optional = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Salary Head Inputs</legend>     
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Salary head name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="salary_head_name" value="<?php if($action == 'Edit'){echo $salary_head_name;} else {echo set_value('salary_head_name');} ?>" class="form-control" required="required" placeholder="Enter Salary head name">
                  <?php echo form_error('salary_head_name'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Salary head description <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <textarea rows="5" cols="5" name="salary_head_description" class="form-control" required="required" placeholder="Enter Salary head description"><?php if($action == 'Edit'){echo $salary_head_description;} else {echo set_value('salary_head_description');} ?></textarea>
                  <?php echo form_error('salary_head_description'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee type <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="emp_type" data-placeholder="Select a Employee type" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Employee type</option>
                        <option value="S" <?php if($emp_type=='S') { ?>selected="selected"<?php } ?>>Skilled</option>
                        <option value="U" <?php if($emp_type=='U') { ?>selected="selected"<?php } ?>>Unskilled</option>
                    </select>
                  <?php echo form_error('emp_type'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Salary head type <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="salary_head_type" data-placeholder="Select a Salary head type" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Salary head type</option>
                        <option value="D" <?php if($salary_head_type=='D') { ?>selected="selected"<?php } ?>>Deduction</option>
                        <option value="E" <?php if($salary_head_type=='E') { ?>selected="selected"<?php } ?>>Earning</option>
                    </select>
                  <?php echo form_error('salary_head_type'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Styled inline radio group -->
			  <div class="form-group">
					<label class="control-label col-lg-3">Is fixed percent <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<label class="radio-inline">
								<input type="radio" name="is_fixed_percent" class="styled is_fixed_percent" value="1" <?php if($action=='Edit') { if($is_fixed_percent==1) { ?>checked="checked"<?php } } ?>>
									Yes
							</label>
							<label class="radio-inline">
								<input type="radio" name="is_fixed_percent" class="styled is_fixed_percent" value="0" <?php if($action=='Edit') { if($is_fixed_percent==0) { ?>checked="checked"<?php } } ?>>
									No
							</label>
						</div>
                        <?php echo form_error('is_fixed_percent'); ?>
			 </div>
			<!-- /styled inline radio group -->
          	<!-- Basic text input -->
              <div class="form-group" id="percent_rate">
                <label class="control-label col-lg-3">Percent rate <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="number" name="percent_rate" value="<?php if($action == 'Edit'){echo $percent_rate;} else {echo set_value('percent_rate');} ?>" class="form-control" placeholder="Enter Percent rate">
                  <?php echo form_error('percent_rate'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Styled inline radio group -->
			  <div class="form-group">
					<label class="control-label col-lg-3">Is optional <span class="text-danger">*</span></label>
						<div class="col-lg-9">
							<label class="radio-inline">
								<input type="radio" name="is_optional" class="styled" value="1" <?php if($action=='Edit') { if($is_optional==1) { ?>checked="checked"<?php } } ?>>
									Yes
							</label>
							<label class="radio-inline">
								<input type="radio" name="is_optional" class="styled" value="0" <?php if($action=='Edit') { if($is_optional==0) { ?>checked="checked"<?php } } ?>>
									No
							</label>
						</div>
                        <?php echo form_error('is_optional'); ?>
			 </div>
			<!-- /styled inline radio group -->
              
              
             </fieldset> 
              <div class="text-right">
                <button type="reset" class="btn btn-default" id="reset">Reset <i class="icon-reload-alt position-right"></i></button>
                <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
       
        
       
    <div class="footer text-muted"> 
      <?php echo $footer; ?>
    </div>
    
        
      </div>
      
      
    </div>
     
    
  </div>
  
  
</div>

<script>
$(document).ready(function() {
	$('#percent_rate').hide();
	<?php if($action=='Edit') { 
			if($is_fixed_percent==1) { ?>
				$('#percent_rate').show();
			<?php } else { ?>
				$('#percent_rate').hide();
			<?php } ?>	
	<?php } ?>
	$('.is_fixed_percent').click(function(){
		is_fixed_percent = $(this).val();
		if(is_fixed_percent==1)
		{ $('#percent_rate').show(); } 
		else
		{ $('#percent_rate').hide(); }	
	});
});
</script>

