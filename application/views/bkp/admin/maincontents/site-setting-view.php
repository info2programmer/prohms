<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
				<h4><i class="fa fa-th-large position-left"></i> Manage Site Setting</h4>
			</div>										
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>index.php/admin/user"><i class="fa fa-home"></i>Dashboard</a></li>
				<!--<li><a href="<?php echo base_url(); ?>index.php/admin/site_setting">Manage Site Setting</a></li>-->
				<li class="active"><?php echo $action; ?> Site Setting</li>
			</ul>					
		</div>
	</div>
<!-- /page header -->


<!-- Content area -->
<div class="content">        
<div class="row">
			<div class="col-md-12">
            <?php if($this->session->flashdata('error_message')) { ?>
                  <h5 style="color:red;"><?php echo $this->session->flashdata('error_message'); ?></h5>
            <?php } ?>
            <?php if($this->session->flashdata('success_message')) { ?>
                  <h5 style="color:green;"><?php echo $this->session->flashdata('success_message'); ?></h5>
            <?php } ?>
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h4 class="panel-title">
						Manage Site Setting
						</h4>				
					</div>
					<div class="panel-body no-padding-bottom">
						<!--<form class="form-horizontal" action="form_basic.htm#">	-->						
						 <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');
								echo form_open_multipart('',$attributes); ?>
                                
                             <?php
									if($row)
									{  
										$site_name = $row->site_name;
										$site_email_address = $row->site_email_address;
										$site_phone = $row->site_phone;
										$site_meta = $row->site_meta;
										$site_desc = $row->site_desc;
										$site_fblink = $row->site_fblink;
										$site_twtlink = $row->site_twtlink;
									 }
									 else
									 {
										$site_name = '';
										$site_email_address = '';
										$site_phone = '';
										$site_meta = '';
										$site_desc = '';
										$site_fblink = '';
										$site_twtlink = '';
									 }
							?>                              
                             <input type="hidden" name="mode" value="site_setting" />
                             
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Title</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Site Title" name="site_name" value="<?php if($action == 'Edit'){echo $site_name;} else {echo set_value('site_name');} ?>">
                                     <?php echo form_error('site_name'); ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Email Address</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Site Email Address" name="site_email_address" value="<?php if($action == 'Edit'){echo $site_email_address;} else {echo set_value('site_email_address');} ?>">
                                     <?php echo form_error('site_email_address'); ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Phone</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Site Phone" name="site_phone" value="<?php if($action == 'Edit'){echo $site_phone;} else {echo set_value('site_phone');} ?>">
                                     <?php echo form_error('site_phone'); ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Meta Name</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Meta Name" name="site_meta" value="<?php if($action == 'Edit'){echo $site_meta;} else {echo set_value('site_meta');} ?>">
                                     <?php echo form_error('site_meta'); ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Address</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Address" name="site_desc" value="<?php if($action == 'Edit'){echo $site_desc;} else {echo set_value('site_desc');} ?>">
                                     <?php echo form_error('site_desc'); ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Facebook Link</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Facebook Link" name="site_fblink" value="<?php if($action == 'Edit'){echo $site_fblink;} else {echo set_value('site_fblink');} ?>">
                                     <?php echo form_error('site_fblink'); ?>
								</div>
							</div>
                            
                            <div class="form-group">
								<label class="control-label col-lg-2">Site Twitter Link</label>
								<div class="col-lg-10">
									
                                    <input type="text" class="form-control" placeholder="Enter Twitter Link" name="site_twtlink" value="<?php if($action == 'Edit'){echo $site_twtlink;} else {echo set_value('site_twtlink');} ?>">
                                     <?php echo form_error('site_twtlink'); ?>
								</div>
							</div>
                            
                             
							<div class="form-group">
								<label class="control-label col-lg-2">Site Logo</label>
								<div class="col-lg-10">
									<?php if($action == 'Edit') { 
									if($row->site_logo) { 
									?>
                                    <img src="<?php echo base_url();?>uploads/<?php echo $row->site_logo; ?>" height="100" width="400"/>
                                    <?php } else { ?>
                                    <img src="<?php echo base_url(); ?>material/admin/no-user-image.jpg" width="100" height="100" /><br /><br />
                                    <?php } ?>
                                    <?php } ?>
                                   
                                                                  
                                     
                                    <input name="slider_image" type="file" class="file-input-custom" data-show-caption="true" data-show-upload="true" accept="image/*">
								</div>
							</div>
                           
							<div class="form-group">
								<label class="control-label col-lg-2"></label>
								<div class="col-lg-10">
									<button type="submit" class="btn btn-danger btn-rounded"><?php echo $action; ?> Site Setting</button>
								</div>
							</div>							
						<?php echo form_close(); ?>					
					</div>
				</div>
			</div>
			
		</div>
