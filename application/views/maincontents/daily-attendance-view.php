<!-- Page header -->



<div class="page-header">

  <div class="page-header-content">

    <div class="page-title">

      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Attendance <?php echo date_format(date_create($row1->attendance_date), "d-m-Y"); ?></h4>

    </div>

  </div>

  <div class="breadcrumb-line breadcrumb-line-component">

    <ul class="breadcrumb">

      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>

      <li class="active">Manage Attendance</li>

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

    <a href="<?php echo base_url(); ?>manage_attendance/add" class="btn btn-primary">Add Attendance</a>	

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
          <th>Team Member</th>
          <th>Attendance Date</th>
          <th>Present</th>
          <th>Late</th>
        </tr>
      </thead>

      <tbody>

      <?php if($rows) { 
	  $s=1;	  
	  foreach($rows as $row) { $emp_id = $row->emp_id;
	  ?>

        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php
		  echo $row->emp_name." (".$row->emp_code." )";
		  ?></td>
          <td><?php echo date_format(date_create($row1->attendance_date), "d-m-Y"); ?></td> 
          <td>
		  <?php
		  $present_id = explode(",", $row1->present_id); 
		  echo (in_array($emp_id, $present_id))?'<span class="label label-success">Present</span>':'<span class="label label-danger">Absent</span>'; ?></td>
          <td>
		  <?php 
		  $late_id = explode(",", $row1->late_id);
		  echo (in_array($emp_id, $late_id))?'<span class="label label-danger">Late</span>':''; ?></td> 
		 </tr>

     <?php  } } else { ?>

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