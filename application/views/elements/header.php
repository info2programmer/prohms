<?php $site_setting1 = $this->db->query("select * from td_site_settings")->row(); ?>
<div class="navbar-header"> <a class="navbar-brand" href="index.html"><img src="<?php echo base_url(); ?>uploads/pro.png" alt="" style="height:27px; padding-left:47px;" ></a>
  <ul class="nav navbar-nav visible-xs-block">
    <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
  </ul>
</div>
<div class="navbar-collapse collapse" id="navbar-mobile"> 
  <p class="navbar-text"><span class="label bg-success">Online</span></p>
  <ul class="nav navbar-nav navbar-right">    
    <li class="dropdown dropdown-user"> <a class="dropdown-toggle" data-toggle="dropdown"> <img src="<?php echo base_url(); ?>material/assets/images/logo.png" alt=""> <span><?php echo ($this->session->userdata('username'))?$this->session->userdata('username'):$this->session->userdata('username1'); ?></span> <i class="caret"></i> </a>
      <ul class="dropdown-menu dropdown-menu-right">
      <?php if($this->session->userdata('username')) { ?>
        <li><a href="<?php echo base_url(); ?>site_setting"><i class="icon-user-plus"></i> My profile</a></li>        
        <li><a href="<?php echo base_url(); ?>user/change_password"><i class="icon-cog5"></i> Account settings</a></li>
      <?php } ?>
      <?php if($this->session->userdata('username')) { ?>  
        <li><a href="<?php echo base_url(); ?>user/logout"><i class="icon-switch2"></i> Logout</a></li>
      <?php } elseif($this->session->userdata('username1')) { ?>
      	<li><a href="<?php echo base_url(); ?>employee/logout"><i class="icon-switch2"></i> Logout</a></li>
      <?php } ?>  
      </ul>
    </li>
  </ul>
</div>
