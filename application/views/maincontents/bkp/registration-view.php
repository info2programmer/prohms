<div class="main">
  <div class="document-title">
    <div class="container">
      <h1 class="center">Registration</h1>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.document-title -->
  
  <div class="container">
    <div class="row"> 
      <!-- /.col-* -->
      
      <div class="col-sm-12">
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" <?php if($mode=='student'){?>class="active"<?php } else if($mode=='') { ?>class="active"<?php } ?>>
           	<a href="#student" aria-controls="student" role="tab" data-toggle="tab"> <strong>Student Registration</strong> <span>Are you a student ? Register Now!!!</span> </a> 
           </li>
          <li role="presentation" <?php if($mode=='college'){?>class="active"<?php }?>> 
          	<a href="#college" aria-controls="college" role="tab" data-toggle="tab"> <strong>College Registration</strong> <span>Register Your College Now!!!</span> </a> 
          </li>
          <li role="presentation" <?php if($mode=='pg'){?>class="active"<?php }?>> 
          	<a href="#pg" aria-controls="college" role="tab" data-toggle="tab"> <strong>PG Owner Registration</strong> <span>Register Your Ownership Now!!!</span> </a> 
          </li>
        </ul>
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane <?php if($mode=='student'){?>active<?php } else if($mode=='') { ?>active<?php } ?>" id="student">
          <?php if($this->session->flashdata('student_success_message')) { echo $this->session->flashdata('student_success_message'); } ?>
          	<form method="post" action="<?php echo base_url(); ?>users/registration" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="student" />
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form-register-username">Student Name</label>
                  <input type="text" class="form-control" id="form-register-name" name="student_name" value="<?php echo set_value('student_name'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_name'); ?></span>
                </div>
                <!-- /.form-group -->
                
                <div class="form-group">
                  <label for="form-register-username">Phone Number</label>
                  <input type="text" class="form-control" id="form-register-phonenumber" name="student_phone" value="<?php echo set_value('student_phone'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_phone'); ?></span>
                </div>
                <!-- /.form-group -->
                
                <div class="form-group">
                  <label for="form-register-username">E-mail</label>
                  <input type="email" class="form-control" id="form-register-email" name="student_email" value="<?php echo set_value('student_email'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_email'); ?></span>
                </div>
                <!-- /.form-group --> 
                
              </div>
              <!-- /.col-* -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form-register-username">Address</label>
                  <input type="text" class="form-control" id="form-register-address" name="student_address" value="<?php echo set_value('student_address'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_address'); ?></span>
                </div>
                <!-- /.form-group -->
                
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="form-register-first-name">Userame</label>
                    <input type="text" class="form-control" id="form-register-username" name="student_username" value="<?php echo set_value('student_username'); ?>">
                    <span style="color:#FF0000"><?php echo form_error('student_username'); ?></span>
                  </div>
                  <!-- /.form-group -->
                  
                  <div class="form-group col-sm-6">
                    <label for="form-login-surname">Password</label>
                    <input type="password" class="form-control" id="form-register-password" name="student_password">
                    <span style="color:#FF0000"><?php echo form_error('student_password'); ?></span>
                  </div>
                  <!-- /.form-group --> 
                </div>
                <!-- /.row -->
                
                <div class="form-group">
                  <label form="form-register-photo">Photo</label>
                  <input type="file" name="slider_image" id="form-register-photo2" class="form-control">
                  <span style="color:#FF0000">
				  <?php if($this->session->flashdata('student_message')) { echo $this->session->flashdata('student_message'); } ?>
                  </span>
                </div>
                <!-- /.form-group--> 
                
              </div>
              <!-- /.col-* --> 
            </div>
            <!-- /.row -->
            
            <div class="center">
              <div class="checkbox checkbox-info">
                <label>
                  <input type="checkbox" name="student_agree">
                  
                  By signing up, you agree with the <a href="#">terms and conditions</a></label>
                  <span style="color:#FF0000"><?php echo form_error('student_agree'); ?></span>
              </div>
              <!-- /.checkbox -->
              
              <button type="submit" class="btn btn-secondary">Create an Account</button>
              
            </div>
            <!-- /.center --> 
            </form>
          </div>
          <!-- /.tab-pane -->
          
          <div role="tabpanel" class="tab-pane <?php if($mode=='college'){?>active<?php } ?>" id="college">
          <?php if($this->session->flashdata('college_success_message')) { echo $this->session->flashdata('college_success_message'); } ?>
          <form method="post" action="<?php echo base_url(); ?>users/registration" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="college" />
            <div class="row">
              <div class="col-sm-6">
              <div class="form-group">
                  <label for="form-register-username">Select College Type</label>
                  <select class="form-control" name="college_cat" id="college_cat">
                  	<option value="" selected="selected" hidden>Select College Type</option>
                  	<option value="BTech" <?php echo  set_select('college_cat', 'BTech'); ?>>B. Tech</option>
                    <option value="Diploma" <?php echo  set_select('college_cat', 'Diploma'); ?>>Diploma</option>
                  </select>
                  <span style="color:#FF0000"><?php echo form_error('college_cat'); ?></span>
                </div>
                <div class="form-group">
                  <label for="form-register-username">College Name</label>
                  <div id="city_id"></div>
                  <select class="form-control" name="college" id="city_dropdown">
                  	<option value="" selected="selected" hidden>Select College Name</option>
                  </select>
                  <span style="color:#FF0000"><?php echo form_error('college_name'); ?></span>
                </div>
                <!-- /.form-group -->
                
                
                <div class="form-group">
                  <label for="form-register-username">Phone Number</label>
                  <input type="text" class="form-control" id="form-register-phonenumber" name="phone" value="<?php echo set_value('phone'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('phone'); ?></span>
                </div>
                <!-- /.form-group -->
                
                <div class="form-group">
                  <label for="form-register-username">E-mail</label>
                  <input type="email" class="form-control" id="form-register-email" name="email" value="<?php echo set_value('email'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('email'); ?></span>
                </div>
                <!-- /.form-group --> 
                
              </div>
              <!-- /.col-* -->
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form-register-username">Address</label>
                  <input type="text" class="form-control" id="form-register-address" name="address" value="<?php echo set_value('address'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('address'); ?></span>
                </div>
                <!-- /.form-group -->
                
                
                  <div class="form-group">
                    <label for="form-register-first-name">Userame</label>
                    <input type="text" class="form-control" id="form-register-username" name="username" value="<?php echo set_value('username'); ?>">
                    <span style="color:#FF0000"><?php echo form_error('username'); ?></span>
                  </div>
                  <!-- /.form-group -->
                  
                  <div class="form-group ">
                    <label for="form-login-surname">Password</label>
                    <input type="password" class="form-control" id="form-register-password" name="password">
                    <span style="color:#FF0000"><?php echo form_error('password'); ?></span>
                  </div>
                  <!-- /.form-group --> 
               
                <!-- /.row -->
                
                <div class="form-group">
                  <label form="form-register-photo">Photo</label>
                  <input type="file" name="slider_image" id="form-register-photo1" class="form-control">
                  <span style="color:#FF0000"><?php if($this->session->flashdata('err_message')) { echo $this->session->flashdata('err_message'); } ?></span>
                </div>
                <!-- /.form-group--> 
                
              </div>
              <!-- /.col-* --> 
            </div>
            <!-- /.row -->
            
            <div class="center">
              <div class="checkbox checkbox-info">
                <label>
                  <input type="checkbox" name="agree">
                  By signing up, you agree with the <a href="#">terms and conditions</a></label>
                  <?php echo form_error('agree'); ?>
              </div>
              <!-- /.checkbox -->
              
              <button type="submit" class="btn btn-secondary">Create an Account</button>
            </div>
            <!-- /.center -->
            </form> 
          </div>
          <!-- /.tab-pane --> 
          
          <div role="tabpanel" class="tab-pane <?php if($mode=='pg'){?>active<?php } ?>" id="pg">
          <?php if($this->session->flashdata('student_success_message')) { echo $this->session->flashdata('student_success_message'); } ?>
          	<form method="post" action="<?php echo base_url(); ?>users/registration" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="pg" />
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form-register-username">PG Owner Name</label>
                  <input type="text" class="form-control" id="form-register-name" name="student_name" value="<?php echo set_value('student_name'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_name'); ?></span>
                </div>
                
                
                <div class="form-group">
                  <label for="form-register-username">Phone Number</label>
                  <input type="text" class="form-control" id="form-register-phonenumber" name="student_phone" value="<?php echo set_value('student_phone'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_phone'); ?></span>
                </div>
                
                
                <div class="form-group">
                  <label for="form-register-username">E-mail</label>
                  <input type="email" class="form-control" id="form-register-email" name="student_email" value="<?php echo set_value('student_email'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_email'); ?></span>
                </div>
                
                
              </div>
              
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="form-register-username">Address</label>
                  <input type="text" class="form-control" id="form-register-address" name="student_address" value="<?php echo set_value('student_address'); ?>">
                  <span style="color:#FF0000"><?php echo form_error('student_address'); ?></span>
                </div>
               
                
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="form-register-first-name">Userame</label>
                    <input type="text" class="form-control" id="form-register-username" name="student_username" value="<?php echo set_value('student_username'); ?>">
                    <span style="color:#FF0000"><?php echo form_error('student_username'); ?></span>
                  </div>
                  
                  
                  <div class="form-group col-sm-6">
                    <label for="form-login-surname">Password</label>
                    <input type="password" class="form-control" id="form-register-password" name="student_password">
                    <span style="color:#FF0000"><?php echo form_error('student_password'); ?></span>
                  </div>
                  
                </div>
                
                
                <div class="form-group">
                  <label form="form-register-photo">Photo</label>
                  <input type="file" name="slider_image" id="form-register-photo" class="form-control">
                  <span style="color:#FF0000">
				  <?php if($this->session->flashdata('student_message')) { echo $this->session->flashdata('student_message'); } ?>
                  </span>
                </div>
                
                
              </div>
              
            </div>
            
            
            <div class="center">
              <div class="checkbox checkbox-info">
                <label>
                  <input type="checkbox" name="student_agree">
                  
                  By signing up, you agree with the <a href="#">terms and conditions</a></label>
                  <span style="color:#FF0000"><?php echo form_error('student_agree'); ?></span>
              </div>
             
              
              <button type="submit" class="btn btn-secondary">Create an Account</button>
              
            </div>
            
            </form>
          </div>
          
          
        </div>
      
      </div>
    </div>
    
  </div>
  
  
