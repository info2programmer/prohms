<!-- Page header -->

<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Team Member Performance</h4>
    </div>
    <!--<div class="heading-elements">
      <div class="heading-btn-group"> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a> <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a> </div>
    </div>-->
  </div>
  <div class="breadcrumb-line breadcrumb-line-component">
    <ul class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
      <li class="active">Manage Team Member Performance</li>
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
    
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>master-admin/manage_performance">
        <div class="form-group">
        	<input type="hidden" name="mode" value="tab" />
          <input type="text" class="form-control pickadate" placeholder="Select From date" name="from_date" id="from_date">
        </div>
        <div class="form-group">
          <input type="text" class="form-control pickadate" placeholder="Select To date" name="to_date" id="to_date">
        </div>
        <div class="form-group">
        <?php $emps = $this->db->query("select * from td_employee_personal_details where published=1 order by emp_name asc")->result(); ?>
          <select name="emp_id" id="emp_id" data-placeholder="Select a Team Member" class="select">
             <option value="" selected="selected" hidden>Select a Team Member</option>
             <?php if($emps) { foreach($emps as $emp) { ?>
             <option value="<?php echo $emp->emp_id; ?>"><?php echo $emp->emp_name; ?> (<?php echo $emp->emp_code; ?>)</option>
             <?php } } else { ?>
             <option value="No employee" selected="selected">No employee</option>
              <?php } ?>
         </select>
        </div>
        <button type="submit" class="btn btn-primary">Search <i class="icon-arrow-right14 position-right"></i></button>
  </form>
    <br />   
    <!--<a href="<?php echo base_url(); ?>manage_performance/add" class="btn btn-primary">Add Team Member Performance</a>
      <h5 class="panel-title">Manage Job Type</h5>-->
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
          <th>Performance Date</th>
          <th>Points</th>
          <th>Applications</th>
          <th>Hours Login</th>
          <th>RPH</th>
          <th>APH</th>
          <th>RPA</th>
          <th>QA Score</th>
        </tr>
      </thead>
      <tbody>
      <?php 
	  $points = 0;
	  $applications = 0;
	  $hours_login = 0;
	  $rph = 0;
	  $aph = 0;
	  $rpa = 0;
	  $quality_score = 0;
	  if($rows) { $s=1; foreach($rows as $row) { 
	  
	  ?>
        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php echo $row->emp_name; ?> (<?php echo $row->emp_code; ?>)</td>
          <td><?php echo date_format(date_create($row->performance_date), "d-m-Y"); ?></td>
          <td><?php echo $row->points; ?></td>
          <td><?php echo $row->applications; ?></td>
          <td><?php echo $row->hours_login; ?></td>
          <td><?php echo round($row->rph, 2); ?></td>
          <td><?php echo round($row->aph, 2); ?></td>
          <td><?php echo round($row->rpa, 2); ?></td>
          <td><?php echo $row->quality_score; ?></td>
        </tr>
     <?php 
	 $points += $row->points;
	 $applications += $row->applications;
	 $hours_login += $row->hours_login;
	 $rph += $row->rph;
	 $aph += $row->aph;
	 $rpa += $row->rpa;
	 $quality_score += $row->quality_score;
	 } ?>
     	<tr>
        	<td><strong>Net Avarage</strong></td>
            <td></td>
            <td></td>
            <td><?php echo round($points/$row_count, 2); ?></td>
            <td><?php echo round($applications/$row_count, 2); ?></td>
            <td><?php echo round($hours_login/$row_count, 2); ?></td>
            <td><?php echo round($rph/$row_count, 2); ?></td>
            <td><?php echo round($aph/$row_count, 2); ?></td>
            <td><?php echo round($rpa/$row_count, 2); ?></td>
            <td><?php echo round($quality_score/$row_count, 2); ?></td>
        </tr>
     <?php } else { ?>
     	<tr><td colspan="12" align="center">No records found</td></tr>	
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