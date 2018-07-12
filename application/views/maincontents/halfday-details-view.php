<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Halfday details of <strong><?php echo $emp_per->emp_name; ?></strong></h4>
    </div>
    <!--<div class="heading-elements">
      <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
    </div>-->
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active">Manage Halfday details of <strong><?php echo $emp_per->emp_name; ?></strong></li>
    </ul>
    <!--<ul class="breadcrumb-elements">
      <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
      <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-gear position-left"></i> Settings <span class="caret"></span> </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
          <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
          <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
          <li class="divider"></li>
          <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
        </ul>
      </li>
    </ul>-->
  </div>
</div>
<!-- /page header --> 

<!-- Content area -->
<div class="content">
                            
  <!-- Column selectors -->
  <div class="panel panel-flat">
    <div class="panel-heading">  
    <span style="color:#090;"><?php if($this->session->flashdata('success_message')) { echo $this->session->flashdata('success_message'); } ?></span>
    <span style="color:#F00;"><?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('error_message'); } ?></span>    
      <!--<h5 class="panel-title">Manage Job Type</h5>-->
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
          <th>Halfday date</th>
          <th>Halfday type</th>
          <!--<th>Action</th>-->
        </tr>
      </thead>
      <tbody>
      <?php if($rows) { $s=1; foreach($rows as $row) { 
	  $leave_allot = $this->db->query("select * from td_leave_allocation_details where leave_allocation_details_id='$row->halfday_type'")->row();
	  $leave = $this->db->query("select * from td_leave where leave_id='$leave_allot->leave_id'")->row();	  
	  ?>
        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php echo date_format(date_create($row->halfday_date), "d-m-Y"); ?></td>
          <td><?php echo $leave->leave_name; ?></td>          
          <!--<td>          	
            <div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>manage_leave_assign/user_details/<?php echo $row->leave_assign_id; ?>"><i class="fa fa-user" aria-hidden="true"></i></a></div>
            <div class="col-md-3 col-sm-4"><a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_leave_assign/leave_details/<?php echo $row->leave_assign_id; ?>"><i class="fa fa-pagelines" aria-hidden="true"></i></a></div>
          </td>-->
        </tr>
     <?php } ?>
	 	<tr>
        	<td colspan="6" align="left">
            <?php 
			$emp_id = $emp_per->emp_id;
			$allocation = $this->db->query("select * from td_leave_allocation where emp_id='$emp_id'")->row();
			if($allocation)
			{
				$leave_allocation_id = $allocation->leave_allocation_id;
				$allocation_details = $this->db->query("select * from td_leave_allocation_details where leave_allocation_id='$leave_allocation_id'")->result();
				if($allocation_details) {
					foreach($allocation_details as $a_d) {
						$chuti = $this->db->query("select * from td_leave where leave_id='$a_d->leave_id'")->row();
						echo "<strong>".$chuti->leave_name."</strong> : ".$a_d->leave_balance."<br>";
					}
				}
			}
			?>
            </td>
        </tr>
	 <?php } else { ?>
     	<tr><td colspan="6" align="center">No records found</td></tr>	
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