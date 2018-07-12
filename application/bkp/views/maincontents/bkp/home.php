<div class="main">
  <div class="hero-content">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-6">
          <div class="hero-content-carousel">
            <h2><i class="fa fa-search"></i> &nbsp;Find your College Details</h2>
            <form class = "form-horizontal advance-search" role = "form" action="<?php echo base_url(); ?>front_home/college_details" method="post">
              <div class = "form-group">
                <label for="form-register-username">Type of the College</label>
                <!--<input type = "text" class = "form-control" placeholder = "Text input">-->
                <select class = "form-control" name="college_cat" id="college_cat" required>
                  <option value="" selected="selected" hidden>Select College Category</option>
                  <option value="BTech">B. Tech</option>
                  <option value="Diploma">Diploma</option>
                </select>
              </div>
              <div class = "form-group">
                <label for="form-register-username">Name of the College</label>
                <div id="city_id"></div>
                <select class="form-control" name="college" id="city_dropdown" required>
                	<option value="" selected="selected" hidden>Select College Name</option>
                </select>
              </div>
              <div class = "form-group">
                <button type ="submit" class = "btn btn-secondary btn-block">Advance Search</button>
              </div>
            </form>
          </div>
        </div>
        <!-- /.col-* -->
        
        <div class="col-sm-6 col-md-6">
          <div class="row">
           <div class="col-md-12" style="float:right; text-align:right; margin-right:-10px;">
            <div class="col-md-4 col-xs-4" > <a href="<?php echo base_url(); ?>users/registration#college"> <img src="<?php echo base_url(); ?>material/assets/img/college_reg.png" class="img-responsive"/> </a> </div>
            <div class="col-md-4 col-xs-4" > <a href="<?php echo base_url(); ?>users/registration#student"> <img src="<?php echo base_url(); ?>material/assets/img/stud_reg.png" class="img-responsive"/> </a> </div>
            <div class="col-md-4 col-xs-4" > <a href="<?php echo base_url(); ?>users/registration#pg"> <img src="<?php echo base_url(); ?>material/assets/img/pg_reg.png" class="img-responsive"/> </a> </div>
            </div>
            
          </div>
        </div>
        <!-- /.col-* --> 
      </div>
      <!-- /.row --> 
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.hero-content -->
  
  <div class="back_ground">
    <div class="container"> 
      <!-- /.filter -->
      
      <div class="topcollege">
        <div class="row">
          <div class="col-sm-6">
            <div class="page_heading"><i class="fa fa-university"></i>
              <h4>Top 10 B-Tech Colleges</h4>
            </div>
            <div class="companies-list">
            <?php
			$degree_college_details = $this->db->query("SELECT COUNT(*) AS number_of_reviews,AVG(rating) as avg_rating,college_id FROM `td_review_ratings` WHERE published=1 AND college_category='BTech' group BY college_id HAVING COUNT(*)>0 order BY avg_rating DESC")->result();
			//echo '<pre>';print_r($degree_college_details);die;
			if($degree_college_details) { 
			$i=1;
			foreach($degree_college_details as $degree) {
			?>
              <div class="companies-list-item">
                <div class="companies-list-item-image"> <a href=""> <img src="<?php echo base_url(); ?>material/assets/img/tmp/<?php echo $i++; ?>.jpg" alt=""> </a> </div>
                <!-- /.companies-list-item-image -->
                
                <div class="companies-list-item-heading">
                <?php 
				$degree_clg = $degree->college_id;
				$degree_users = $this->db->query("select * from td_users where id='$degree_clg'")->row();				
				?>
                  <h2><a href="<?php echo base_url(); ?>front_home/colleges/<?php echo $degree_users->college_name; ?>/<?php echo $degree_users->	college_cat; ?>">
                  <?php  
				  $user_details1 = $this->db->query("select * from td_users where id='$degree_clg'")->row();
				  $degree_c_details = $this->db->query("select * from td_colleges where id='$user_details1->college_name'")->row();
				  echo $degree_c_details->college_name;
				  ?>
                  </a></h2>
                  <h3>Number Of Reviews (<?php echo $degree->number_of_reviews; ?>)</h3>
                </div>
                <!-- /.companies-list-item-heading -->
                
                <div class="companies-list-item-count"><?php echo (float)$degree->avg_rating; ?> Ratings </div>
                <!-- /.positions-list-item-count --> 
                
              </div>
              <!-- /.companies-list-item -->
            <?php } } ?> 
            </div>
            <!-- /.companies-list --> 
          </div>
          <!-- /.col-* -->
          
          <div class="col-sm-6">
            <div class="page_heading"><i class="fa fa-university"></i>
              <h4>Top 10 Diploma Colleges</h4>
            </div>
            <div class="companies-list">
            <?php
			$diploma_college_details = $this->db->query("SELECT COUNT(*) AS number_of_reviews,AVG(rating) as avg_rating,college_id FROM `td_review_ratings` WHERE published=1 AND college_category='Diploma' group BY college_id HAVING COUNT(*)>0 order BY avg_rating DESC")->result();
			//echo '<pre>';print_r($degree_college_details);die;
			if($diploma_college_details) { 
			$j=1;
			foreach($diploma_college_details as $diploma) {
			?>
              <div class="companies-list-item">
                <div class="companies-list-item-image"> <a href=""> <img src="<?php echo base_url(); ?>material/assets/img/tmp/<?php echo $j++; ?>.jpg" alt=""> </a> </div>
                <!-- /.companies-list-item-image -->
                
                <div class="companies-list-item-heading">
                  <h2><a href="">
                  <?php $diploma_clg = $diploma->college_id; 
				  $user_details2 = $this->db->query("select * from td_users where id='$diploma_clg'")->row();
				  $diploma_c_details = $this->db->query("select * from td_colleges where id='$user_details2->college_name'")->row();
				  echo $diploma_c_details->college_name;
				  ?>
                  </a></h2>
                  <h3>Number Of Reviews (<?php echo $diploma->number_of_reviews; ?>)</h3>
                </div>
                <!-- /.companies-list-item-heading -->
                
                <div class="companies-list-item-count"><?php echo (float)$diploma->avg_rating; ?> Ratings </div>
                <!-- /.positions-list-item-count --> 
                
              </div>
              <!-- /.companies-list-item -->
            <?php } } ?> 
            </div>
            <!-- /.companies-list --> 
          </div>
          <!-- /.col-* --> 
          
        </div>
        <!-- /.row --> 
      </div>
      <div class="block background-secondary fullwidth candidate-title">
        <div class="page-title">
          <h2 style="color:#333333; font-size:60px;">Students' Zone</h2>
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
             <!-- <p>Donec tincidunt felis quam, eu tempus purus finibus in. Curabitur hendrerit, odio in viverra interdum, lorem velit scelerisque ipsum, a sagittis ligula leo in dolor. Etiam vestibulum.</p>-->
            </div>
            <!-- /.col-* --> 
          </div>
          <!-- /.row --> 
        </div>
        <!-- /.page-title --> 
      </div>
      <!-- /.fullwidth -->
      
      <div class="row mt-60">
        <div class="candidate-boxes">
          <div class="col-sm-3 col-md-2">
            <div class="candidate-box">
              <div class="candidate-box-image"> <a href="<?php echo base_url(); ?>front_home/study_material"> <img src="<?php echo base_url(); ?>material/assets/img/studymat.jpg" > </a> </div>
              <!-- /.candidate-box-image -->
              
              <div class="candidate-box-content">
                <h2>Usefull Study Material</h2>
              </div>
              <!-- /.candidate-box-content --> 
            </div>
            <!-- /.candidate-box --> 
          </div>
          <!-- /.col-* -->
          
          <div class="col-sm-3 col-md-2">
            <div class="candidate-box">
              <div class="candidate-box-image"> <a href="<?php echo base_url(); ?>front_home/coaching_information"> <img src="<?php echo base_url(); ?>material/assets/img/courseinfo.jpg" > </a> </div>
              <!-- /.candidate-box-image -->
              
              <div class="candidate-box-content">
                <h2>Coaching Information</h2>
              </div>
              <!-- /.candidate-box-content --> 
            </div>
            <!-- /.candidate-box --> 
          </div>
          <!-- /.col-* -->
          
          <div class="col-sm-3 col-md-2">
            <div class="candidate-box">
              <div class="candidate-box-image"> <a href="<?php echo base_url(); ?>front_home/previous_year_questions"> <img src="<?php echo base_url(); ?>material/assets/img/prevquestion.jpg" > </a> </div>
              <!-- /.candidate-box-image -->
              
              <div class="candidate-box-content">
                <h2>Previous Year Questions</h2>
              </div>
              <!-- /.candidate-box-content --> 
            </div>
            <!-- /.candidate-box --> 
          </div>
          <!-- /.col-* -->
          
          <div class="col-sm-3 col-md-2">
            <div class="candidate-box">
              <div class="candidate-box-image"> <a href="<?php echo base_url(); ?>front_home/placement_papers"> <img src="<?php echo base_url(); ?>material/assets/img/placementpaper.jpg" > </a> </div>
              <!-- /.candidate-box-image -->
              
              <div class="candidate-box-content">
                <h2>Placement Papers</h2>
              </div>
              <!-- /.candidate-box-content --> 
            </div>
            <!-- /.candidate-box --> 
          </div>
          <!-- /.col-* -->
          
          <div class="col-sm-3 col-md-2">
            <div class="candidate-box">
              <div class="candidate-box-image"> <a href=""> <img src="<?php echo base_url(); ?>material/assets/img/jobs.jpg" > </a> </div>
              <!-- /.candidate-box-image -->
              
              <div class="candidate-box-content">
                <h2>Contests</h2>
              </div>
              <!-- /.candidate-box-content --> 
            </div>
            <!-- /.candidate-box --> 
          </div>
          <!-- /.col-* -->
          
          <div class="col-sm-3 col-md-2">
            <div class="candidate-box">
              <div class="candidate-box-image"> <a href="<?php echo base_url(); ?>front_home/accommodation"> <img src="<?php echo base_url(); ?>material/assets/img/pg.jpg"> </a> </div>
              <!-- /.candidate-box-image -->
              
              <div class="candidate-box-content">
                <h2>PG Accomodation</h2>
              </div>
              <!-- /.candidate-box-content --> 
            </div>
            <!-- /.candidate-box --> 
          </div>
          <!-- /.col-* --> 
          
        </div>
        <!-- /.candidate-boxes --> 
      </div>
      <!-- /.row -->
      
      <div class="page-title">
        <h2>Forum</h2>
      </div>
      <!-- /.page-title -->
      
      <div class="posts">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <div class="forum_list post-box">
              <h4 class="solid-tittle"><i class="fa fa-comments-o"></i>&nbsp;&nbsp;&nbsp;Forum </h4>
              <ul class="list-unstyled">
              <?php
			  $forum_thread_list = $this->db->query("select * from td_forum_thread where published=1 order by thread_id desc limit 13")->result();
			  if($forum_thread_list) { 	
			  foreach($forum_thread_list as $forum) { 
			  ?>
                <li> <a href="<?php echo base_url(); ?>front_home/forum_thread/<?php echo $forum->thread_id; ?>"><?php echo $forum->thread_title; ?></a> </li>
              <?php }  } else { ?>
              No thread found...
              <?php } ?>  
              </ul>
            </div>
          </div>
          <div class="col-sm-12 col-md-6">
            <div class="post-box">
              <h4 class="solid-tittle"><i class="fa fa-pencil-square-o"></i>&nbsp;&nbsp;&nbsp;Ask Your Question</h4>
              <form class = "form-horizontal advance-search" role = "form">
               
                <div class = "form-group">
                  <label for = "name">Main Category</label>
                  <select class = "form-control">
                    <option>Choose Service One</option>
                    <option>Choose Service Two</option>
                    <option>Choose Service Three</option>
                  </select>
                </div>
                
                 <div class = "form-group">
                  <label for = "name">Sub Category</label>
                  <select class = "form-control">
                    <option>Choose Service One</option>
                    <option>Choose Service Two</option>
                    <option>Choose Service Three</option>
                  </select>
                </div>
                
                 <div class = "form-group">
                  <label for = "name">Subject</label>
                  <input type = "text" class = "form-control" placeholder = "Text input">
                </div>
                
                <div class = "form-group">
                  <label for = "name">Your Message</label>
                  <textarea name="" cols="" rows="5" class="form-control" style="min-height:150px; max-height:150px; min-width:522px; max-width:522px;"></textarea>
                </div>
                
                <div class = "form-group">
                  <button type ="submit" class = "btn btn-secondary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.post-box --> 
          </div>
          <!-- /.col-sm-6 --> 
        </div>
        <!-- /.row --> 
      </div>
      <!-- /.posts-->
      
      <div class="partners"> 
        <!--<a href="#">
        <img src="assets/img/tmp/partner-1.jpg" alt="">
    </a>

    <a href="#">
        <img src="assets/img/tmp/partner-2.jpg" alt="">
    </a>

    <a href="#">
        <img src="assets/img/tmp/partner-3.jpg" alt="">
    </a>

    <a href="#">
        <img src="assets/img/tmp/partner-4.jpg" alt="">
    </a>

    <a href="#">
        <img src="assets/img/tmp/partner-5.jpg" alt="">
    </a>-->
        
        <div class="list_carousel">
          <ul id="foo4">
          <?php
		  $colleges_logo = $this->db->query("select * from td_users where user_type='C' and published=1")->result();
		  if($colleges_logo) { 
		  foreach($colleges_logo as $row1) { 
		  ?>
            <li> <img src="<?php echo base_url(); ?>uploads/college/<?php echo $row1->logo_image; ?>" alt="">
              <p><?php $college_id = $row1->college_name; 
			  $college_details = $this->db->query("select * from td_colleges where id='$college_id'")->row();
			  echo $college_details->college_name;
			  ?></p>
            </li>
          <?php } } ?>  
          </ul>
          <div class="clearfix"></div>
        </div>
      </div>
      <!-- /.partners --> 
      
    </div>
    <!-- /.container --> 
  </div>
</div>
<!-- /.main --> 
   