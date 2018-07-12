<!-- Page header -->



<div class="page-header">

  <div class="page-header-content">

    <div class="page-title">

      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Salary</h4>

    </div>

    <!--<div class="heading-elements">

      <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>

    </div>-->

  </div>

  <div class="breadcrumb-line breadcrumb-line-component">

    <ul class="breadcrumb">

      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>

      <li class="active">Manage Salary</li>

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

    <span style="color:#F00;"><?php if($this->session->flashdata('error_message')) { echo $this->session->flashdata('error_message'); } ?></span> <br />  

    <a href="<?php echo base_url(); ?>manage_salary/add" class="btn btn-primary">Add Salary</a>
	<!--<a target="_blank" href="<?php echo base_url(); ?>manage_salary/salary_statement" class="btn btn-primary" style="float:right;margin-right: 88px;">Salary Statement</a>-->
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

          <th>Team Member Name</th>

          <th>Team Member Code</th>

          <th>Salary Period</th>

          <th>Total Salary</th>

          <!--<th>Status</th>-->

          <th>Action</th>

        </tr>

      </thead>

      <tbody>

      <?php if($rows) { $s=1; foreach($rows as $row) { 

	  $emp_details = $this->db->query("select * from td_employee_personal_details where emp_id='$row->emp_id'")->row();

	  ?>

        <tr>

          <td><?php echo $s++; ?></td>

          <td><?php echo $emp_details->emp_name; ?></td>

          <td><?php echo $emp_details->emp_code; ?></td>

          <td><?php echo "<strong>From</strong> ".date_format(date_create($row->from_date), "d-m-Y")."  <strong>To</strong>  ".date_format(date_create($row->to_date), "d-m-Y"); ?></td>

          <td><?php echo $row->total_salary; ?></td>

          <!--<td>

          <?php if($row->published==1) { ?>

          <a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_salary/deactive/<?php echo $row->leave_assign_id; ?>"><span class="label label-success">Active</span></a>

          <?php } else { ?>

          <a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_salary/active/<?php echo $row->leave_assign_id; ?>"><span class="label label-danger">Inactive</span></a>

          <?php } ?>

          </td>-->

          <td>          	

            <!--<div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>manage_salary/user_details/<?php echo $emp_details->emp_id; ?>"><i class="fa fa-user" aria-hidden="true"></i></a></div>-->

            <div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>manage_salary/payroll/<?php echo $row->salary_id; ?>" target="_blank"><i class="fa fa-money" aria-hidden="true"></i></a></div>

          </td>

        </tr>

     <?php } } else { ?>

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