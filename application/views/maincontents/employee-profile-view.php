<!-- Page header -->
<style>
.li_border li{border-bottom: 1px solid #ccc;}
</style>
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i>  Team Member <span class="text-semibold">Profile</span></h4>
    </div>
    <!--<div class="heading-elements">
      <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
    </div>-->
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active">Team Member Profile</li>
    </ul>
    <!--<ul class="breadcrumb-elements">
      <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-gear position-left"></i> Settings <span class="caret"></span> </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
          <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
          <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
        </ul>
      </li>
    </ul>-->
  </div>
</div>
<!-- /page header --> 

<!-- Content area -->
<div class="content">

					<!-- User profile -->
					<div class="row">
						<div class="col-lg-12">
							<div class="tabbable">
								<div class="tab-content">
									<div class="tab-pane fade in active" id="activity">

										<!-- Timeline -->
										<div class="timeline timeline-left content-group">
											<div class="timeline-container">



												<!-- Blog post -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<img src="<?php echo base_url().'uploads/employee/'.$rows->profile_image?>" alt="">
													</div>

													<div class="panel panel-flat timeline-content">
														<div class="panel-heading">
															<h6 class="panel-title"><?php echo $rows->salutation." ".$rows->emp_name;?></h6>
														</div>

														<div class="panel-body">
															<a href="#" class="display-block content-group">
																<img src="<?php echo base_url().'uploads/employee/'.$rows->profile_image?>" class="img-responsive content-group" alt="" style="max-width:150px;">
															</a>

															<h6 class="content-group">
																<?php echo $rows->department_name;?> <strong><?php echo $rows->designation_name;?></strong> : <?php echo $rows->emp_code?>
															</h6>

															<blockquote>
																<p>Email Address: <?php echo $rows->email;?></p>
                                                                <p>Premanent Address: <?php echo $rows->permanent_address;?></p>
															</blockquote>
														</div>
													</div>
												</div>
												<!-- /blog post -->



												<!-- Invoices -->
												<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-warning-400">
															<i class="icon-cash3"></i>
														</div>
													</div>

													<div class="row">
														<div class="col-lg-6">
															<div class="panel border-left-lg border-left-danger invoice-grid timeline-content">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-sm-12">
																			<h6 class="text-semibold no-margin-top"><i class="fa fa-info" aria-hidden="true"></i> Personal Details</h6>
																			<ul class="list list-unstyled li_border">
																				<li><span class="text-semibold">Gender:</span> <?php echo $rows->gender;?></li>
																				<li><span class="text-semibold">Father's Name:</span> <?php echo $rows->father_name;?></li>
                                                                                <li><span class="text-semibold">DOB:</span> <?php echo $rows->dob;?></li>
                                                                                <li><span class="text-semibold">Email:</span> <?php echo $rows->personal_email;?></li>
                                                                                <li><span class="text-semibold">Phone:</span> <?php echo $rows->phone;?></li>
                                                                                <li><span class="text-semibold">Mobile:</span> <?php echo $rows->mobile;?></li>
                                                                                <li><span class="text-semibold">Present Address:</span> <?php echo $rows->present_address;?></li>
                                                                                <li><span class="text-semibold">Permanent Address:</span> <?php echo $rows->permanent_address;?></li>
                                                                                <li><span class="text-semibold">Blood Group:</span><?php echo $rows->blood_group;?></li>
                                                                                <li><span class="text-semibold">Voter ID :</span> <?php echo $rows->votar_no;?></li>
                                                                                <li><span class="text-semibold">PAN No:</span> <?php echo $rows->pan_no;?></li>
                                                                                <li><span class="text-semibold">Passport No:</span> <?php echo $rows->passport_no;?></li>
                                                                                <li><span class="text-semibold">Passport Expiry:</span> <?php echo $rows->passport_expiry;?></li>
                                                                                <li><span class="text-semibold">Aadhar No:</span> <?php echo $rows->aadhar_no;?></li>
                                                                                <li><span class="text-semibold">Marital Status:</span> <?php echo $rows->marital_status;?></li>
                                                                                <?php if($rows->marital_status=='Married'){?>
                                                                                <li><span class="text-semibold">Spouse Name:</span> <?php echo $rows->spouse_name;?></li>
                                                                                <?php }?>
                                                                                <?php if($rows->payment_mode=='Transfer') { ?>
                                                                                <li><span class="text-semibold">Bank Name:</span> <?php echo $rows->bank_name;?></li>
                                                                                <li><span class="text-semibold">Bank Account No:</span> <?php echo $rows->bank_acc_no;?></li>
                                                                                <li><span class="text-semibold">Bank Account Holder Name:</span> <?php echo $rows->bank_acc_holder_name;?></li>
                                                                                <li><span class="text-semibold">Bank IFSC Code:</span> <?php echo $rows->bank_ifsc_code;?></li>
                                                                                <?php } ?>
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>

														<div class="col-lg-6">
															<div class="panel border-left-lg border-left-success invoice-grid timeline-content">
																<div class="panel-body">
																	<div class="row">
																		<div class="col-sm-12">
																			<h6 class="text-semibold no-margin-top"><i class="fa fa-briefcase" aria-hidden="true"></i> Office Details</h6>
																			<ul class="list list-unstyled li_border">
                                                                            	<li><span class="text-semibold">Official email:</span> <?php echo $rows->email;?></li>
																				<li><span class="text-semibold">Joining Date:</span> <?php echo $rows->joining_date;?></li>
																				<li><span class="text-semibold">Confirmation Period:</span> <?php echo $rows->confirmation_period;?></li>
                                                                                <li><span class="text-semibold">Emp Type:</span> <?php echo $rows->emp_type;?></li>
                                                                                <li><span class="text-semibold">Payment Mode:</span> <?php echo $rows->payment_mode;?></li>
                                                                                <li><span class="text-semibold">Location:</span> <?php 
$branch = $this->db->query("select * from td_company_location where loc_id='$rows->location'")->row();																				
																				echo $branch->loc_name;?></li>
                                                                                <li><span class="text-semibold">Increment Date:</span> <?php echo $rows->increment_date;?></li>
                                                                                <li><span class="text-semibold">Resignation Date:</span> <?php echo $rows->resignation_date;?></li>
                                                                                <li><span class="text-semibold">Last Working Date:</span> <?php echo $rows->last_working_date;?></li>
                                                                                <li><span class="text-semibold">PF No:</span> <?php echo $rows->pf_no;?></li>
                                                                                <li><span class="text-semibold">EPF No :</span> <?php echo $rows->epf_no;?></li>
                                                                                <li><span class="text-semibold">PF Enrollment Date:</span> <?php echo $rows->pf_enrollment_date;?></li>    
                                                                                <li><span class="text-semibold">ESI no:</span> <?php echo $rows->esi_no;?></li>
                                                                                <li><span class="text-semibold">ESI Date:</span> <?php echo $rows->esi_date;?></li>
                                                                                
                                                                                <li><span class="text-semibold">Username:</span> <?php echo $rows->username;?></li>
                                                                                <li><span class="text-semibold">Password:</span> <?php echo $rows->password;?></li>
                                                                                
																			</ul>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- /invoices -->


												<!-- Messages -->
												<!--<div class="timeline-row">
													<div class="timeline-icon">
														<div class="bg-info-400">
															<i class="icon-comment-discussion"></i>
														</div>
													</div>

													<div class="panel panel-flat timeline-content">
														<div class="panel-heading">
															<h6 class="panel-title">Performance Record</h6>
														</div>

														<div class="panel-body">
															<ul class="media-list chat-list content-group" style="overflow: inherit;">
                                                             <?php 
															 if($rows_pfm){ 
															    $i=1;
															    foreach($rows_pfm as $row_pfm)
																   {
																   $x=($i++)%2;
															     ?>
																<li class="media <?php if($x==0){?>reversed<?php }?>">
																	<div class="media-body">
																		<div class="media-content">
                                                                        <?php echo '<strong>Total '.$row_pfm->sale_total.'</strong>';?><br>
																		<?php echo $row_pfm->sale_details;?><br>
																		<?php echo $row_pfm->sale_amount;?><br>
                                                                        <?php echo $row_pfm->sale_note;?>
                                                                        </div>
																		<span class="media-annotation display-block mt-10">From <?php echo $row_pfm->from_date;?> To <?php echo $row_pfm->to_date;?></span>
																	</div>
																</li>
                                                                <?php }}?>
															</ul>
														</div>
													</div>
												</div>-->
												<!-- /messages -->


											</div>
									    </div>
									    <!-- /timeline -->

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /user profile -->


					<!-- Footer -->
					<div class="footer text-muted"> 
					  <?php echo $footer; ?>
                    </div>
					<!-- /footer -->

				</div>
<!-- /content area -->