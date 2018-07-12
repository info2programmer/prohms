<div class="page-header">

  <div class="page-header-content">

    <div class="page-title">

      <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Manage</span> Salary</h4>

    </div>

  </div>

  <div class="breadcrumb-line breadcrumb-line-component">

    <ul class="breadcrumb">

      <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>

      <li class="active">Manage Salary</li>

    </ul>    

  </div>

</div>

<!-- /page header --> 



<!-- Content area -->

<div class="content">

                            

  <!-- Column selectors -->

  <div class="panel panel-flat">

    <div class="panel-heading"> 
    
    <form class="form-inline" method="post" action="<?php echo base_url(); ?>master-admin/manage_salary/salary_report">
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
          <th>Team Member Name</th>
          <th>Payment Mode</th>
          <th>Salary Date</th>
          <th>Salary Details</th>
          <th>Total Salary</th>
        </tr>
      </thead>

      <tbody>

      <?php if($rows) { $s=1; foreach($rows as $row) { 

	  ?>

        <tr>
          <td><?php echo $s++; ?></td>
          <td><?php echo $row->emp_name." (".$row->emp_code." )"; ?></td>
          <td><?php if($row->transaction_id!='') { echo "Transfer (".$row->transaction_id.")"; } else { echo "Cheque (".$row->cheque_no.")"; } ?></td>
          <td><?php echo date_format(date_create($row->salary_date), "d-m-Y"); ?></td>
          <td><?php 
		  $salary_id = $row->salary_id; 
		  $sal_details = $this->db->query("select * from td_salary_details where salary_id='$salary_id'")->result();
		  if($sal_details) { foreach($sal_details as $sal_detail) { 
		  $salary_head_id = $sal_detail->salary_head_id;
		  $head_detail = $this->db->query("select * from td_salary_head where salary_head_id='$salary_head_id'")->row();
		  $details = "<strong>".$head_detail->salary_head_name."</strong> : ".$sal_detail->salary_head_value." ";
		  $details .= ($sal_detail->salary_head_type=='E')?' (+)':' (-)';
		  $details .= "<br>";
		  echo $details;
		  } } 
		  ?></td>
          <td><?php echo $row->total_salary; ?></td>
        </tr>

     <?php  } } else { ?>

     	<tr><td colspan="6" align="center">No records found</td></tr>	

     <?php  } ?>

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