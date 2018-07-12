<!-- Page header -->

	<div class="page-header">

		<div class="page-header-content">

			<div class="page-title">

				<h4><i class="fa fa-th-large position-left"></i> Manage Subject</h4>

			</div>										

			<ul class="breadcrumb">

				<li><a href="<?php echo base_url(); ?>index.php/admin/user"><i class="fa fa-home"></i>Dashboard</a></li>

				<li><a href="<?php echo base_url(); ?>index.php/admin/manage_subject">Manage Subject</a></li>

				<li class="active"><?php echo $action; ?> Subject</li>

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

						Manage Subject

						</h4>				

					</div>

                    

					<div class="panel-body no-padding-bottom">

						<!--<form class="form-horizontal" action="form_basic.htm#">	-->						

						 <?php 	$attributes = array('class' => 'form-horizontal', 'id' => 'myform');

								echo form_open_multipart('',$attributes); ?>

                                

                             <?php

									if(isset($row))

									{  

										$stream = $row->stream;

										$subject_name = $row->subject_name;

										//$subject_content = $row->subject_content;

									 }

									 else

									 {

										$stream = $this->input->post('stream'); 

										$subject_name = ''; 

										//$subject_content = '';

									 }

									 

									 

									 

							?>                              

                            <input type="hidden" name="mode" value="subject" />

                           

                            <div class="form-group">

								<label class="control-label col-lg-2">Stream Name</label>

								<div class="col-lg-10">

									

                                     <?php 

										$js = 'class="form-control" id=stream';

										echo form_dropdown('stream',$stream_categories,$stream,$js);

										echo form_error('stream'); 

								  ?>

								</div>

							</div>

                            

                            

                            <div class="form-group">

								<label class="control-label col-lg-2">Subject Name</label>

								<div class="col-lg-10">

									

                                    <input type="text" class="form-control" placeholder="Enter Subject Name" name="subject_name" value="<?php if($action == 'Edit'){echo $subject_name;} else {echo set_value('subject_name');} ?>">

                                     <?php echo form_error('subject_name'); ?>

								</div>

							</div>

                            

                          <div class="form-group">
								<label class="control-label col-lg-2">Subject Content</label>
								<div class="col-lg-10">
									<?php if($action == 'Edit') { ?>                    
									<a target="_blank" href="<?php echo base_url();?>uploads/subject_content/<?php echo $row->subject_content;?>"><?php echo base_url();?>uploads/subject_content/<?php echo $row->subject_content;?></a>
                                    <?php }
									echo br(2);
									?>                                
									<input name="slider_image" type="file" class="file-input-custom" data-show-caption="true" data-show-upload="true" accept="image/*">
                                    <?php if($this->session->flashdata('err_message')){ echo $this->session->flashdata('err_message'); } ?>
								</div>
							</div>

                            

                            

                            

                            

                           

                           

							<div class="form-group">

								<label class="control-label col-lg-2"></label>

								<div class="col-lg-10">

									<button type="submit" class="btn btn-danger btn-rounded"><?php echo $action; ?> Subject</button>

								</div>

							</div>

                            

                            							

						<?php echo form_close(); ?>					

					</div>

				</div>

			</div>

			

		</div>

</div>



<script src="<?php echo base_url();?>/assets/admin/js/jquery-1.11.2.min.js"></script>

