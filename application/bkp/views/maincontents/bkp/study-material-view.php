<div class="main">
  <div class="document-title">
    <div class="container">
      <h1>Study Material</h1>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.document-title --> 
  
  <!-- /.document-title -->
  
  <div class="container">
    <div class="row">
      <div class="col-sm-9">
        <h2 class="page-header"><strong>Useful Study Materials</strong></h2>        
        
		<form class="form-inline" action="<?php echo base_url(); ?>front_home/study_material" method="post">
        <input type="hidden" name="mode" value="study_material" />
           <div class="form-group" style="width:82%;">
           	<input type="text" class="form-control" placeholder="Enter your tag here" name="tag" style="width:100%;" >
       	   </div>  
           <button type="submit" class="btn btn-success">Submit</button>
         </form>
		<?php
		if($results) { 
		?>
        <div class="candidates-list">
          <?php			
			foreach($results as $rs) {
		  ?>
          <div class="candidates-list-item">
            <div class="candidates-list-item-heading"> 
              <!-- /.candidates-list-item-image -->
              
              <div class="candidates-list-item-title">
                <div class="study_block"><i class="fa fa-book"></i></div>
                <h2><strong>Name of the study material</strong> :: <a target="_blank" href="<?php echo base_url(); ?>uploads/notice/<?php echo $rs->filename; ?>" style="text-decoration:none"><?php echo $rs->title; ?></a></h2>
                <!--<h3><span>Physics</span><span>Exam</span></h3>-->
              </div>
              <!-- /.candidates-list-item-title --> 
            </div>
            <!-- /.candidates-list-item-heading --> 
            
            <!-- /.candidates-list-item-location --> 
            
            <!-- /.candidates-list-item-rating --> 
          </div>
          <!-- /.candidates-list-item -->
          <?php } ?>         
        </div>
        <!-- /.candidates-list -->
        <?php } else { ?>
        <div class="candidates-list">
          <?php
			$Study_Material = $this->db->query("select * from td_notice_tender where role='Study_Material' and published=1")->result(); 
			if($Study_Material) { 
			foreach($Study_Material as $sm) {
		  ?>
          <div class="candidates-list-item">
            <div class="candidates-list-item-heading"> 
              <!-- /.candidates-list-item-image -->
              
              <div class="candidates-list-item-title">
                <div class="study_block"><i class="fa fa-book"></i></div>
                <h2><strong>Name of the study material</strong> :: <a target="_blank" href="<?php echo base_url(); ?>uploads/notice/<?php echo $sm->filename; ?>" style="text-decoration:none"><?php echo $sm->title; ?></a></h2>
                <!--<h3><span>Physics</span><span>Exam</span></h3>-->
              </div>
              <!-- /.candidates-list-item-title --> 
            </div>
            <!-- /.candidates-list-item-heading --> 
            
            <!-- /.candidates-list-item-location --> 
            
            <!-- /.candidates-list-item-rating --> 
          </div>
          <!-- /.candidates-list-item -->
          <?php } } else { ?>
          No study material are available
          <?php } ?>
        </div>
        <?php } ?> 
        
        <!-- /.center --> 
      </div>
      <!-- /.col-* -->
      
      <div class="col-sm-3">
        <div class="filter-stacked"> <img src="<?php echo base_url(); ?>material/assets/img/banner2.jpg" class="img-responsive" /> </div>
        <!-- /.filter-stacked --> 
        
      </div>
      <!-- /.col-* --> 
    </div>
    <!-- /.row --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /.main -->