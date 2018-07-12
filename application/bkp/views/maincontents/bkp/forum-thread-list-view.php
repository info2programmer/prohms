<div class="main">
    <div class="document-title with-breadcrumb">
        <div class="container">
            <h1><?php echo ($maincat!=6)?$subcat_details->cat_name:$subcat_details->area_name; ?></h1>
            <h6>
                <ul class="breadcrumb">
                    <li>Forum</li>
                    <li><?php echo $maincat_details->cat_name; ?></li>
                    <li><?php echo ($maincat!=6)?$subcat_details->cat_name:$subcat_details->area_name; ?></li>
                </ul>
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="row forum">

            <div class="col-xs-12 forum-topic-category">
                <h3 class="forum-topic-category-title">Sticky Topics</h3>
				<?php
				$stickey_topics = $this->db->query("select * from td_forum_thread where maincat_id='$maincat' and subcat_id='$subcat' and published=1 and thread_is_important=1")->result();
				if($stickey_topics) {
					foreach($stickey_topics as $stickey_topic) { 
				?>
                <div class="row forum-topic">
                    <div class="col-xs-6 col-md-5 forum-topic-title">
                        <div class="forum-topic-icon"><i class="icon-file-text3"></i></div>
                        <a href="<?php echo base_url(); ?>front_home/forum_thread/<?php echo $stickey_topic->thread_id; ?>"><?php echo $stickey_topic->thread_title; ?></a>
                    </div>
                    <div class="col-xs-4 col-md-3 forum-topic-last-thread">
                        <?php
						$last_reply = $this->db->query("select td_users.username,td_thread_reply.* from td_thread_reply inner join td_users on td_users.id=td_thread_reply.reply_user_id where td_thread_reply.thread_id='$stickey_topic->thread_id' order by td_thread_reply.reply_id desc")->row();
						if($last_reply) { 
							$last_reply_desc = $last_reply->reply_desc;
							$desc_count = strlen($last_reply_desc);
							if($desc_count>24)
							{
								echo substr($last_reply_desc,0,24)."...";	
							}
							else
							{
								echo $last_reply_desc;
							}
						}
						else
						{
							echo "No reply...";	
						}
						?>                        
                        <br>
                        <small>by <?php echo ($last_reply)?$last_reply->username:""; ?>,  
						<?php 
							$datetime11 = explode(" ", $stickey_topic->thread_date); 
							echo $d11 = date_format(date_create($datetime11[0]), "M d , Y");
							$t11 = $datetime11[1];
							echo " ";
							echo date("H:i:s", strtotime($t11));
						?>
                        </small>
                    </div>
                    <div class="col-xs-2 col-md-2 forum-topic-threads"><i class="icon-calendar"></i>
                        <?php 
							$datetime1 = explode(" ", $stickey_topic->thread_date); 
							echo $d1 = date_format(date_create($datetime1[0]), "M d , Y");
							$t1 = $datetime1[1];
							echo " ";
							echo date("H:i:s", strtotime($t1));
						?>
                    </div>
                    <div class="hidden-xs col-md-2 forum-topic-posts"><i class="icon-comment"></i>
                        <?php
						echo $reply_count = $this->db->query("select * from td_thread_reply where thread_id='$stickey_topic->thread_id'")->num_rows();
						?>
                    </div>
                </div>
                <?php } } else { ?>
                No Sticky Topics are available
                <?php } ?>                

            </div>

            <div class="col-xs-12 forum-topic-category">
                <h3 class="forum-topic-category-title">General Topics 
                <?php if($this->session->userdata('user_id1')) { ?>
                <a href="<?php echo base_url(); ?>front_home/forum_new_thread/<?php echo $maincat_details->cat_id; ?>/<?php echo ($maincat!=6)?$subcat_details->cat_id:$subcat_details->id; ?>" class="forum-title-bar-button"><i class="icon-plus2"></i> Post New Topic</a>
                <?php } else { ?>
                <a href="<?php echo base_url(); ?>users/login/front_home/forum_new_thread/<?php echo $maincat_details->cat_id; ?>/<?php echo ($maincat!=6)?$subcat_details->cat_id:$subcat_details->id; ?>" class="forum-title-bar-button"><i class="icon-plus2"></i> Post New Topic</a>
                <?php } ?>
                </h3>
                <?php
				if($maincat!=6) { 
				$gen_topics = $this->db->query("select * from td_forum_thread where maincat_id='$maincat' and subcat_id='$subcat' and published=1 and thread_is_important=0 order by thread_id desc")->result();
				}
				else
				{
				$gen_topics = $this->db->query("select * from td_forum_thread where maincat_id='$maincat' and area_id='$subcat' and published=1 and thread_is_important=0 order by thread_id desc")->result();	
				}
				if($gen_topics) {
					foreach($gen_topics as $gen_topic) { 
				?>                
                <div class="row forum-topic">
                    <div class="col-xs-6 col-md-5 forum-topic-title">
                        <div class="forum-topic-icon"><i class="icon-file-text2"></i></div>
                        <a href="<?php echo base_url(); ?>front_home/forum_thread/<?php echo $gen_topic->thread_id; ?>"><?php echo $gen_topic->thread_title; ?></a>
                    </div>
                    <div class="col-xs-4 col-md-3 forum-topic-last-thread">
                        <?php
						$last_reply1 = $this->db->query("select td_users.username,td_thread_reply.* from td_thread_reply inner join td_users on td_users.id=td_thread_reply.reply_user_id where td_thread_reply.thread_id='$gen_topic->thread_id' order by td_thread_reply.reply_id desc")->row();
						if($last_reply1) {
							$last_reply_desc1 = $last_reply1->reply_desc;
							$desc_count1 = strlen($last_reply_desc1);
							/*if($desc_count1>24)
							{
								echo character_limiter($last_reply_desc1,24);	
							}
							else
							{*/
								echo $last_reply_desc1;
							//}
						}
						else
						{
							echo "No reply found...";
						}
						?>                        
                        <br>
                        <small>by <?php echo ($last_reply1)?$last_reply1->username:""; ?>, 
                        <?php 
							$datetime22 = explode(" ", $gen_topic->thread_date); 
							echo $d22 = date_format(date_create($datetime22[0]), "M d , Y");
							$t22 = $datetime22[1];
							echo " ";
							echo date("H:i:s", strtotime($t22));
						?>
                        </small>
                    </div>
                    <div class="col-xs-2 col-md-2 forum-topic-threads"><i class="icon-calendar"></i>
                        <?php 
							$datetime2 = explode(" ", $gen_topic->thread_date); 
							echo $d2 = date_format(date_create($datetime2[0]), "M d , Y");
							$t2 = $datetime2[1];
							echo " ";
							echo date("H:i:s", strtotime($t2));
						?>
                    </div>
                    <div class="hidden-xs col-md-2 forum-topic-posts"><i class="icon-comment"></i>
                        <?php
						echo $reply_count1 = $this->db->query("select * from td_thread_reply where thread_id='$gen_topic->thread_id'")->num_rows();
						?>
                    </div>
                </div>
				
                <?php } } else { ?>
                No General Topics are available
                <?php } ?>                

            </div>

            <div class="col-xs-12">
                <div class="center-block pull-right-lg pull-right-md clearfix">
                    <ul class="pagination">
                        <li>
                            <a href="#">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </li>

                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li class="active"><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                        <li>
                            <a href="#">
                                <i class="fa fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.main -->