</div>
        
<script type='text/javascript'>
	$(document).ready(function() {		
		$(function() {
			// Basic example
			$('.file-input').fileinput({
				browseLabel: 'Browse',
				browseIcon: '<i class="fa fa-file-o position-left"></i>',
				uploadIcon: '<i class="fa fa-upload position-left"></i>',
				removeIcon: '<i class="fa fa-close position-left"></i>',
				layoutTemplates: {
					icon: '<i class="fa fa-file position-left"></i>'
				},
				initialCaption: "No file selected"
			});

			// Custom layout
			$('.file-input-custom').fileinput({
				previewFileType: 'image',
				browseLabel: 'Select',
				browseClass: 'btn bg-danger-700',
				browseIcon: '<i class="fa fa-image position-left position-left"></i> ',
				removeLabel: 'Remove',
				removeClass: 'btn btn-danger',
				removeIcon: '<i class="fa fa-close position-left position-left"></i> ',
				uploadClass: 'btn bg-teal-400',
				uploadIcon: '<i class="fa fa-upload position-left position-left"></i> ',
				layoutTemplates: {
					icon: '<i class="fa fa-file position-left"></i>'
				},
				initialCaption: "Please select image",
				mainClass: 'input-group'
			});

			// Template modifications
			$('.file-input-advanced').fileinput({
				browseLabel: 'Browse',
				browseClass: 'btn btn-success',
				removeClass: 'btn btn-default',
				uploadClass: 'btn bg-success-400',
				browseIcon: '<i class="fa fa-file-o position-left"></i>',
				uploadIcon: '<i class="fa fa-upload position-left"></i>',
				removeIcon: '<i class="fa fa-close position-left"></i>',
				layoutTemplates: {
					icon: '<i class="fa fa-file position-left"></i>',
					main1: "{preview}\n" +
					"<div class='input-group {class}'>\n" +
					"   <div class='input-group-btn'>\n" +
					"       {browse}\n" +
					"   </div>\n" +
					"   {caption}\n" +
					"   <div class='input-group-btn'>\n" +
					"       {upload}\n" +
					"       {remove}\n" +
					"   </div>\n" +
					"</div>"
				},
				initialCaption: "No file selected"
			});

			// Custom file extensions
			$(".file-input-extensions").fileinput({
				browseLabel: 'Browse',
				browseClass: 'btn btn-primary',
				uploadClass: 'btn btn-default',
				browseIcon: '<i class="fa fa-file-o position-left"></i>',
				uploadIcon: '<i class="fa fa-upload position-left"></i>',
				removeIcon: '<i class="fa fa-close position-left"></i>',
				layoutTemplates: {
					icon: '<i class="fa fa-file position-left"></i>'
				},
				maxFilesNum: 10,
				allowedFileExtensions: ["jpg", "gif", "png", "txt"]
			});		

			// Disable/enable button
			$("#btn-modify").on("click", function() {
				$btn = $(this);
				if ($btn.text() == "Disable file input") {
					$("#file-input-methods").fileinput("disable");
					$btn.html("Enable file input");
					alert("Hurray! I have disabled the input and hidden the upload button.");
				}
				else {
					$("#file-input-methods").fileinput("enable");
					$btn.html("Disable file input");
					alert("Hurray! I have reverted back the input to enabled with the upload button.");
				}
			});


			// AJAX upload
			$(".file-input-ajax").fileinput({
				uploadUrl: "http://localhost", // server upload action
				uploadAsync: true,
				maxFileCount: 5,
				initialPreview: [],
				fileActionSettings: {
					removeIcon: '<i class="icon-bin position-left"></i>',
					removeClass: 'btn btn-link btn-xs btn-icon',
					uploadIcon: '<i class="icon-upload position-left"></i>',
					uploadClass: 'btn btn-link btn-xs btn-icon',
					indicatorNew: '<i class="icon-file-plus text-slate position-left"></i>',
					indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success position-left"></i>',
					indicatorError: '<i class="icon-cross2 text-danger position-left"></i>',
					indicatorLoading: '<i class="icon-spinner2 spinner text-muted position-left"></i>',
				}
			});

		});
	});
</script>