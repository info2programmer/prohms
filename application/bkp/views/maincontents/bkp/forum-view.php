<div class="main">
    <div class="document-title">
        <div class="container">
            <h1>Forum</h1>
        </div>
    </div>

    <div class="container">
        <div class="row forum">
        <?php
		$main_cats = $this->db->query("select * from td_category where published=1 and parent_id=0")->result();
		if($main_cats) { 
		foreach($main_cats as $main_cat) { 
		$main_cat_id = $main_cat->cat_id;
		?>
            <div class="col-xs-12 forum-category">
                <h3 class="forum-category-title"><?php echo $main_cat->cat_name; ?></h3>
                <?php if($main_cat_id!=6) { ?>
				<?php
				$sub_cats = $this->db->query("select * from td_category where published=1 and parent_id=$main_cat_id")->result();
				if($sub_cats) { 
				foreach($sub_cats as $sub_cat) { 
				$sub_cat_id = $sub_cat->cat_id;
				?>
                <div class="row forum-sub-category">
                    <div class="col-xs-6 col-md-5 forum-sub-category-title">
                        <div class="forum-sub-category-icon"><i class="icon-folder"></i></div>
                        <a href="<?php echo base_url(); ?>front_home/forum_thread_list/<?php echo $main_cat_id; ?>/<?php echo $sub_cat_id; ?>"><?php echo $sub_cat->cat_name; ?></a>
                    </div>
                    <?php
					$last_cat_thread1 = $this->db->query("select a.*,b.username from td_forum_thread as a inner join td_users as b on b.id=a.thread_user_id where a.published=1 and a.maincat_id='$main_cat_id' and a.subcat_id='$sub_cat_id' order by a.thread_id desc limit 1")->row();
					?>
                    <div class="col-xs-4 col-md-3 forum-sub-category-last-thread">
                    	<?php if($last_cat_thread1) { ?>
                        <a href="<?php echo base_url(); ?>front_home/forum_thread/<?php echo $last_cat_thread1->thread_id; ?>">
                        <?php } ?>
                        <?php						
						if($last_cat_thread1) { 
							echo $last_cat_thread1->thread_title;
						}
						else
						{
							echo "<b>No thread found...</b>";
						}
						?>
                        <?php if($last_cat_thread1) { ?>
                        </a>
                        <?php } ?>
                        <br>
                        <small><?php 
						if($last_cat_thread1) {
						echo "by ".$last_cat_thread1->username; 
						}
						?></small>
                    </div>
                    <div class="col-xs-2 col-md-2 forum-sub-category-threads"><i class="icon-file-text2"></i> 
                    <?php
						echo $thread_count1 = $this->db->query("select * from td_forum_thread where maincat_id='$main_cat_id' and subcat_id='$sub_cat_id'")->num_rows();
					?>
                    </div>
                    <div class="hidden-xs col-md-2 forum-sub-category-posts"><i class="icon-comment-discussion"></i> 
                    <?php
					if($last_cat_thread1) {
						echo $thread_reply1 = $this->db->query("select a.*,b.* from td_forum_thread as a inner join td_thread_reply as b on b.thread_id=a.thread_id where a.maincat_id='$main_cat_id' and a.subcat_id='$sub_cat_id' and a.published=1")->num_rows()+$thread_count1;
					}
					else
					{
						echo "0";	
					}
					?>
                    </div>
                </div>
                <?php } } else { ?>
                No sub category found
                <?php } 
				?>
                <?php } else { ?>
                <?php 
				$areas = $this->db->query("SELECT * FROM `td_area` where published=1")->result(); 
				if($areas) {
					foreach($areas as $area) { 
					$area_id = $area->id; 
				?>
                <div class="row forum-sub-category">
                    <div class="col-xs-6 col-md-5 forum-sub-category-title">
                        <div class="forum-sub-category-icon"><i class="icon-folder"></i></div>
                        <a href="<?php echo base_url(); ?>front_home/forum_thread_list/<?php echo $main_cat_id; ?>/<?php echo $area_id; ?>"><?php echo $area->area_name; ?></a>
                    </div>
                    <?php					
					$last_cat_thread2 = $this->db->query("select a.*,b.username from td_forum_thread as a inner join td_users as b on b.id=a.thread_user_id where a.published=1 and a.maincat_id='$main_cat_id' and a.area_id='$area_id' order by a.thread_id desc limit 1")->row();
					?>
                    <div class="col-xs-4 col-md-3 forum-sub-category-last-thread">
                    <?php if($last_cat_thread2) { ?>
                        <a href="<?php echo base_url(); ?>front_home/forum_thread/<?php echo $last_cat_thread2->thread_id; ?>">
                    <?php } ?>    
                        <?php
						if($last_cat_thread2) {
							echo $last_cat_thread2->thread_title;
						}
						else
						{
							echo "<b>No thread found...</b>";
						}
						?>
                        <?php if($last_cat_thread2) { ?>
                        </a>
                        <?php } ?>
                        <br>
                        <small><?php 
						if($last_cat_thread2) {
							echo "by ".$last_cat_thread2->username; 
						}
						else
						{
							echo "";
						}
						?></small>
                    </div>
                    <div class="col-xs-2 col-md-2 forum-sub-category-threads"><i class="icon-file-text2"></i> 
                    <?php
						echo $thread_count2 = $this->db->query("select * from td_forum_thread where maincat_id='$main_cat_id' and area_id='$area_id'")->num_rows();
					?>
                    </div>
                    <div class="hidden-xs col-md-2 forum-sub-category-posts"><i class="icon-comment-discussion"></i> 
                    <?php
					if($last_cat_thread2) {
						echo $thread_reply2 = $this->db->query("select a.*,b.* from td_forum_thread as a inner join td_thread_reply as b on b.thread_id=a.thread_id where a.maincat_id='$main_cat_id' and a.area_id='$area_id' and a.published=1")->num_rows()+$thread_count2;
					}
					else
					{
						echo "0";	
					}
					?>
                    </div>
                </div>
                <?php } } else { ?>
                No area found
                <?php } ?>                
                <?php } ?>
            </div>
        <?php } } else { ?>
        No main category found
        <?php } ?>    

            <!--<div class="col-xs-12 forum-category">
                <h3 class="forum-category-title">Category Title</h3>

                <div class="row forum-sub-category">
                    <div class="col-xs-6 col-md-5 forum-sub-category-title">
                        <div class="forum-sub-category-icon"><i class="icon-folder"></i></div>
                        <a href="#">Sub Category Title</a>
                    </div>
                    <div class="col-xs-4 col-md-3 forum-sub-category-last-thread">
                        <a href="#">Sub Category Last Thread Name</a><br>
                        <small>by Who</small>
                    </div>
                    <div class="col-xs-2 col-md-2 forum-sub-category-threads"><i class="icon-file-text2"></i> Number of Threads</div>
                    <div class="hidden-xs col-md-2 forum-sub-category-posts"><i class="icon-comment-discussion"></i> Total Posts</div>
                </div>

                <div class="row forum-sub-category">
                    <div class="col-xs-6 col-md-5 forum-sub-category-title">
                        <div class="forum-sub-category-icon"><i class="icon-folder"></i></div>
                        <a href="#">Sub Category Title</a>
                    </div>
                    <div class="col-xs-4 col-md-3 forum-sub-category-last-thread">
                        <a href="#">Sub Category Last Thread Name</a><br>
                        <small>by Who</small>
                    </div>
                    <div class="col-xs-2 col-md-2 forum-sub-category-threads"><i class="icon-file-text2"></i> Number of Threads</div>
                    <div class="hidden-xs col-md-2 forum-sub-category-posts"><i class="icon-comment-discussion"></i> Total Posts</div>
                </div>

            </div>-->

        </div>
    </div>



</div>
<!-- /.main -->