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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Training</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_employee_performance">Manage Training</a></li>
            <li class="active"><?php echo $action; ?> Training</li>
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
					$trn_skill= $row->trn_skill;
				} else {
					$emp_id = '';
					$from_date = '';
					$to_date = '';
					$trn_skill = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Training Inputs</legend>
               <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Training Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control" placeholder="Enter Training Name" name="trn_name" value="<?php if($action == 'Edit'){echo $trn_name;} else {echo set_value('trn_name');} ?>">
                  	<?php echo form_error('trn_name'); ?>
                    </div>
                </div>
              </div>
              <!-- /basic text input -->
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Skill Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $skills = $this->db->query("select * from td_skill where published=1")->result(); ?>
                  <select name="trn_skill" data-placeholder="Select a Skill" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Skill</option>
                        <?php if($skills) { foreach($skills as $skill) { ?>
                        <option value="<?php echo $skill->skill_id; ?>"><?php echo $skill->skill_name; ?></option>
                        <?php } } else { ?>
                        <option value="" selected="selected">No Skills</option>
                        <?php } ?>
                  </select>
                  <?php echo form_error('trn_skill'); ?>
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
                <label class="control-label col-lg-5">Employee </label>
                <label class="control-label col-lg-4">Other Notes </label>
                <label class="control-label col-lg-1"></label>
              </div>
              <!-- /basic text input -->
              <div class="form-group">
              	<div class="field_wrapper">
                	<div>
                        <div class="col-lg-5">
                            <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                              <select name="emp_id[]" data-placeholder="Select a Employee" class="select" required="required">
                                    <option value="" selected="selected" hidden>Select a Employee</option>
                                    <?php if($emps) { foreach($emps as $emp) { ?>
                                    <option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
                                    <?php } } else { ?>
                                    <option value="No employee" selected="selected">No employee</option>
                                    <?php } ?>
                              </select>
                        </div>
                        <div class="col-lg-4">
                            <input type="text" name="note[]" value="" class="form-control" placeholder="Enter Notes">
                        </div>
                        <div class="col-lg-1">
                            <a href="javascript:void(0);" class="add_button_trn" title="Add field"><img src="<?php echo base_url(); ?>material/assets/images/add-icon.png"/></a>
                            <input type="hidden" class="form-control" name="num" value="1">
                        </div>
                   </div> 
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