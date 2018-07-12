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

            <div class="col-xs-12 forum-new-thread-form">
                <h3 class="forum-new-thread-form-label">Post New Topic</h3>

                <form action="<?php echo base_url(); ?>front_home/forum_new_thread/<?php echo $maincat; ?>/<?php echo $subcat; ?>" method="post">
                <input type="hidden" name="mode" value="new_thread" />
                    <div class="row forum-new-topic">
                        <div class="col-xs-12">
                            <h4 class="forum-new-topic-label">Topic Title</h4>

                            <div class="form-group">
                                <input name="title" class="form-control" value="<?php echo set_value('title'); ?>">
                                <span style="color:#FF0000"><?php echo form_error('title'); ?></span>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-xs-12">
                            <h4 class="forum-new-topic-label">Topic Details</h4>

                            <div class="form-group">
                                <textarea id="editor" class="form-control" name="desc" value="<?php echo set_value('desc'); ?>"></textarea>
                                <span style="color:#FF0000"><?php echo form_error('desc'); ?></span>
                            </div><!-- /.form-group -->
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Post Topic</button>
                            </div><!-- /.form-group -->
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<!-- /.main -->