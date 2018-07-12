<div class="main">
  <div class="document-title">
    <div class="container">
      <h1><?php echo $result->title; ?></h1>
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.document-title --> 
  
  <!-- /.document-title -->
  
  <div class="container">
    <div class="row">
      <div class="col-sm-9">
              
        
        <div class="row">
        	
        	<div class="col-md-6 col-xs-12 well" style="border-radius:0px; min-height:440px;">
            <?php if($result->post_type=='Paid') { ?>
            <span style="color:#FFFFFF; padding:2px 4px 2px 4px; background-color:#FF3300;  position:absolute; top:10px;">Premium Post</span>
            <?php } ?>
             <?php if($result->image_publish==1) { ?>
            <img src="<?php echo base_url(); ?>uploads/post/<?php echo $result->post_image; ?>" class="img-responsive" style="height:400px; width:400px;"/> 
            <?php } else { ?>
            <img src="<?php echo base_url(); ?>material/admin/no-image.png" class="img-responsive" style="width:400px; height:400px;"/>
            <?php } ?>
            <span style="color:#000; padding:4px 0px 4px 0px; opacity:0.5;  position:absolute; top:320px; left: 320px; text-align:center; width:92%;"> <img src="<?php echo base_url(); ?>material/assets/img/watermark_logo.png" class="img-responsive" /></span>
            </div>
            
            <div class="col-md-6 col-xs-12 well" style="border-radius:0px; min-height:440px;">
            <p style="font-size:18px; color:#009900; font-weight:bold; text-transform:capitalize;"><?php echo $result->title; ?></p>
            <p style="text-transform:capitalize;"><strong>Area :</strong> <?php echo $result->area; ?></p>
            
            <p style="text-transform:capitalize;"><strong>Location :</strong> 
			<?php if($result->post_type=='Paid') { ?>
			<?php echo $result->location; ?>
            <?php } else { ?>
            <span style="color:#F00;">Not available in free post</span> 
            <?php } ?> 
            </p>
           
            <p><strong>Pincode :</strong> 700016 | <strong>Occupancy :</strong> <?php echo $result->occupancy; ?> | <strong>Food facility :</strong> 
			<?php echo ($result->food_facility==1)?'Yes':'No'; ?></p>
            <p class="text-justify"><strong>Description :</strong> <?php echo $result->description; ?> </p>
            <p><strong>Price Range :</strong> INR <?php echo $result->rent_from; ?> - INR <?php echo $result->rent_to; ?></p>
            <p style="text-transform:capitalize;"><strong>Contact Person : </strong><?php echo $result->name; ?></p>
            <p><strong>Contact Number :</strong> 
			<?php if($result->post_type=='Paid') { ?>
			<?php echo $result->phone; ?>
            <?php } else { ?>
            <span style="color:#F00;">Not available in free post</span> 
            <?php } ?>
            </p>
            
            </div>
        
        
        </div> <!-- row ends here -------->
        
        
        
        
        
        
        
        
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