<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> IP</h4>
    </div>
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active">Manage IP</li>
    </ul>
  </div>
</div>
<!-- /page header --> 

<!-- Content area -->
<div class="content">
                            
  <!-- Column selectors -->
  <div class="panel panel-flat">
    <div class="panel-heading">  
    <span style="color:#090;"><?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?></span>
    <span style="color:#F00;"><?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('error_message'); } ?></span> <br /> 
    <a href="<?php echo base_url(); ?>master-admin/manage_ip/add" class="btn btn-primary">Add IP</a>
      <div class="heading-elements">
        <ul class="icons-list">
          <li><a data-action="collapse"></a></li>
          <li><a data-action="reload"></a></li>
          <li><a data-action="close"></a></li>
        </ul>
      </div>
    </div>
    <div class="panel-body"></div>
    <table class="table datatable-button-html5-columns">
      <thead>
        <tr>
          <th>Sl No.</th>
          <th>Location Name</th>
          <th>IP Address</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if($rows) { $s=1; foreach($rows as $row) { ?>
        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php echo $row->loc_name; ?></td>
          <td><?php echo $row->ip_address; ?></td>
          <td>
          <?php if($row->published==1) { ?>
          <a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>master-admin/manage_ip/deactive/<?php echo $row->ip_id; ?>"><span class="label label-success">Active</span></a>
          <?php } else { ?>
          <a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>master-admin/manage_ip/active/<?php echo $row->ip_id; ?>"><span class="label label-danger">Inactive</span></a>
          <?php } ?>
          </td>
          <td>          	
            <div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>master-admin/manage_ip/edit/<?php echo $row->ip_id; ?>"><i class="fa fa-edit"></i></a></div>
            <!--<div class="col-md-3 col-sm-4"><a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_ip/confirmDelete/<?php echo $row->ip_id; ?>"><i class="fa fa-trash"></i></a></div>-->
          </td>
        </tr>
     <?php } } else { ?>
     	<tr><td colspan="4" align="center">No records found</td></tr>	
     <?php } ?>
      </tbody>
    </table>
  </div>
  <!-- /column selectors --> 
  <!-- Footer -->
    <div class="footer text-muted"> 
      <?php echo $footer; ?>
    </div>
    <!-- /footer -->
</div>
<!-- /content area -->