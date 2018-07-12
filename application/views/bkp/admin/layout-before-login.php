<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>BONGINEERS ADMIN</title>	

	<!--<link href="<?php echo base_url(); ?>material/admin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="144x144">

	<link href="<?php echo base_url(); ?>material/admin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="114x114">

	<link href="<?php echo base_url(); ?>material/admin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png" sizes="72x72">

	<link href="<?php echo base_url(); ?>material/admin/assets/images/favicon.ico" rel="apple-touch-icon" type="image/png">

	<link href="<?php echo base_url(); ?>material/admin/assets/images/favicon.ico" rel="icon" type="image/png">

	<link href="<?php echo base_url(); ?>material/admin/assets/images/favicon.ico" rel="shortcut icon">-->
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>material/images/favicon.png" type="image/x-icon" />



	<!-- Global stylesheets -->

	<link href="<?php echo base_url(); ?>material/admin/fonts/fonts.css" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url(); ?>material/admin/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/animate.min.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/bootstrap.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/main.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/bootstrap-extended.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/plugins.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/color-system.css" rel="stylesheet" type="text/css">

	<link href="<?php echo base_url(); ?>material/admin/css/media.css" rel="stylesheet" type="text/css">

	<link type="text/css" rel="stylesheet" href="login_simple.htm" id="style">

	<link type="text/css" rel="stylesheet" href="login_simple.htm" id="theme">

	<!-- /global stylesheets -->



	<!-- Core JS files -->	

	<script src="<?php echo base_url(); ?>material/admin/js/jquery.min.js"></script>

	<script src="<?php echo base_url(); ?>material/admin/js/bootstrap.min.js"></script>	

	<script src="<?php echo base_url(); ?>material/admin/js/fancybox.min.js"></script>	

	<script src="<?php echo base_url(); ?>material/admin/js/app.js"></script>

	<script src="<?php echo base_url(); ?>material/admin/js/forms/uniform.min.js"></script>

    

    <style type="text/css">

	.validation-error{color:#F00;}

	.login-status-succ{color:#00CC66; text-align:center;}

	.login-status-fail{color:#F00; text-align:center;}

	</style>

</head>

<body>

<div class="page-container login-container">



		<!-- Page content -->

		<div class="page-content">



			<!-- Main content -->

			<div class="content-wrapper">



				<!-- Content area -->

				<div class="content">					

					<!-- Simple login form -->

					<form action="<?php echo base_url(); ?>index.php/admin/user/login" method="post">

                    <input type="hidden" name="mode" value="login">			

						<div class="panel panel-body login-form">							

							<div class="text-center mb-20">

								<div class="icon-object border-slate-300 text-slate-300"><i class="fa fa-user"></i>

                                

                                </div>

								<h5 class="content-group">Bongineers<small class="display-block">Please put your credentials</small></h5>

							</div>

                            <?php if($this->session->userdata('success_message')) { ?>

                            <span class="login-status-succ"><?php echo $this->session->userdata('success_message'); ?></span>

                            <?php } ?>

                            <?php if($this->session->userdata('error_message')) { ?>

                    		<span class="login-status-fail"><?php echo $this->session->userdata('error_message'); ?></span>

							<?php } ?>

                            

							<div class="form-group has-feedback has-feedback-left">

								<input type="text" class="form-control" placeholder="Username" name="username">

                                <span class="validation-error"><?php echo form_error('username'); ?></span>

								<div class="form-control-feedback">

									<i class="fa fa-user text-muted"></i>

								</div>

							</div>



							<div class="form-group has-feedback has-feedback-left">

								<input type="password" class="form-control" placeholder="Password" name="password">

                                <span class="validation-error"><?php echo form_error('password'); ?></span>

								<div class="form-control-feedback">

									<i class="fa fa-lock text-muted"></i>

								</div>

							</div>



							<div class="login-options">

								<div class="row">

									<div class="col-sm-6">

										<div class="checkbox ml-5">

											<!--<label>

												<input type="checkbox" class="styled" checked="checked">

												Remember me

											</label>-->

										</div>

									</div>



									<div class="col-sm-6 text-right mt-10">

										<!--<a href="http://localhost/templates/bird/theme/login_password_recover.html">Forgot password?</a>-->

									</div>

								</div>

							</div>



							<div class="form-group">

								<!--<button type="submit" class="btn btn-info btn-lg btn-labeled btn-labeled-right btn-block"><b><i class="fa fa-sign-in"></i></b> Log in</button>			-->

                                <button type="submit" class="btn btn-danger btn-lg btn-labeled btn-labeled-right btn-block"><b><i class="fa fa-sign-in"></i></b> Log in</button>					

							</div>						

						</div>

						

					</form>

					<!-- /simple login form -->





					<!-- Footer -->

					<div class="footer text-muted">

						&copy; <?php echo date("Y"); ?> Powered by <a href="http://projukti.info/" target="_blank">Projukti</a>

					</div>

					<!-- /footer -->



				</div>

				<!-- /content area -->



			</div>

			<!-- /main content -->



		</div>

		<!-- /page content -->



	</div>

<script>

$(function() {

	$(".styled, .multiselect-container input").uniform({

		radioClass: 'choice'

	});

});

</script>

</body>

</html>