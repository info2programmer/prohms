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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Salary Confirm</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_salary">Manage Salary Confirm</a></li>
            <li class="active"><?php echo $action; ?> Salary Confirm</li>
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
					$emp_type = $row->emp_type;
					$from_date = $row->from_date;
					$to_date = $row->to_date;
				} else {
					$emp_id = '';
					$emp_type = '';
					$from_date = '';
					$to_date = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Salary Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">From date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<div class="input-group">
                  	<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate" placeholder="Select From date" name="from_date" id="from_date" value="<?php if($action == 'Add'){echo $from_date;} else {echo set_value('from_date');} ?>" required="required" disabled="disabled">
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
					<input type="text" class="form-control pickadate" placeholder="Select To date" name="to_date" id="to_date" value="<?php if($action == 'Add'){echo $to_date;} else {echo set_value('to_date');} ?>" required="required" disabled="disabled">
                  	</div>
                </div>
              </div>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1")->result(); ?>
                  <select name="emp_id" data-placeholder="Select an Employee" class="select" required="required" id="emp_id" disabled="disabled">
                    	<option value="" selected="selected" hidden>Select an Employee</option>
                        <?php if($emps) { foreach($emps as $emp) { ?>
                        <option value="<?php echo $emp->emp_id; ?>" <?php if($action=='Add') { if($emp->emp_id==$emp_id) { ?>selected="selected"<?php } } ?>><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
                        <?php } } else { ?>
                        <option value="No employee" selected="selected">No employee</option>
                        <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="form-group">
                	<label class="control-label col-lg-6">Earning <hr /></label>
                	<label class="control-label col-lg-6">Deduction <hr /></label>
              </div> 
              <hr />
              <?php if($emp_type=='S') { ?>
              <div class="col-lg-6">
				<?php				
				$salary_details = $this->db->query("select * from td_salary_details where salary_id='$id' and salary_head_type='E'")->result();
				if($salary_details) { foreach($salary_details as $salary_detail) {
					$salary_head_id = $salary_detail->salary_head_id;
					$sal_head = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id'")->row();
					if($salary_detail->salary_head_value!='0.00') {
				?>	 
					<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong><?php echo $salary_detail->salary_head_value;?></label><br />
                	<?php } else { ?>
                	<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong></label>
                    <input type="number" name="salary_head_value[]" placeholder="Enter <?php echo $sal_head->salary_head_name;?>" value="" /><br />
                    <input type="hidden" name="salary_head_id[]" value="<?php echo $salary_head_id; ?>" />
                <?php } ?>
				<?php } } ?>
			  </div>
				
			  <div class="col-lg-6">
				<?php 
				$late_count = $this->db->query("select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `late_id` LIKE  '%$emp_id%'")->num_rows();
				$absent_count = $this->db->query("select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `present_id`  NOT LIKE  '%$emp_id%'")->num_rows();
				//echo "select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `present_id`  NOT LIKE  '%$emp_id%'";
				
				
				$settings = $this->db->query("select * from td_company_settings")->row();
				$sals = $this->db->query("select * from td_salary where salary_id='$id'")->row();
				$per_day_sal = round($sals->basic_pay/30, 2);
				$absent_due_late = (int)($late_count/$settings->absent_due_to_late);
				
				
				$deduction_for_absent = $per_day_sal*$absent_count;
				$deduction_for_late = $per_day_sal*$absent_due_late;
				?>
                <label class="control-label"><strong>Deduction for absent : </strong><?php echo "(".$per_day_sal."*".$absent_count.") = ".($per_day_sal*$absent_count); ?></label><br />
                <label class="control-label"><strong>Deduction for late : </strong><?php echo "(".$per_day_sal."*".$absent_due_late.") = ".($per_day_sal*$absent_due_late); ?></label><br /> 
				<?php
                $salary_details = $this->db->query("select * from td_salary_details where salary_id='$id' and salary_head_type='D'")->result();
				if($salary_details) { foreach($salary_details as $salary_detail) {
					$salary_head_id = $salary_detail->salary_head_id;
					$sal_head = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id'")->row();
					if($salary_detail->salary_head_value!='0.00') {
				?>	 
					<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong><?php echo $salary_detail->salary_head_value;?></label><br />
                	<?php } else { ?>
                    <?php
					if($salary_head_id==10) {
						$salary_head_value = $deduction_for_absent;
					} else if($salary_head_id==11) {
						$salary_head_value = $deduction_for_late;
					}
					?>
                	<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong></label>
                    <input type="number" name="salary_head_value[]" placeholder="Enter <?php echo $sal_head->salary_head_name;?>" value="<?php echo $salary_head_value; ?>" /><br />
                    <input type="hidden" name="salary_head_id[]" value="<?php echo $salary_head_id; ?>" />
                <?php } ?>
				<?php } } ?>
			  </div>
              
              		<?php
              		/*$lv_allot = $this->db->query("select * from td_leave_allocation where emp_id='$emp_id'")->row();
					$leave_allocation_id = $lv_allot->leave_allocation_id;
					$lv_allot_details = $this->db->query("select * from td_leave_allocation_details where leave_allocation_id='$leave_allocation_id'")->result();				*/
					?>						
				<!--<div class="form-group">
					<label class="control-label col-lg-12">
					<?php
					if($lv_allot_details) { $i=1; foreach($lv_allot_details as $lv_allot_detail) {
					$leave_id = $lv_allot_detail->leave_id;
					$leave_allocation_details_id = $lv_allot_detail->leave_allocation_details_id;					
					$leave_detail = $this->db->query("select * from td_leave where leave_id='$leave_id'")->row();
					$leave_assign = $this->db->query("select * from td_leave_assign where emp_id='$emp_id' and leave_date>='$from_date' and leave_date<='$to_date' and leave_type='$leave_allocation_details_id'")->num_rows();
				?>	
					<input type="hidden" name="emp_id[]" value="<?php echo $emp_id; ?>">
					<input type="hidden" name="leave_id[]" value="<?php echo $leave_id; ?>">
					<input type="hidden" name="leave_taken[]" value="<?php echo $leave_assign; ?>">
					<input type="hidden" name="leave_balance[]" value="<?php echo $lv_allot_detail->leave_balance; ?>">
					<strong><?php echo $leave_detail->leave_name; ?> taken : </strong><?php echo $leave_assign; ?>  
                	<strong><?php echo $leave_detail->leave_name; ?> balance : </strong><?php echo $lv_allot_detail->leave_balance."<br>";
					
					$i++; } } ?>
                    <input type="hidden" name="counter" value="<?php echo $i-2; ?>">
					</label>
				</div>-->
              
              <?php } else { ?>
              <div class="col-lg-6">
				<?php
				$salarys = $this->db->query("select * from td_salary where salary_id='$id'")->row(); ?>
                <!--<label class="control-label"><strong>Working hours payment : </strong>
				<?php echo "( ".$salarys->rate_per_hour." * ".$salarys->working_hours." ) = ".($salarys->rate_per_hour*$salarys->working_hours);?></label><br />-->
				<?php 
				$salary_details = $this->db->query("select * from td_salary_details where salary_id='$id' and salary_head_type='E'")->result();
				if($salary_details) { foreach($salary_details as $salary_detail) {
					$salary_head_id = $salary_detail->salary_head_id;
					$sal_head = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id'")->row();
					if($salary_detail->salary_head_value!='0.00') {
				?>	 
					<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong><?php echo $salary_detail->salary_head_value;?></label><br />
                	<?php } else { ?>
                	<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong></label>
                    <input type="number" name="salary_head_value[]" placeholder="Enter <?php echo $sal_head->salary_head_name;?>" value="<?php echo ($salary_head_id==9)?($salarys->rate_per_hour*$salarys->working_hours):''; ?>" />
                    <input type="hidden" name="salary_head_id[]" value="<?php echo $salary_head_id; ?>" /><br />
                <?php } ?>
				<?php } } ?>
			  </div>
              
              <div class="col-lg-6">
				<?php 
				$salary_details = $this->db->query("select * from td_salary_details where salary_id='$id' and salary_head_type='D'")->result();
				if($salary_details) { foreach($salary_details as $salary_detail) {
					$salary_head_id = $salary_detail->salary_head_id;
					$sal_head = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id'")->row();
					if($salary_detail->salary_head_value!='0.00') {
				?>	 
					<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong><?php echo $salary_detail->salary_head_value;?></label><br />
                	<?php } else { ?>
                	<label class="control-label"><strong><?php echo $sal_head->salary_head_name." : "; ?></strong></label>
                    <input type="number" name="salary_head_value[]" placeholder="Enter <?php echo $sal_head->salary_head_name;?>" value="" />
                    <input type="hidden" name="salary_head_id[]" value="<?php echo $salary_head_id; ?>" />
                <?php } ?>
				<?php } } ?>
			  </div>
              <?php } ?>
              
              <!--<p id="city_id"></p>-->
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