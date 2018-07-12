<div class="main">
  <div class="document-title">
    <div class="container">
      <h1 class="center">Login</h1>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.document-title -->
  
  <div class="container">
    <div class="row">
      <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
      <span style="color:#FF0000;">
      <?php if($this->session->userdata('error_message')) { echo $this->session->userdata('error_message');} ?>
      </span>
      <?php
	  if(($this->uri->segment(3))||($this->uri->segment(4))||($this->uri->segment(5))||($this->uri->segment(6)))
	  {	 
		$str=base64_encode($this->uri->segment(3)."/".$this->uri->segment(4)."/".$this->uri->segment(5)."/".$this->uri->segment(6));
		$url_to_be_send=urlencode($str);		
	  }
	  ?>
        <form method="post" action="<?php echo base_url(); ?>users/login/<?php echo ($url_to_be_send)?$url_to_be_send:''; ?>">
        <input type="hidden" name="mode" value="login" />
        
       
      
       
        
          <div class="form-group">
            <!--<label for="form-login-username">Username</label>-->
            <input type="text" class="form-control" id="form-login-username" name="username" placeholder="Enter Username" style="border-bottom:1px solid #666; border-top:none; border-right:none; border-left:none; border-radius:0px; ">
            <?php echo form_error('username'); ?>
          </div>
          <!-- /.form-group -->
          
          <div class="form-group">
            <!--<label for="form-login-password">Password</label>-->
            <input type="password" class="form-control" id="form-login-password" name="password" placeholder="Enter Password" style="border-bottom:1px solid #666; border-top:none; border-right:none; border-left:none; border-radius:0px; ">
            <?php echo form_error('password'); ?>
          </div>
          <!-- /.form-group -->
          
          <!--<div class="form-group">            
            <input type="radio" id="form-login-password" name="user_type" value="C">College
            <input type="radio" id="form-login-password" name="user_type" value="S">Student
            <input type="radio" id="form-login-password" name="user_type" value="P">PG Accommodation
            <?php echo form_error('user_type'); ?>
          </div>-->
          <!-- /.form-group -->
          
          <div class="form-group">
            <button type="submit" class="btn btn-secondary btn-block">Sign in</button>
          </div>
          <!-- /.form-group -->
          <div class="form-group">
            <a href="<?php echo base_url(); ?>users/registration" style="text-decoration:none; text-align:right;">New User? Sign Up</a>
            | 
         
          <a href="<?php echo base_url(); ?>users/forgotpassword" style="text-decoration:none; text-align:right;">Forgot Password ? </a>
          </div>
           
          
          
          <hr>
          
          
          
          <!-- /.row -->
        </form>
        
        
        
        
      </div>
      <!-- /.col-sm-4 --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- /.container --> 
  
</div>
<!-- /.main -->