</div>
<!-- /.main -->
<!--<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/jquery.ezmark.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-sass/javascripts/bootstrap/collapse.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-sass/javascripts/bootstrap/dropdown.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-sass/javascripts/bootstrap/tab.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-sass/javascripts/bootstrap/transition.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-fileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-select/js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/bootstrap-wysiwyg/bootstrap-wysiwyg.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/cycle2/jquery.cycle2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/cycle2/jquery.cycle2.carousel.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/libraries/countup/countup.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/profession.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>material/assets/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>material/assets/js/jquery.carouFredSel-6.2.1-packed.js"></script>
        
        <script type="text/javascript" language="javascript">
			$(function() {

				//	Basic carousel, no options
				if($('#foo0').length){$('#foo0').carouFredSel();}

				//	Basic carousel + timer, using CSS-transitions
				if($('#foo1').length){
					$('#foo1').carouFredSel({
					auto: {
						pauseOnHover: 'resume',
						progress: '#timer1'
					}
				}, {
					transition: true
				});

				}
				//	Scrolled by user interaction
				if($('#foo2').length){
					$('#foo2').carouFredSel({
					auto: false,
					prev: '#prev2',
					next: '#next2',
					pagination: "#pager2",
					mousewheel: true,
					swipe: {
						onMouse: true,
						onTouch: true
					}
				});
				}

				//	Variable number of visible items with variable sizes
				if($('#foo3').length){
					$('#foo3').carouFredSel({
					width: 360,
					height: 'auto',
					prev: '#prev3',
					next: '#next3',
					auto: false
				});
				}

				//	Responsive layout, resizing the items
				if($('#foo4').length){
					$('#foo4').carouFredSel({
					responsive: true,
					width: '100%',
					scroll: 2,
					items: {
						width: 200,
					//	height: '30%',	//	optionally resize item-height
						visible: {
							min: 2,
							max: 6
						}
					}
				});
				}

				//	Fuild layout, centering the items
				if($('#foo5').length){
					$('#foo5').carouFredSel({
					width: '100%',
					scroll: 2
				});
				}

			});
		</script>
<script>
	$(document).ready(function(){
		
		
		stateID = $('#college_cat').val();
		
			if(stateID == "")
			{
			$("#city_id").hide();	
			}
			if(stateID != "")
			{
			$("#city_dropdown").hide();	
			$("#city_id").show();
			}
			
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {state:stateID,college_name:name},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
			
			
    $("#college_cat").on('change', function(){
			/*$("#city_dropdown").show();*/
			
			stateID = $('#college_cat').val();
			name = $('#college_name').val();
					
			if(stateID != "")
			{
			$("#city_dropdown").hide();	
			$("#city_id").show();
			}
			$.ajax({
				type: "POST",
				url: "ajax_call",
				async: false,
				data: {state:stateID,college_name:name},
				dataType: "html",
				success: function(data) {
                        //data is the html of the page where the request is made.
                        $('#city_id').html(data);
				}
			})
    });
});
</script>-->
