<div class="main">
    <div class="document-title with-breadcrumb">
        <div class="container">
            <h1><?php echo $thread_details->thread_title; ?></h1>
            <h6>
                <ul class="breadcrumb">
                    <li>Forum</li>
                    <li>
                    <?php $maincat = $thread_details->maincat_id; 
					$maincat_details = $this->db->query("select * from td_category where cat_id='$maincat'")->row();
					echo $maincat_details->cat_name; 
					?>
                    </li>
                    <li>
                    <?php 
					if($maincat!=6) { 
						$subcat = $thread_details->subcat_id; 
						$subcat_details = $this->db->query("select * from td_category where cat_id='$subcat'")->row();
						echo $subcat_details->cat_name; 
					}
					else
					{
						$subcat = $thread_details->area_id; 
						$subcat_details = $this->db->query("select * from td_area where id='$subcat'")->row();
						echo $subcat_details->area_name; 	
					}
					?>
                    </li>
                    <li><?php echo $thread_details->thread_title; ?></li>
                </ul>
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="row forum">

            <div class="col-xs-12 forum-topic-reply-list">
				
                <div class="row forum-reply">
                <?php 
                $user_details = $this->db->query("select * from td_users where id='$thread_details->thread_user_id'")->row();
				//echo '<pre>';print_r($user_details);die;
				?>
                    <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                        <?php echo $user_details->username; ?>
                    </div>
                    <div class="hidden-xs col-sm-5 col-md-4 col-lg-3 forum-reply-profile">
                    	<?php
						if($user_details->user_type=='S') { 
						?>
                        <img src="<?php echo base_url(); ?>uploads/student/<?php echo $user_details->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php } else if($user_details->user_type=='C') { ?>
                        <img src="<?php echo base_url(); ?>uploads/college/<?php echo $user_details->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php } else if($user_details->user_type=='P') { ?>
                        <img src="<?php echo base_url(); ?>uploads/pg/<?php echo $user_details->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php }  else if($user_details->user_type=='A') { ?>
                        <?php //echo $user_details->logo_image; ?>
                        <img src="<?php echo base_url(); ?>uploads/<?php echo $user_details->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php } ?>
                        <h4 class="forum-reply-profile-user"><?php echo $user_details->username; ?></h4>
                        <h5 class="forum-reply-profile-designation">
                        <?php 
						if($user_details->user_type=='S') { 
							echo "Student";
						}
						else if($user_details->user_type=='C')
						{
							$college_name = $user_details->college_name;
							$college_details = $this->db->query("select * from td_colleges where id='$college_name'")->row();
							echo $college_details->college_name;
						}
						else if($user_details->user_type=='P')
						{
							echo "Property Owner";
						}
						else if($user_details->user_type=='A')
						{
							echo "Admin";
						}
						?>
                        </h5>
                        <h6 class="forum-reply-profile-extra-stats"><i class="icon-heart6"></i> 0</h6>
                        <h6 class="forum-reply-profile-extra-stats"><i class="icon-file-text2"></i> 0</h6>
                        <h6 class="forum-reply-profile-extra-stats"><i class="icon-comment"></i> 0</h6>

                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 forum-reply-content">
                        <div class="reply-content">
                            <?php echo $thread_details->thread_desc; ?>
                        </div>
                    </div>
                    <div class="col-xs-12"></div>
                    <div class="hidden-xs col-sm-5 col-md-4 col-lg-3"></div>
                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
                        <div class="reply-action">
							<div class="reply-time">
                            <?php 
							$datetime = explode(" ", $thread_details->thread_date); 
							echo $d = date_format(date_create($datetime[0]), "M d , Y");
							$t = $datetime[1];
							echo " ";
							echo date("H:i:s", strtotime($t));
							?>
                            </div>                        
                            <a href="#" class="action-button"><i class="icon-pencil"></i> Edit</a>
                            <a href="#" class="action-button"><i class="icon-close2"></i> Delete</a>
                            <a href="javascript: void(0);" class="action-button"><i class="icon-heart5"></i> Liked</a>
                        </div>
                    </div>
                </div>
				<?php
				$t_id = $thread_details->thread_id;
				$reply_lists = $this->db->query("select * from td_thread_reply where thread_id='$t_id' and published=1")->result();
				if($reply_lists) {
					foreach($reply_lists as $reply_list) {  
				?>
                <?php 
                $user_details1 = $this->db->query("select * from td_users where id='$reply_list->reply_user_id'")->row();
				//echo '<pre>';print_r($user_details);die;
				?>
                <div class="row forum-reply">
                    <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                        <?php echo $user_details1->username; ?>
                    </div>
                    <div class="hidden-xs col-sm-5 col-md-4 col-lg-3 forum-reply-profile">
                    	<?php
						if($user_details1->user_type=='S') { 
						?>
                        <img src="<?php echo base_url(); ?>uploads/student/<?php echo $user_details1->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php } else if($user_details1->user_type=='C') { ?>
                        <img src="<?php echo base_url(); ?>uploads/college/<?php echo $user_details1->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php } else if($user_details1->user_type=='P') { ?>
                        <img src="<?php echo base_url(); ?>uploads/pg/<?php echo $user_details1->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php }  else if($user_details1->user_type=='A') { ?>
                        <img src="<?php echo base_url(); ?>uploads/<?php echo $user_details1->logo_image; ?>" alt="" class="forum-reply-profile-image">
                        <?php } ?>
                        <h4 class="forum-reply-profile-user"><?php echo $user_details1->username; ?></h4>
                        <h5 class="forum-reply-profile-designation">
                        <?php 
						if($user_details1->user_type=='S') { 
							echo "Student";
						}
						else if($user_details1->user_type=='C')
						{
							$college_name1 = $user_details1->college_name;
							$college_details1 = $this->db->query("select * from td_colleges where id='$college_name1'")->row();
							echo $college_details1->college_name;
						}
						else if($user_details1->user_type=='P')
						{
							echo "Property Owner";
						}
						else if($user_details1->user_type=='A')
						{
							echo "Admin";
						}
						?>
                        </h5>
                        <h6 class="forum-reply-profile-extra-stats"><i class="icon-heart6"></i> 0</h6>
                        <h6 class="forum-reply-profile-extra-stats"><i class="icon-file-text2"></i> 0</h6>
                        <h6 class="forum-reply-profile-extra-stats"><i class="icon-comment"></i> 0</h6>

                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9 forum-reply-content">
                        <div class="reply-content"><?php echo $reply_list->reply_desc; ?></div>
                    </div>
                    <div class="col-xs-12"></div>
                    <div class="hidden-xs col-sm-5 col-md-4 col-lg-3"></div>
                    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
                        <div class="reply-action">
                        	<div class="reply-time">
								<?php 
                                $datetime1 = explode(" ", $reply_list->reply_date); 
                                echo $d1 = date_format(date_create($datetime1[0]), "M d , Y");
                                $t1 = $datetime1[1];
                                echo " ";
                                echo date("H:i:s", strtotime($t1));
                                ?>
                            </div>
                            <a href="#" class="action-button"><i class="icon-pencil"></i> Edit</a>
                            <a href="#" class="action-button"><i class="icon-close2"></i> Delete</a>
                            <a href="#" class="action-button"><i class="icon-heart6"></i> Like</a>
                        </div>
                    </div>
                </div>
				<?php } } else { ?>
                No reply found
                <?php } ?>               

                <div class="row">
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
				
                <?php if($this->session->userdata('username1')) { ?>
                <span style="color:#090;"><?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?></span>
                <form action="<?php echo base_url(); ?>front_home/forum_thread/<?php echo $thread_details->thread_id; ?>" method="post">
                <input type="hidden" name="mode" value="reply" />
                <input type="hidden" name="thread_id" value="<?php echo $thread_details->thread_id; ?>" />
                <input type="hidden" name="reply_user_id" value="<?php echo $this->session->userdata('user_id1'); ?>" />
                    <div class="row forum-new-topic">
                        <div class="col-xs-12">
                            <h4 class="forum-new-topic-label">Post New Reply</h4>

                            <div class="form-group">
                                <textarea id="editor" class="form-control" name="reply_desc"></textarea>
                                <span style="color:#FF0000;"><?php echo form_error('reply_desc'); ?></span>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Post Reply</button>
                            </div><!-- /.form-group -->
                        </div>
                    </div>
                </form>
                <?php } else { ?>
                <div class="row">
                	<div class="col-xs-12">
                		<h3 class="text-center">Please <a href="<?php echo base_url(); ?>users/login/front_home/forum_thread/<?php echo $thread_details->thread_id; ?>">login</a> to give reply</h3> 
                	</div>
                </div>
				<?php } ?>

            </div>

        </div>
    </div>
</div>
<!-- /.main -->