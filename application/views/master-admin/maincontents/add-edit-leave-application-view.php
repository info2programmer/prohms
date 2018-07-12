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
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> Leave Application</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>leave_application">Manage Leave Application</a></li>
            <li class="active"><?php echo $action; ?> Leave Application</li>
          </ul>
        </div>
      </div>
      <!-- /page header --> 
      
      <!-- Content area -->
      <div class="content"> 
        
        <!-- CKEditor default -->
					<div class="panel panel-flat">
						<div class="panel-heading">							
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
                            		<input type="hidden" name="mode" value="tab" />
								  <div class="form-group">
                                    <label class="control-label col-lg-2">Application Subject <span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                      <input type="text" name="application_subject" value="" class="form-control" placeholder="Enter Application Subject">
                                      <?php echo form_error('application_subject'); ?>
                                    </div>
                                  </div>	
                                  <div class="form-group">
                                    <label class="control-label col-lg-2">Enter Application Details<span class="text-danger">*</span></label>
                                    <div class="col-lg-10">
                                      <textarea rows="10" cols="5" name="description" class="form-control" required="required" placeholder="Enter Leave Application Details"></textarea>
                                      <?php echo form_error('description'); ?>
                                    </div>
                                  </div>
                                  

					            	<div class="text-right">
                                    <button type="submit" class="btn btn-primary">Send <i class="icon-arrow-right14 position-right"></i></button>
                                  </div>
				           <?php echo form_close(); ?>
						</div>
					</div>
					<!-- /CKEditor default --> 
        
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