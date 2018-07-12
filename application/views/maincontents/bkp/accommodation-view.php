<div class="main">
  <div class="document-title">
    <div class="container">
      <h1>PG Accomodation</h1>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.document-title --> 
  
  <!-- /.document-title -->
  
  <div class="container">
    <div class="row">
      <div class="col-sm-9">
              
        
        <div class="row">
        	<?php if($this->session->userdata('username1')) { ?>
            <?php if($this->session->userdata('user_type1')=='P') { ?>
            <a href="<?php echo base_url(); ?>admin/profile/post_add">
        	<div class="col-md-4 col-xs-12">
                <div  class="well" style="min-height:450px; text-align:center;border:1px solid #e9e9e9;">
                <!--<a href="">Post Add</a>-->
                    <p style="font-size:80px; color:#CCCCCC; padding-top:130px;"><i class="fa fa-plus" aria-hidden="true"></i> </p> 
                    <p style="font-size:30px; color:#999999;">Add New Post</p>         
                </div>
          		     
            </div>
            </a>
            <?php }  
			else
			{ ?>
			<a href="<?php echo base_url(); ?>users/login/admin/profile/post_add">
        	<div class="col-md-4 col-xs-12">
                <div  class="well" style="min-height:450px; text-align:center; 1px solid #e9e9e9;">
                <!--<a href="">Post Add</a>-->
                    <p style="font-size:80px; color:#CCCCCC; padding-top:130px;"><i class="fa fa-plus" aria-hidden="true"></i> </p> 
                    <p style="font-size:30px; color:#999999;">Add New Post</p>         
                </div>
          		     
            </div>
            </a>	
			<?php }
			} else { ?>
            <a href="<?php echo base_url(); ?>users/login/admin/profile/post_add">
        	<div class="col-md-4 col-xs-12">
                <div class="well" style="min-height:450px; text-align:center; border:1px solid #e9e9e9;">
                <!--<a href="">Post Add</a>-->
                    <p style="font-size:80px; color:#CCCCCC; padding-top:130px;"><i class="fa fa-plus" aria-hidden="true"></i> </p> 
                    <p style="font-size:30px; color:#999999;">Add New Post</p>         
                </div>
          		     
            </div>
            </a>
            <?php } ?>
            
            <?php
			if($results) { 
			foreach($results as $rs) { 
			?>
            
        	<div class="col-md-4 col-xs-12">
          		<div class="well" style="min-height:450px; border:1px solid #e9e9e9; ">
                	<div class="image_container" >
                	<?php if($rs->post_type=='Paid') { ?>
                	<span style="color:#FFFFFF; padding:1px 4px 1px 4px; background-color:#FF3300;  position:absolute; top:10px;">Premium Post</span>
                    <?php } ?>
                    <?php if($rs->image_publish==1) { ?>
                    <img src="<?php echo base_url(); ?>uploads/post/<?php echo $rs->post_image; ?>" class="img-responsive" style="width:250px; height:190px;" />
                    <?php } else { ?>
                    <img src="<?php echo base_url(); ?>material/admin/no-image.png" class="img-responsive" style="width:200px; height:200px;"/>
                    <?php } ?>
                </div>
                <div class="content">
                	<h3 style="color:#00CC00; font-weight:bold;">INR <?php echo $rs->rent_from; ?>/-</h3>
                    
                    <h4 style="font-size:16px; line-height:18px; text-transform:capitalize;"><?php echo $rs->title; ?></h4>
                    
                    <h5 style="color:#006699; text-transform:capitalize;"><i class="fa fa-user"></i> <?php echo $rs->name; ?> </h5>
                    
                    <h5 style="color:#006699; text-transform:capitalize;"><i class="fa fa-map-marker"></i> <?php echo $rs->area; ?></h5>
               		<?php if($this->session->userdata('username1')) { ?>
                    <?php if($this->session->userdata('user_type1')=='P') { ?>
                    <a href="<?php echo base_url(); ?>front_home/accommodation_details/<?php echo $rs->pg_id; ?>">
                    <button type="button" class="btn btn-success" style="margin-top:10px;" onclick="<?php echo base_url(); ?>admin/profile/post_add">View Details</i></button></a>
                    <?php } 
					else { ?>
                    <a href="<?php echo base_url(); ?>users/login">
                    <button type="button" class="btn btn-success" style="margin-top:10px;">View Details</i></button></a>
					<?php } } else { ?>
                    <a href="<?php echo base_url(); ?>users/login">
                    <button type="button" class="btn btn-success" style="margin-top:10px;" onclick="<?php echo base_url(); ?>users/login">View Details</i></button></a>
                    <?php } ?> 
                </div>
                </div>
            </div>
            <?php }  } ?>
            <!--<div class="col-lg-4" img-thumbnail></div>
            <div class="col-lg-4"></div>-->
        </div>
        
        
        
        
        
        
        
        
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