<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Employee Performance</h4>
    </div>
    <!--<div class="heading-elements">
      <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
    </div>-->
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active">Manage Employee Performance</li>
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
    <a href="<?php echo base_url(); ?>manage_employee_performance/add" class="btn btn-primary">Add Employee Performance</a>
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
          <th>Employee Name</th>
          <th>From Date</th>
          <th>To Date</th>
          <th>Total Sale</th>
          <th>Details of sale</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if($rows) { $s=1; foreach($rows as $row) { ?>
        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php echo $row->emp_name; ?> (<?php echo $row->emp_code; ?>)</td>
          <td><?php echo date_format(date_create($row->from_date), "d-m-Y"); ?></td>
          <td><?php echo date_format(date_create($row->to_date), "d-m-Y"); ?></td>
          <td><?php echo $row->sale_total; ?></td>
          <td><?php 
		  $sale_details = explode(",", $row->sale_details);
		  $sale_amount = explode(",", $row->sale_amount);
		  //print_r($sale_amount);
		  $i=0; 
		  //echo $sale_amount[$i];
		  foreach($sale_details as $a) { 
		  echo "<strong>".$a."</strong>-".$sale_amount[$i]."<br>";
		  $i++;
		  }
		  
		  ?></td>
          <td>
          <?php if($row->published==1) { ?>
          <a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_employee_performance/deactive/<?php echo $row->emp_performance_id; ?>"><span class="label label-success">Active</span></a>
          <?php } else { ?>
          <a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_employee_performance/active/<?php echo $row->emp_performance_id; ?>"><span class="label label-danger">Inactive</span></a>
          <?php } ?>
          </td>
          <td>  
          <div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>manage_employee/profile/<?php echo $row->emp_id; ?>"><i class="fa fa-eye"></i></a></div>        	
            <?php /*?><div class="col-md-3 col-sm-4"><a href="<?php echo base_url(); ?>manage_employee_performance/edit/<?php echo $row->emp_performance_id; ?>"><i class="fa fa-edit"></i></a></div>
            <div class="col-md-3 col-sm-4"><a onClick="return confirm('Are you sure ?'); " href="<?php echo base_url(); ?>manage_employee_performance/confirmDelete/<?php echo $row->emp_performance_id; ?>"><i class="fa fa-trash"></i></a></div><?php */?>
          </td>
        </tr>
     <?php } } else { ?>
     	<tr><td colspan="7" align="center">No records found</td></tr>	
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