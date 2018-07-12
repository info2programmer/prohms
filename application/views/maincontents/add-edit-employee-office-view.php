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



            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Employee Office Details</h4>



          </div>



        </div>



        <div class="breadcrumb-line breadcrumb-line-component">



          <ul class="breadcrumb">



            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>



            <li><a href="<?php echo base_url(); ?>manage_employee_office">Manage Employee Office Details</a></li>



            <li class="active"><?php echo $action; ?> Employee Office Details</li>



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

					$joining_date = $row->joining_date;

					$confirmation_period = $row->confirmation_period;

					$emp_type = $row->emp_type;					

					$emp_skill = $row->emp_skill;

					$designation_id = $row->designation_id;

					$payment_mode = $row->payment_mode;

					$location = $row->location;

					$increment_date = $row->increment_date;

					$resignation_date = $row->resignation_date;

					$last_working_date = $row->last_working_date;

					$is_pf = $row->is_pf;

					$pf_no = $row->pf_no;

					$epf_no = $row->epf_no;

					$relationship = $row->relationship;

					$pf_enrollment_date = $row->pf_enrollment_date;

					$is_esi = $row->is_esi;

					$esi_no = $row->esi_no;

					$esi_date = $row->esi_date;

					$bank_acc_no = $row->bank_acc_no;

					$bank_name = $row->bank_name;

					$bank_acc_holder_name = $row->bank_acc_holder_name;

					$bank_ifsc_code = $row->bank_ifsc_code;

					$username = $row->username;

					$password = $row->password;



				} else {



					$emp_id = '';

					$joining_date = '';

					$confirmation_period = '';					

					$emp_skill='';

					$emp_type = '';

					$designation_id = '';

					$payment_mode = '';

					$location = '';

					$increment_date = '';

					$resignation_date = '';

					$last_working_date = '';

					$is_pf = '';

					$pf_no = '';

					$epf_no = '';

					$relationship = '';

					$pf_enrollment_date = '';

					$is_esi = '';

					$esi_no = '';

					$esi_date = '';

					$bank_acc_no = '';

					$bank_name = '';

					$bank_acc_holder_name = '';

					$bank_ifsc_code = '';

					$username = '';

					$password = '';

				}



			?>



              <input type="hidden" name="mode" value="tab" />



              <fieldset class="content-group">



              <legend class="text-bold">Employee Inputs</legend>



              



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                    <?php 



					$js = 'class="select" id=emp_id';



					echo form_dropdown('emp_id',$emps,$emp_id,$js);



					echo form_error('emp_id'); 



				  	?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Joining Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Joining Date" name="joining_date" value="<?php if($action == 'Edit'){echo $joining_date;} else {echo set_value('joining_date');} ?>">



				</div>                                        



                  <?php echo form_error('joining_date'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Confirmation Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Confirmation Date" name="confirmation_period" value="<?php if($action == 'Edit'){echo $confirmation_period;} else {echo set_value('confirmation_period');} ?>">



				</div>                                        



                  <?php echo form_error('confirmation_period'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Employee Skill type <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                    <select name="emp_skill" data-placeholder="Select a Employee Skill type" class="select">



                    	<option value="" selected="selected" hidden>Select a Employee Skill type</option>



                        <option value="S" <?php if($emp_skill=='S') { ?>selected="selected"<?php } ?>>Skilled</option>



                        <!--<option value="U" <?php if($emp_skill=='U') { ?>selected="selected"<?php } ?>>Un-skilled</option>-->



                    </select>



                  <?php echo form_error('emp_skill'); ?>



                </div>



              </div>



              <!-- /basic text input -->

              

               <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Employee type <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                    <select name="emp_type" data-placeholder="Select a Employee type" class="select">



                    	<option value="" selected="selected" hidden>Select a Employee type</option>



                        <option value="Full Time" <?php if($emp_type=='Full Time') { ?>selected="selected"<?php } ?>>Full Time</option>



                        <option value="Part Time" <?php if($emp_type=='Part Time') { ?>selected="selected"<?php } ?>>Part Time</option>



                    </select>



                  <?php echo form_error('emp_type'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Designation <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                    <?php 



					$js = 'class="select" id=designation_id';



					echo form_dropdown('designation_id',$designations,$designation_id,$js);



					echo form_error('designation_id'); 



				  	?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Salary Payment Mode <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                    <select name="payment_mode" data-placeholder="Select a Payment Mode" class="select" id="payment_mode">



                    	<option value="" selected="selected" hidden>Select a Payment Mode</option>



                        <option value="Cash" <?php if($payment_mode=='Cash') { ?>selected="selected"<?php } ?>>Cash</option>



                        <option value="Cheque" <?php if($payment_mode=='Cheque') { ?>selected="selected"<?php } ?>>Cheque</option>



                        <option value="Transfer" <?php if($payment_mode=='Transfer') { ?>selected="selected"<?php } ?>>Transfer</option>



                    </select>



                  <?php echo form_error('payment_mode'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">
                <label class="control-label col-lg-3">Location <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <?php 
					$js = 'class="select" id=location';
					echo form_dropdown('location',$locations,$location,$js);
					echo form_error('location');
					?>
                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Increment Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Increment Date" name="increment_date" value="<?php if($action == 'Edit'){echo $increment_date;} else {echo set_value('increment_date');} ?>">



				</div>                                        



                  <?php echo form_error('increment_date'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Resignation Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Resignation Date" name="resignation_date" value="<?php if($action == 'Edit'){echo $resignation_date;} else {echo set_value('resignation_date');} ?>">



				</div>                                        



                  <?php echo form_error('resignation_date'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">Last Working Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select Last Working Date" name="last_working_date" value="<?php if($action == 'Edit'){echo $last_working_date;} else {echo set_value('last_working_date');} ?>">



				</div>                                        



                  <?php echo form_error('last_working_date'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Styled inline radio group -->



			  <div class="form-group">



					<label class="control-label col-lg-3">Is PF <span class="text-danger">*</span></label>



						<div class="col-lg-9">



							<label class="radio-inline">



								<input type="radio" name="is_pf" class="styled" value="1" <?php if($is_pf==1) { ?>checked="checked"<?php } ?>>



									Yes



							</label>



							<label class="radio-inline">



								<input type="radio" name="is_pf" class="styled" value="0" <?php if($is_pf==0) { ?>checked="checked"<?php } ?>>



									No



							</label>



						</div>



                        <?php echo form_error('is_pf'); ?>



			 </div>



			<!-- /styled inline radio group -->



              



              



              



              



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">PF No. <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                  <input type="text" name="pf_no" value="<?php if($action == 'Edit'){echo $pf_no;} else {echo set_value('pf_no');} ?>" class="form-control" placeholder="Enter PF No">



                  <?php echo form_error('pf_no'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">EPF No. <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                  <input type="text" name="epf_no" value="<?php if($action == 'Edit'){echo $epf_no;} else {echo set_value('epf_no');} ?>" class="form-control" placeholder="Enter EPF No.">



                  <?php echo form_error('epf_no'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <!--<div class="form-group">
                <label class="control-label col-lg-3">Relationship <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="relationship" class="form-control" id="relationship" placeholder="Enter Relationship" value="<?php if($action == 'Edit'){echo $relationship;} else {echo set_value('relationship');} ?>">
                  <?php echo form_error('relationship'); ?>
                </div>
              </div>-->
 


              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">PF Enrollment Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select PF Enrollment Date" name="pf_enrollment_date" value="<?php if($action == 'Edit'){echo $pf_enrollment_date;} else {echo set_value('pf_enrollment_date');} ?>">



				</div>                                        



                <?php echo form_error('pf_enrollment_date'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Styled inline radio group -->



			  <div class="form-group">



					<label class="control-label col-lg-3">Is ESI <span class="text-danger">*</span></label>



						<div class="col-lg-9">



							<label class="radio-inline">



								<input type="radio" name="is_esi" class="styled" value="1" <?php if($is_esi==1) { ?>checked="checked"<?php } ?>>



									Yes



							</label>



							<label class="radio-inline">



								<input type="radio" name="is_esi" class="styled" value="0" <?php if($is_esi==0) { ?>checked="checked"<?php } ?>>



									No



							</label>



						</div>



                        <?php echo form_error('is_esi'); ?>



			 </div>



			<!-- /styled inline radio group -->



            <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">ESI No <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                  <input type="text" name="esi_no" class="form-control" id="esi_no" placeholder="Enter ESI No" value="<?php if($action == 'Edit'){echo $esi_no;} else {echo set_value('esi_no');} ?>">



                  <?php echo form_error('esi_no'); ?>



                </div>



              </div>



              <!-- /basic text input -->



              <!-- Basic text input -->



              <div class="form-group">



                <label class="control-label col-lg-3">ESI Date <span class="text-danger">*</span></label>



                <div class="col-lg-9">



                <div class="input-group">



					<span class="input-group-addon"><i class="icon-calendar5"></i></span>



					<input type="text" class="form-control pickadate-accessibility" placeholder="Select ESI Date" name="esi_date" value="<?php if($action == 'Edit'){echo $esi_date;} else {echo set_value('esi_date');} ?>">



				</div>                                        



                <?php echo form_error('esi_date'); ?>



                </div>



              </div>



              <!-- /basic text input --> 



              <!-- Basic text input -->

              <div class="form-group" id="bank_acc_no">

                <label class="control-label col-lg-3">Bank Account No <span class="text-danger">*</span></label>

                <div class="col-lg-9">

                  <input type="text" name="bank_acc_no" class="form-control" id="bank_acc_no" placeholder="Enter Bank Account No" value="<?php if($action == 'Edit'){echo $bank_acc_no;} else {echo set_value('bank_acc_no');} ?>">

                  <?php echo form_error('bank_acc_no'); ?>

                </div>

              </div>

              <!-- /basic text input -->

			  <!-- Basic text input -->

              <div class="form-group" id="bank_name">

                <label class="control-label col-lg-3">Bank Name <span class="text-danger">*</span></label>

                <div class="col-lg-9">

                  <input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name" value="<?php if($action == 'Edit'){echo $bank_name;} else {echo set_value('bank_name');} ?>">

                  <?php echo form_error('bank_name'); ?>

                </div>

              </div>

              <!-- /basic text input -->	

              <!-- Basic text input -->

              <div class="form-group" id="bank_acc_holder_name">

                <label class="control-label col-lg-3">Bank Account Holder Name <span class="text-danger">*</span></label>

                <div class="col-lg-9">

                  <input type="text" name="bank_acc_holder_name" class="form-control" placeholder="Enter Bank Account Holder Name" value="<?php if($action == 'Edit'){echo $bank_acc_holder_name;} else {echo set_value('bank_acc_holder_name');} ?>">

                  <?php echo form_error('bank_acc_holder_name'); ?>

                </div>

              </div>

              <!-- /basic text input -->

			  <!-- Basic text input -->

              <div class="form-group" id="bank_ifsc_code">

                <label class="control-label col-lg-3">Bank IFSC Code <span class="text-danger">*</span></label>

                <div class="col-lg-9">

                  <input type="text" name="bank_ifsc_code" class="form-control" placeholder="Enter Bank IFSC Code" value="<?php if($action == 'Edit'){echo $bank_ifsc_code;} else {echo set_value('bank_ifsc_code');} ?>">

                  <?php echo form_error('bank_ifsc_code'); ?>

                </div>

              </div>

              <!-- /basic text input -->

              

              <!-- Basic text input -->

              <div class="form-group" id="bank_ifsc_code">

                <label class="control-label col-lg-3">Username <span class="text-danger">*</span></label>

                <div class="col-lg-9">

                  <input type="text" name="username" class="form-control" placeholder="Enter Username" value="<?php if($action == 'Edit'){echo $username;} else {echo set_value('username');} ?>">

                  <?php echo form_error('username'); ?>

                </div>

              </div>

              <!-- /basic text input -->              

              <!-- Basic text input -->

              <div class="form-group" id="bank_ifsc_code">

                <label class="control-label col-lg-3">Password <span class="text-danger">*</span></label>

                <div class="col-lg-9">

                  <input type="password" name="password" class="form-control" placeholder="Enter Password" value="<?php if($action == 'Edit'){echo $password;} else {echo set_value('password');} ?>">

                  <?php echo form_error('password'); ?>

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



<script>

$(document).ready(function() {

	payment_mode = $('#payment_mode').val();	

	if(payment_mode=='Cash' || payment_mode=='Cheque' || payment_mode=='')

	{

		$('#bank_acc_no').hide();

		$('#bank_name').hide();

		$('#bank_acc_holder_name').hide();

		$('#bank_ifsc_code').hide();	

	}

	else if(payment_mode=='Transfer')

	{

		$('#bank_acc_no').show();

		$('#bank_name').show();

		$('#bank_acc_holder_name').show();

		$('#bank_ifsc_code').show();

	}

	

	

	$("#payment_mode").on('change',function() {	

        payment_mode1 = $('#payment_mode').val();		

		if(payment_mode1=='Cash' || payment_mode1=='Cheque')

		{

			$('#bank_acc_no').hide();

			$('#bank_name').hide();

			$('#bank_acc_holder_name').hide();

			$('#bank_ifsc_code').hide();	

		}

		else if(payment_mode1=='Transfer')

		{

			$('#bank_acc_no').show();

			$('#bank_name').show();

			$('#bank_acc_holder_name').show();

			$('#bank_ifsc_code').show();

		}

    });

});

</script>