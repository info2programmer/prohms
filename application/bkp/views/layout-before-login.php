<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Human Resource Management System</title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>material/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>material/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>material/assets/css/core.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>material/assets/css/components.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>material/assets/css/colors.css" rel="stylesheet" type="text/css">
<!-- /global stylesheets -->

<!-- Core JS files -->
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/plugins/loaders/pace.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/core/libraries/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/core/libraries/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/plugins/forms/validation/validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/plugins/forms/styling/uniform.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>material/assets/js/pages/login_validation.js"></script>
<!-- /theme JS files -->

</head>

<body class="login-container  pace-done">

<!-- Page container -->
<div class="page-container"> 
  
  <!-- Page content -->
  <div class="page-content"> 
    
    <!-- Main content -->
    <div class="content-wrapper"> 
      
      <!-- Content area -->
      <div class="content pb-20"> 
        
        <!-- Form with validation -->
        <?php if($this->uri->segment(1)=='') { ?>
        <form action="<?php echo base_url(); ?>user/login" class="form-validate" method="post"> 
        <?php } else if($this->uri->segment(1)=='employee') { ?>
        <form action="<?php echo base_url(); ?>employee/login" class="form-validate" method="post">
        <?php } else { ?>
        <form action="<?php echo base_url(); ?>user/login" class="form-validate" method="post">
        <?php } ?>       
        <input type="hidden" name="mode" value="login">
          <div class="panel panel-body login-form">
            <div class="text-center">
              <div class="text-slate-300"><!--<i class="icon-reading"></i>-->
              <img src="<?php echo base_url(); ?>material/assets/images/logo.png" style="width: 66px;height: 66px;">
              </div>
              <h5 class="content-group">Human Resource and Payroll Management <small class="display-block">Your credentials</small></h5>
              	<span style="color:#0C0">
					<?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?>
                </span>
                <span style="color:#F00">
                    <?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('error_message'); } ?>
                </span>
            </div>
            <div class="form-group has-feedback has-feedback-left">
              <input type="text" class="form-control" placeholder="Username" name="username">
              <div class="form-control-feedback"> <i class="icon-user text-muted"></i> </div>
              <?php echo form_error('username');?>
            </div>
            <div class="form-group has-feedback has-feedback-left">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <div class="form-control-feedback"> <i class="icon-lock2 text-muted"></i> </div>
              <?php echo form_error('password');?>
            </div>
            <div class="form-group login-options">
              <div class="row"> 
                <!--<div class="col-sm-6">
                  <label class="checkbox-inline">
                    <input type="checkbox" class="styled" checked="checked">
                    Remember </label>
                </div>-->
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn bg-blue btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
            </div>
            <!--<div class="content-divider text-muted form-group"><span>or sign in with</span></div>
            <ul class="list-inline form-group list-inline-condensed text-center">
              <li><a href="#" class="btn border-indigo text-indigo btn-flat btn-icon btn-rounded"><i class="icon-facebook"></i></a></li>
              <li><a href="#" class="btn border-pink-300 text-pink-300 btn-flat btn-icon btn-rounded"><i class="icon-dribbble3"></i></a></li>
              <li><a href="#" class="btn border-slate-600 text-slate-600 btn-flat btn-icon btn-rounded"><i class="icon-github"></i></a></li>
              <li><a href="#" class="btn border-info text-info btn-flat btn-icon btn-rounded"><i class="icon-twitter"></i></a></li>
            </ul>
            <div class="content-divider text-muted form-group"><span>Don't have an account?</span></div>
            <a href="login_registration.html" class="btn btn-default btn-block content-group">Sign up</a> <span class="help-block text-center no-margin">By continuing, you're confirming that you've read our <a href="#">Terms &amp; Conditions</a> and <a href="#">Cookie Policy</a></span>--> </div>
        </form>
        <!-- /form with validation --> 
        
      </div>
      <!-- /content area --> 
      
    </div>
    <!-- /main content --> 
    
  </div>
  <!-- /page content --> 
  
</div>
<!-- /page container -->

</body>
</html>
