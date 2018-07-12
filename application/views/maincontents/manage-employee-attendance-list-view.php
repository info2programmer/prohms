<!-- Page header -->



<div class="page-header">

  <div class="page-header-content">

    <div class="page-title">

      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Team Member Attendance</h4>

    </div>

  </div>

  <div class="breadcrumb-line breadcrumb-line-component">

    <ul class="breadcrumb">

      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>

      <li class="active">Manage Team Member Attendance</li>

    </ul>

    

  </div>

</div>

<!-- /page header --> 



<!-- Content area -->

<div class="content">

                            

  <!-- Column selectors -->

  <div class="panel panel-flat">

    <div class="panel-heading"> 
    
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>manage_employee_attendance">
        <div class="form-group">
        	<input type="hidden" name="mode" value="tab" />
          <input type="text" class="form-control pickadate" placeholder="Select From date" name="from_date" id="from_date">
        </div>
        <div class="form-group">
          <input type="text" class="form-control pickadate" placeholder="Select To date" name="to_date" id="to_date">
        </div>        
        <button type="submit" class="btn btn-primary">Search <i class="icon-arrow-right14 position-right"></i></button>
  </form> 

    <span style="color:#090;"><?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?></span>

    <span style="color:#F00;"><?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('error_message'); } ?></span>
    

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
          <th>Attendance Date</th>
          <th>Present</th>
          <th>Late</th>
        </tr>
      </thead>

      <tbody>

      <?php if($rows) { $s=1; foreach($rows as $row) {  $emp_id = $this->session->userdata('user_id1'); ?>

        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php echo date_format(date_create($row->attendance_date), "d-m-Y"); ?></td>
          <td>
		  <?php 
		  $present_id = explode(",", $row->present_id);
		  echo (in_array($emp_id, $present_id))?'<span class="label label-success">Present</span>':'<span class="label label-danger">Absent</span>'; ?></td>
          <td>
		  <?php 
		  $late_id = explode(",", $row->late_id);
		  echo (in_array($emp_id, $late_id))?'<span class="label label-danger">Late</span>':'<span class="label label-success">No late</span>'; ?></td>
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