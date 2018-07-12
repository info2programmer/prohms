<div class="banner">


				<!--<div class="container">
                	<div class="row">
                    	<div class="col-lg-12">
                        	<h2 class="text-center text-danger ">WEBSITE IS UNDER CONSTRUCTION </h2>
                        </div>
                    </div>
                </div>-->
            	<div class="container banner_bg">



                	<div class="row">



                    	<div class="col-lg-3 col-md-3 col-xs-12">



                            <ul class="list-unstyled subjects">



                                <li><a href="<?php echo base_url(); ?>front_home/pages/11"><span>Mission &amp; Vision</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages/10"><span>Aims &amp; Objective</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages/13"><span>Principal Desk</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages_contents/52"><span>College Profile</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages_contents/22"><span>Administrative Calendar</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages/16"><span>Academic Calendar</span></a></li>



                                <li><a href=""><span>Activities</span><i class="fa fa-caret-right  pull-right"></i></a>



                                	<ul class="list-unstyled submenu_side">



                                    	<li><a href="<?php echo base_url(); ?>front_home/pages_contents/23">Student Activities</a></li>



                                        <li><a href="<?php echo base_url(); ?>front_home/pages_contents/24">Games &amp; Sports</a></li>



                                        <li><a href="<?php echo base_url(); ?>front_home/pages_contents/25">NSS</a></li>



                                        <li><a href="<?php echo base_url(); ?>front_home/pages_contents/26">Seminar &amp; Workshop</a></li>



                                        <li><a href="<?php echo base_url(); ?>front_home/pages_contents/27">Academic Tour (Excursion)</a></li>



                                        <li><a href="<?php echo base_url(); ?>front_home/pages_contents/28">Other Events</a></li>



                                    </ul>



                                </li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages_contents/29"><span>Feedback</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages_contents/30"><span>College Prospectus</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages_contents/31"><span>College Magazine</span></a></li>



                                <li><a href="<?php echo base_url(); ?>front_home/pages_contents/32"><span>Open University (PG Courses)</span></a></li>



                                <li class="last"><a href="<?php echo base_url(); ?>front_home/pages_contents/33"><span>Student Welfare</span></a></li>



                            </ul>



                		</div>



                        <div class="col-lg-9 col-md-9 col-xs-12">



                  			<section class="main_slider">



                            	<div id="main-slider" class="flexslider">



                                  <ul class="slides">



                                  <?php 



								  $sliders = $this->db->query("select * from td_sliders where published=1")->result();



								  if($sliders) {



									  foreach($sliders as $slider) {



								  ?>



                                    <li>



                                      <img alt="" src="<?php echo base_url(); ?>uploads/slider/<?php echo $slider->slider_image; ?>" class="img-responsive" /> 



                                    </li>



                                 <?php } } ?>   



                                  </ul>



                            </div>



                  			</section>



                        </div>



                    </div>



                </div>



</div>