<?php if($action == 'Edit'){ ?>

<script>

	$(document).ready(function(){

		currurl = window.location.href;

		newurl = currurl.split('edit')[0];

		stateID = <?php echo $state_id; ?>;

		ID = <?php echo $id; ?>;

		/*alert(stateID);*/

		$.ajax({

				type: "POST",

				url: newurl+"ajax_call",

				async: false,

				data: {state:stateID, action:'<?php echo $action; ?>', id:ID,sayantan:'ready'},

				dataType: "html",

				success: function(data) {

                        //data is the html of the page where the request is made.

                        $('#city_id').html(data);

				}

			})

		$("#maincat_id").on('change', function(){

		

			stateID = $(this).val();

			if(stateID == "")

			{

			$("#city_dropdown").hide();	

			}

			$.ajax({

				type: "POST",

				url: newurl+"ajax_call",

				async: false,

				data: {state:stateID, action:'<?php echo $action; ?>',sayantan:'change'},

				dataType: "html",

				success: function(data) {

                        //data is the html of the page where the request is made.

                        $('#city_id').html(data);

				}

			})

		});

	});

</script>

<?php }else if($action == 'Add'){ ?>

<script>

	$(document).ready(function(){

		

		stateID = $(this).val();

			/*if(stateID == "")

			{

			$("#city_dropdown").hide();	

			}*/

			$.ajax({

				type: "POST",

				url: "ajax_call",

				async: false,

				data: {state:stateID, action:'<?php echo $action; ?>'},

				dataType: "html",

				success: function(data) {

                        //data is the html of the page where the request is made.

                        $('#city_id').html(data);

				}

			})

    $("#maincat_id").on('change', function(){

			/*$("#city_dropdown").show();*/

			

			stateID = $(this).val();

			if(stateID == "")

			{

			$("#city_dropdown").hide();	

			}

			$.ajax({

				type: "POST",

				url: "ajax_call",

				async: false,

				data: {state:stateID, action:'<?php echo $action; ?>'},

				dataType: "html",

				success: function(data) {

                        //data is the html of the page where the request is made.

                        $('#city_id').html(data);

				}

			})

    });

});

</script>

<?php } ?>



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





<script type='text/javascript'>

	$(document).ready(function() {		

		$(function() {

			// Defaults

			Dropzone.autoDiscover = false;

			

			// Removable thumbnails

			$("#dropzone_remove").dropzone({

				paramName: "attachment[]", // The name that will be used to transfer the file

				dictDefaultMessage: 'Drop files to upload <span>or CLICK</span>',

				maxFilesize: 1, // MB

				maxFiles: 20,

				addRemoveLinks: true,

				acceptedFiles: ".jpg, .jpeg, .gif, .png",

				thumbnailWidth:"1820",

				thumbnailHeight:"768",

				autoProcessQueue: true,

				init: function() {

					

					

					<?php

					if($action == 'Edit'){

					$mul_imgs = explode(',', $gallery_image);

					

					foreach($mul_imgs as $mul_img) {

					echo "mockFile = { name: '$mul_img', size: 123 };";

					echo "this.options.addedfile.call(this, mockFile);";

					echo "this.options.thumbnail.call(this, mockFile, '".base_url()."uploads/multiple/$mul_img');";

					}

					} 

					?>

					

					/*var mockFile = { name: value.name, size: value.size };

                	thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                	thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "uploads/"+value.name);*/

						

					this.on('success', function(file,json){

						if($("#file_names").val()){$("#file_names").val($("#file_names").val()+","+json.name);} else {$("#file_names").val($("#file_names").val()+json.name);}

						//console.log($("#file_names").val());

						

						

						

						

						

					});

				}

			});	

			$('.select').select2({

				minimumResultsForSearch: Infinity

			});

			$('.add-tabs').click(function(e){

				e.stopPropagation();

				$('.select').select2('destroy');

				$.each($('.select').val(),function(index, element){

					$.ajax({

						url:"<?php echo base_url(); ?>index.php/admin/manage_service/tabname",

						method:"post",

						data:{id:element},

						datatype:'json'

					}).success(function(reply){

						$('#tabs-listing').append('<li style="margin-bottom:20px"><h5>'+reply.name+'</h5><textarea class="ckeditor" name="tab_content'+element+'" id="tab'+element+'" rows="4" cols="4"></textarea></li>');

						CKEDITOR.replace('tab_content'+element+'', {

							height: '400px',

						});

						$(".select option[value='"+element+"']").remove();

					});

				});

				$(".select").val('').select2({

					minimumResultsForSearch: Infinity

				});;

				return false;

			});

			var editor = CKEDITOR.replace('.ckeditor', {

        		height: '400px',

    		});

		});

	});

</script>