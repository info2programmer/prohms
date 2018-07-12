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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Employee</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_employee">Manage Employee</a></li>
            <li class="active"><?php echo $action; ?> Employee</li>
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
					$emp_code = $row->emp_code;
					$department_id = $row->department_id;
					$salutation = $row->salutation;
					$emp_name = $row->emp_name;
					$gender = $row->gender;
					$father_name = $row->father_name;
					$email = $row->email;
					$dob = $row->dob;
					$present_address = $row->present_address;
					$permanent_address = $row->permanent_address;
					$phone = $row->phone;
					$country = $row->country;
					$state = $row->state;
					$city = $row->city;
					$pin = $row->pin;
					$personal_email = $row->personal_email;
					$mobile = $row->mobile;
					$blood_group = $row->blood_group;
					$votar_no = $row->votar_no;
					$pan_no = $row->pan_no;
					$passport_no = $row->passport_no;
					$passport_expiry = $row->passport_expiry;
					$aadhar_no = $row->aadhar_no;
					$marital_status = $row->marital_status;
					$spouse_name = $row->spouse_name;
					$profile_image = $row->profile_image;
				} else {
					$emp_code = '';
					$department_id = '';
					$salutation = '';
					$emp_name = '';
					$gender = '';
					$father_name = '';
					$email = '';
					$dob = '';
					$present_address = '';
					$permanent_address = '';
					$phone = '';
					$country = '';
					$state = '';
					$city = '';
					$pin = '';
					$personal_email = '';
					$mobile = '';
					$blood_group = '';
					$votar_no = '';
					$pan_no = '';
					$passport_no = '';
					$passport_expiry = '';
					$aadhar_no = '';
					$marital_status = '';
					$spouse_name = '';
					$profile_image = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Employee Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Department <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <?php 
					$js = 'class="select" id=department_id';					
					echo form_dropdown('department_id',$departments,$department_id,$js);
					echo form_error('department_id'); 
				  	?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Salutation <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="salutation" data-placeholder="Select a Salutation" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Salutation</option>
                        <option value="Mrs." <?php if($salutation=='Mrs.') { ?>selected="selected"<?php } ?>>Mrs.</option>
                        <option value="Ms." <?php if($salutation=='Ms.') { ?>selected="selected"<?php } ?>>Ms.</option>
                        <option value="Miss" <?php if($salutation=='Miss') { ?>selected="selected"<?php } ?>>Miss</option>
                    </select>
                  <?php echo form_error('salutation'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="emp_name" value="<?php if($action == 'Edit'){echo $emp_name;} else {echo set_value('emp_name');} ?>" class="form-control" required="required" placeholder="Enter Name">
                  <?php echo form_error('emp_name'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Gender <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="gender" data-placeholder="Select a Gender" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Gender</option>
                        <option value="M" <?php if($gender=='M') { ?>selected="selected"<?php } ?>>Male</option>
                        <option value="F" <?php if($gender=='F') { ?>selected="selected"<?php } ?>>Female</option>
                        <option value="T" <?php if($gender=='T') { ?>selected="selected"<?php } ?>>Transgender</option>
                    </select>
                  <?php echo form_error('gender'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Father Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="father_name" value="<?php if($action == 'Edit'){echo $father_name;} else {echo set_value('father_name');} ?>" class="form-control" required="required" placeholder="Enter Father Name">
                  <?php echo form_error('father_name'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Email Address <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="email" name="email" class="form-control" id="email" required="required" placeholder="Enter Email Address" value="<?php if($action == 'Edit'){echo $email;} else {echo set_value('email');} ?>">
                  <?php echo form_error('email'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">DOB <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <div class="input-group">
					<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Dob" name="dob" value="<?php if($action == 'Edit'){echo $dob;} else {echo set_value('dob');} ?>">
				</div>                                        
                  <?php echo form_error('dob'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Present Address <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <textarea rows="5" cols="5" name="present_address" class="form-control" required="required" placeholder="Enter Present Address"><?php if($action == 'Edit'){echo $present_address;} else {echo set_value('present_address');} ?></textarea>
                  <?php echo form_error('present_address'); ?>
                </div>
              </div>
              <!-- /basic text input -->
               <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Permanent Address <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <textarea rows="5" cols="5" name="permanent_address" class="form-control" required="required" placeholder="Enter Permanent Address"><?php if($action == 'Edit'){echo $permanent_address;} else {echo set_value('permanent_address');} ?></textarea>
                  <?php echo form_error('permanent_address'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Phone <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="phone" value="<?php if($action == 'Edit'){echo $phone;} else {echo set_value('phone');} ?>" class="form-control" placeholder="Enter Phone">
                  <?php echo form_error('phone'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Country <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <?php 
					$js = 'class="select" id=country';
					echo form_dropdown('country',$countries,$country,$js);
					echo form_error('country'); 
				  	?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">State <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="state" value="<?php if($action == 'Edit'){echo $state;} else {echo set_value('state');} ?>" class="form-control" required="required" placeholder="Enter State">
                  <?php echo form_error('state'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">City <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="city" value="<?php if($action == 'Edit'){echo $city;} else {echo set_value('city');} ?>" class="form-control" required="required" placeholder="Enter City">
                  <?php echo form_error('city'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Pin <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="pin" value="<?php if($action == 'Edit'){echo $pin;} else {echo set_value('pin');} ?>" class="form-control" required="required" placeholder="Enter Pin">
                  <?php echo form_error('pin'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Personal Email Address <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="email" name="personal_email" class="form-control" id="email" required="required" placeholder="Enter Personal Email Address" value="<?php if($action == 'Edit'){echo $personal_email;} else {echo set_value('personal_email');} ?>">
                  <?php echo form_error('personal_email'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Mobile <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="mobile" value="<?php if($action == 'Edit'){echo $mobile;} else {echo set_value('mobile');} ?>" class="form-control" required="required" placeholder="Enter Mobile">
                  <?php echo form_error('mobile'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Blood Group <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="blood_group" data-placeholder="Select a Blood Group" class="select">
                    	<option value="" selected="selected" hidden>Select a Blood Group</option>
                        <option value="A+" <?php if($blood_group=='A+') { ?>selected="selected"<?php } ?>>A+</option>
                        <option value="A-" <?php if($blood_group=='A-') { ?>selected="selected"<?php } ?>>A-</option>
                        <option value="B+" <?php if($blood_group=='B+') { ?>selected="selected"<?php } ?>>B+</option>
                        <option value="B-" <?php if($blood_group=='B-') { ?>selected="selected"<?php } ?>>B-</option>
                        <option value="AB+" <?php if($blood_group=='AB+') { ?>selected="selected"<?php } ?>>AB+</option>
                        <option value="AB-" <?php if($blood_group=='AB-') { ?>selected="selected"<?php } ?>>AB-</option>
                        <option value="O+" <?php if($blood_group=='O+') { ?>selected="selected"<?php } ?>>O+</option>
                        <option value="O-" <?php if($blood_group=='O-') { ?>selected="selected"<?php } ?>>O-</option>
                    </select>
                  <?php echo form_error('blood_group'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Votar No <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="votar_no" value="<?php if($action == 'Edit'){echo $votar_no;} else {echo set_value('votar_no');} ?>" class="form-control" required="required" placeholder="Enter Votar No">
                  <?php echo form_error('votar_no'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">PAN No <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="pan_no" value="<?php if($action == 'Edit'){echo $pan_no;} else {echo set_value('pan_no');} ?>" class="form-control" placeholder="Enter PAN No">
                  <?php echo form_error('pan_no'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Passport No <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="passport_no" value="<?php if($action == 'Edit'){echo $passport_no;} else {echo set_value('passport_no');} ?>" class="form-control" placeholder="Enter Passport No">
                  <?php echo form_error('passport_no'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Passport Expiry Date <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                <div class="input-group">
					<span class="input-group-addon"><i class="icon-calendar5"></i></span>
					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Passport Expiry Date" name="passport_expiry" value="<?php if($action == 'Edit'){echo $passport_expiry;} else {echo set_value('passport_expiry');} ?>">
				</div>                                        
                  <?php echo form_error('passport_expiry'); ?>
                </div>
              </div>
              <!-- /basic text input -->
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Aadhar No <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="aadhar_no" value="<?php if($action == 'Edit'){echo $aadhar_no;} else {echo set_value('aadhar_no');} ?>" class="form-control" placeholder="Enter Aadhar No">
                  <?php echo form_error('aadhar_no'); ?>
                </div>
              </div>
              <!-- /basic text input -->
               <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Marital status<span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <select name="marital_status" data-placeholder="Select a Marital status" class="select" required="required">
                    	<option value="" selected="selected" hidden>Select a Marital status</option>
                        <option value="Married" <?php if($marital_status=='Married') { ?>selected="selected"<?php } ?>>Married</option>
                        <option value="Unmarried" <?php if($marital_status=='Unmarried') { ?>selected="selected"<?php } ?>>Unmarried</option>
                        <option value="Widow" <?php if($marital_status=='Widow') { ?>selected="selected"<?php } ?>>Widow</option>
                    </select>
                  <?php echo form_error('marital_status'); ?>
                </div>
              </div>
              <!-- /basic text input --><!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Spouse Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="spouse_name" value="<?php if($action == 'Edit'){echo $spouse_name;} else {echo set_value('spouse_name');} ?>" class="form-control" placeholder="Enter Spouse Name">
                  <?php echo form_error('spouse_name'); ?>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-lg-3">Profile Image <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                	<?php if($action=='Edit') { ?>
                    <img src="<?php echo base_url(); ?>uploads/employee/<?php echo $profile_image; ?>" style="width:100px; height:100px;" />
                    <?php } ?>
                  <input type="file" name="slider_image" class="file-styled" <?php if($action=='Add') { ?>required="required"<?php } ?>>
                  <?php if($this->session->flashdata('err_message')) { echo $this->session->flashdata('err_message'); } ?>
                </div>
              </div>
              
              
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

