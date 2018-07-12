<div class="main">
  <div class="document-title">
    <div class="container">
      <h1 class="center">
	  <?php 
	  $clg_id = $college_name_for_no_data;
	  $college_name = $this->db->query("select * from td_colleges where id='$clg_id'")->row(); 
	  echo $college_name->college_name; 
	  ?></h1>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.document-title --> 
  
  <!-- /.document-title -->
  <?php
  $user_exist = $this->db->query("select * from td_users where college_name='$college_name_for_no_data'")->num_rows();
  $user_detail = $this->db->query("select * from td_users where college_name='$college_name_for_no_data'")->row();
  if($user_exist>0) { 
  ?>
  
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="company-card">
          <div class="company-card-image">
          <?php if($row->college_name) { ?> 
          <img src="<?php echo base_url();?>uploads/college/<?php echo $row->logo_image; ?>" alt="">
          <?php } else { ?>
          <img src="<?php echo base_url();?>material/admin/no-user-image.jpg" alt="">
          <?php } ?> 
          </div>
          <!-- /.company-card-image -->
          
          <div class="company-card-data">
            <dl>
             <?php if($row->college_website!='') { ?>	
              <dt>Website</dt>
              <dd><a target="_blank" href="<?php echo $row->college_website; ?>"><?php echo $row->college_website; ?></a></dd>
              <?php } ?>
              <dt>E-mail</dt>
              <dd><?php echo $row->email; ?></dd>
              <dt>Phone</dt>
              <dd><?php echo $row->phone; ?></dd>
              <dt>Address</dt>
              <dd><?php echo $row->address; ?></dd>
            </dl>
          </div>
          <!-- /.company-card-data --> 
        </div>
        <!-- /.company-card -->
        
        <div class="widget">
          <ul class="social-links">
          <?php $social_details = $this->db->query("select * from td_social where published=1 and college_id='$college_id'")->row(); 
		  //echo '<pre>';print_r($social_details);die;
		  if($social_details) {
		  ?>
          <?php if($social_details->fb_link!='') { ?>
            <li><a target="_blank" href="<?php echo $social_details->fb_link; ?>"><i class="fa fa-facebook"></i></a></li>
          <?php } ?>
          <?php if($social_details->twitter_link!='') { ?>  
            <li><a target="_blank" href="<?php echo $social_details->twitter_link; ?>"><i class="fa fa-twitter"></i></a></li>
          <?php } ?>
          <?php if($social_details->linkedin_link!='') { ?>  
            <li><a target="_blank" href="<?php echo $social_details->linkedin_link; ?>"><i class="fa fa-linkedin"></i></a></li>
          <?php } ?>  
          <?php if($social_details->google_plus_link!='') { ?>  
            <li><a target="_blank" href="<?php echo $social_details->google_plus_link; ?>"><i class="fa fa-google-plus"></i></a></li>
          <?php } ?> 
          <?php } ?> 
          </ul>
        </div>
        <!-- /.widget -->
        
        <!--<div class="widget">
          <h2>Contact Company</h2>
          <form method="get" action="?">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Subject">
            </div>
           
            
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your E-mail">
            </div>
            
            
            <div class="form-group">
              <textarea class="form-control" rows="5" placeholder="Your Message"></textarea>
            </div>
            
            
            <button class="btn btn-secondary pull-right" type="submit">Post Message</button>
          </form>
        </div>-->
        <!-- /.widget --> 
        
        <h3 class="page-header" id="Facilities">Facilities</h3>
        <div class="positions-list">
          	<ul>
            	<?php
				$facilities = $this->db->query("select * from td_college_facility where college_id='$college_id'")->result();
				if($facilities) {
					foreach($facilities as $fc) {
				?>
				<li><?php $f_id = $fc->facility_id; 
				$f_details = $this->db->query("select * from td_facilities where facilities_id='$f_id'")->row();
				echo $f_details->facilities_name;
				?></li>
                <?php } } else { ?>
                <li>No facilities records are available</li>
                <?php } ?>
			</ul>
          
        </div>
        <!-- /.positions-list --> 
        
        
      </div>
      <!-- /.col-* -->
      
      <div class="col-sm-8">
       <!-- <div class="company-header">
          <h2><?php  //echo $college_name->college_name; ?></h2>
        </div>-->
        <!-- /.company-header -->
        
        <div class="company-stats">
          <div class="company-stat"> <span>Rating</span> <strong>
          <?php
		  $rating_details = $this->db->query("SELECT sum(rating) as rating FROM `td_review_ratings` WHERE college_id='$college_id' and published=1")->row();
		  //print_r($rating_details);die;
		  $no_of_reviews = $this->db->query("SELECT * FROM `td_review_ratings` WHERE college_id='$college_id' and published=1")->num_rows();
		  
		  if($rating_details) { 
		  if($no_of_reviews!=0)
		  {
		  echo $rating_details->rating/$no_of_reviews;
		  } }
		  ?>
          </strong> </div>
          <!-- /.company-stat -->
          
          <div class="company-stat"> <span>Reviews</span> <strong><?php echo $no_of_reviews; ?></strong> </div>
          <!-- /.company-stat -->
          
          <div class="company-stat"> <span>Establishment Year</span> <strong><?php if($row->college_establish) { $row->college_establish ; }  ?></strong> </div>
          <!-- /.company-stat --> 
        </div>
        <!-- /.company-stat -->
        
        <h3 class="page-header">College Profile</h3>
        <p><?php echo $row->college_description; ?> </p>
        
        <div class="btn-box" >
        	<a href="#Placement" class="btn btn-secondary">Placement</a> 
            <a href="#Department" class="btn btn-default">Department</a> 
            <a href="#Gallery" class="btn btn-default">Gallery</a> 
            <a href="#Awards" class="btn btn-default">Awards</a>
            <a href="#Recruiters" class="btn btn-default">Our Recruiters</a>
            <a href="#Reviews" class="btn btn-default">Reviews</a>
            <a href="#Message" class="btn btn-default">Message</a>
        </div>
        
        
        <h3 class="page-header" id="Placement">Placement</h3>
        <?php
		$curr_year = date("Y");
		$to_year = $curr_year - 3;
		
		$placement_details = $this->db->query("select * from td_placement where published=1 and college_id='$college_id' and year>='$to_year' and year<='$curr_year' order by year desc")->result();
		
		?>        
        <div class="positions-list">          
          <?php
		  if($placement_details) { 
		  foreach($placement_details as $placement) {
		  ?>
          <h6>Year <?php echo $placement->year; ?></h6>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width:70%;">Company Name</th>
                <th style="width:30%;">Intake</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $placement->company_name; ?></td>
                <td><?php echo $placement->number_of_intake; ?></td>
              </tr>              
            </tbody>
          </table>
         <?php } } else { ?>
         <table class="table table-bordered">
            <tbody>
              <tr>
                <td colspan="2">No placement records are found</td>
              </tr>              
            </tbody>
          </table>
         <?php } ?> 
          
        </div>
        
        <h3 class="page-header" id="Department">Department</h3>
        <div class="positions-list">
          
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width:70%;">Department Name</th>
                <th style="width:30%;">Intake</th>
                <!--<th style="width:35%;">Company Name</th>
                <th style="width:15%;">Intake</th>-->
              </tr>
            </thead>
            <tbody>
            <?php
			$department_details = $this->db->query("select td_department.*,discipline.discipline_name from td_department inner join discipline on discipline.discipline_id=td_department.discipline_id where td_department.published=1 and td_department.college_id='$college_id'")->result();
			if($department_details) {
				foreach($department_details as $department) {
			?>            
              <tr>
                <td><?php echo $department->discipline_name; ?></td>
                <td><?php echo $department->intake; ?></td>
              </tr>
            <?php }  } else { ?>
            <tr>
               <td colspan="2">No departmental recrds are found.</td>
             </tr>
            <?php } ?>  
            </tbody>            
          </table>
          
         
          
        </div>
        
        <h3 class="page-header" id="Gallery">Gallery</h3>
        <div class="positions-list">
        <div class="row">
        <?php
			$gallerys = $this->db->query("select * from td_gallery where college_id='$college_id' and published=1")->row();
			if($gallerys) {
			$gal_image = explode(",", $gallerys->gallery_image);
			//echo '<pre>';print_r($gal_image);die;
						
		?>
          <?php if($gal_image[0]) { ?>	
          <div class="col-lg-3"><a class="fancybox" href="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[0]; ?>" data-fancybox-group="gallery"><img src="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[0]; ?>" alt="" class="img-responsive" /></a></div>
          <?php } ?>
          <?php if($gal_image[1]) { ?>	
          <div class="col-lg-3"><a class="fancybox" href="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[1]; ?>" data-fancybox-group="gallery"><img src="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[1]; ?>" alt="" class="img-responsive" /></a></div>
          <?php } ?>
          <?php if($gal_image[2]) { ?>	
          <div class="col-lg-3"><a class="fancybox" href="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[2]; ?>" data-fancybox-group="gallery"><img src="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[2]; ?>" alt="" class="img-responsive" /></a></div>
          <?php } ?>
          <?php if($gal_image[3]) { ?>	
          <div class="col-lg-3"><a class="fancybox" href="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[3]; ?>" data-fancybox-group="gallery"><img src="<?php echo base_url(); ?>uploads/gallery/<?php echo $gal_image[3]; ?>" alt="" class="img-responsive" /></a></div>
          <?php } ?>
          <?php }  else { ?>
          No gallery images are available
          <?php } ?>
          </div>
        </div>
        
        <h3 class="page-header" id="Awards">Awards</h3>
        <div class="positions-list">
          	<ul>
            	<?php
				$awards = $this->db->query("select * from td_awards where college_id='$college_id' and published=1")->result();
				if($awards) {
					foreach($awards as $aw) {
				?>
				<li><?php echo $aw->award_description; ?></li>
                <?php } } else { ?>
                <li>No awards records are available</li>
                <?php } ?>
			</ul>
          
        </div>
        <!-- /.positions-list --> 
        <h3 class="page-header" id="Recruiters">Our Recruiters</h3>
        <div class="positions-list">
          	<div class="list_carousel">
          <ul id="foo4">
          <?php
		  $colleges_logo = $this->db->query("select * from td_recruiters where college_id='$college_id' and published=1")->result();
		  //print_r($colleges_logo);die;
		  if($colleges_logo) { 
		  foreach($colleges_logo as $row1) { 
		  ?>
            <li> <img src="<?php echo base_url(); ?>uploads/recruiter/<?php echo $row1->recruiter; ?>" alt="" class="img-responsive">
              
            </li>
          <?php } } else { ?>
          No recruiters found
          <?php } ?>  
          </ul>
          <div class="clearfix"></div>
        </div>
        </div>
        
        <h3 class="page-header" id="Reviews">Reviews</h3>

        <div class="positions-list">
            <?php
			$review_details = $this->db->query("select * from td_review_ratings where college_id='$college_id' and published=1")->result();
			if($review_details) {
				foreach($review_details as $review) {  
			?>
                <div class="positions-list-item">
                    <h2><?php echo $review->name; ?></h2>
                    <h3><span><?php echo $review->review_content; ?></span></h3>
                    <div class="position-list-item-date"><?php echo date_format(date_create($review->review_date), "d-m-Y"); ?></div><!-- /.position-list-item-date -->
                    <div class="position-list-item-action product-rating">
                    <?php 
						for($i=1;$i<=$review->rating;$i++)
						{
							echo '<i class="fa fa-star"></i>';
						}
						if (strpos($review->rating, '.5') !== false) {echo '<i class="fa fa-star-half-o"></i>';}
					?>
                    </div><!-- /.position-list-item-action -->
                </div><!-- /.positions-list-item -->
			   <?php } } else { ?>
               <h5>No reviews yet</h5>
               <?php } ?>     
                <?php if($this->session->userdata('user_type1')=='S') { 
				$username = $this->session->userdata('username1');
				$users = $this->db->query("select * from td_users where username='$username' and published=1")->row();
				?>
                <form role="form" method="post" action="<?php echo base_url();?>front_home/review">
                <input type="hidden" name="mode" value="review">
                <input type="hidden" name="collge_id" value="<?php echo $user_detail->id; ?>">
                <input type="hidden" name="college_category" value="<?php echo $user_detail->college_cat; ?>">     
                <input type="hidden" id="Name" class="form-control" placeholder="Name" required name="txt_name" value="<?php echo $users->student_name; ?>">
                <input type="hidden" id="Email" class="form-control" placeholder="Email" required name="txt_email" value="<?php echo $users->email; ?>">
               
                <div class="form-group">
                    <label for="input-rating">Rating</label>
                    <div class="clearfix"></div>
                    <div class="input-rating" id="input-rating"></div>
                  </div>
                <div class="form-group">
                    <label for="Review">Your Review</label>
                    <textarea id="Review" class="form-control" rows="5" placeholder="Your Review" required name="txt_desc"></textarea>
                  </div>
                <button type="submit" class="btn btn-sm">Submit Review</button>
              </form>
				<?php } else { ?>              
              	<h4>To give review <a href="<?php echo base_url(); ?>users/login/front_home/colleges/<?php  echo $college_name->id; ?>/<?php  echo $college_name->college_category; ?>" style="text-decoration:none">Login</a> First</h4>
                <?php } ?>            
            </div><!-- /.positions-list -->
            
            
        <h3 class="page-header" id="Message">Message</h3>
		<span style="color:#00CC00;">
        	<?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?>
        </span>
        <span style="color:#F00">
        	<?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('success_message'); } ?>
        </span>
        <div class="positions-list">                 
                <?php if($this->session->userdata('user_type1')=='S') { 
				$username = $this->session->userdata('username1');
				$users = $this->db->query("select * from td_users where username='$username' and published=1")->row();
				?>
                <form role="form" method="post" action="<?php echo base_url();?>front_home/message">
                <input type="hidden" name="mode" value="review">
                <input type="hidden" name="college_id" value="<?php echo $user_detail->id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $users->id; ?>"> 
                <input type="hidden" name="from_msg" value="<?php echo $users->id; ?>">
                <input type="hidden" name="to_msg" value="<?php echo $user_detail->id; ?>">    
                <input type="hidden" id="Name" class="form-control" placeholder="Name" required name="txt_name" value="<?php echo $users->student_name; ?>">            
                	<div class="form-group">
                    	<label for="Review">Subject</label>
                        <input type="text" class="form-control" placeholder="Type your message subject here" name="subject" required="required" />
                  	</div>
                  	<div class="form-group">
                    	<label for="Review">Your Message</label>
                    	<textarea id="Review" class="form-control" rows="5" placeholder="Type your message here" required name="txt_desc"></textarea>
                  	</div>
                <button type="submit" class="btn btn-sm">Submit Message</button>
              </form>
				<?php } else { ?>              
              	<h4>To send message please <a href="<?php echo base_url(); ?>users/login/front_home/colleges/<?php  echo $college_name->id; ?>/<?php  echo $college_name->college_category; ?>" style="text-decoration:none">Login</a> First</h4>
                <?php } ?>            
            </div><!-- /.positions-list -->    
            
            
      </div>
      <!-- /.col-sm-8 --> 
    </div>
    <!-- /.row --> 
  </div>
 
  <?php } else { ?>
  <div align="center">No informations are available</div>
  <?php } ?>
  <!-- /.container --> 
</div>
<!-- /.main -->