<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Leave Application</h4>
    </div>
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active">Manage Leave Application</li>
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
          <th>Sender Name</th>
          <th>Date</th>
          <th>Subject</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if($rows) { $s=1; foreach($rows as $row) { 
	  $app_id = $row->application_id;
	  $reply_count = $this->db->query("select * from td_application_reply where application_id='$app_id'")->num_rows();
	  ?>
        <strong><tr>
          <td><?php echo $s++; ?></td>
          <td>
          <?php 
			$sender_id = $row->sender_id; 
			$emp_detail = $this->db->query("select * from td_employee_personal_details where emp_id='$sender_id'")->row();
			echo $emp_detail->emp_name." ( ".$emp_detail->emp_code." )";
		  ?>
          </td>
          <td><?php echo date_format(date_create($row->application_date), "d M, Y"); ?></td>
          <td><?php echo $row->application_subject; ?><?php echo ($reply_count>0)?' ('.$reply_count.')':''; ?></td>
          <td>          	
            <div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>master-admin/leave_application/view/<?php echo $row->application_id; ?>"><i class="fa fa-eye"></i></a></div>
            <!--<div class="col-md-3 col-sm-4"><a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_department/confirmDelete/<?php echo $row->application_id; ?>"><i class="fa fa-trash"></i></a></div>-->
          </td>
        </tr></strong>
     <?php } } else { ?>
     	<tr><td colspan="5" align="center">No records found</td></tr>	
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