<!-- Page container -->

<div class="page-container"> 
  
  <!-- Page content -->
  <div class="page-content"> 
    <!-- Main content -->
    <div class="content-wrapper"> 
      
      <!-- Page header -->
      <div class="page-header">
        <div class="page-header-content">
          <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold"><?php echo $action; ?></span> salary head value</h4>
          </div>
        </div>
        <div class="breadcrumb-line breadcrumb-line-component">
          <ul class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>user"><i class="icon-home2 position-left"></i> Dashboard</a></li>
            <li><a href="<?php echo base_url(); ?>manage_salary_head_value">Manage salary head value</a></li>
            <li class="active"><?php echo $action; ?> salary head value</li>
          </ul>
        </div>
      </div>
      <!-- /page header --> 
      
      <!-- Content area -->
      <div class="content"> 
        
        <!-- Form validation -->
        <div class="panel panel-flat">
          <div class="panel-heading">
            <!--<h5 class="panel-title">Form validation</h5>-->
            <div class="heading-elements">
              <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
              </ul>
            </div>
          </div>
          <div class="panel-body">
            <?php $attributes = array('class' => 'form-horizontal', 'id' => 'salary-head-value-form');echo form_open_multipart('',$attributes); ?>
            <?php
				if(isset($row)){  
					$emp_id = $row->emp_id;
					$basic_pay = $row->basic_pay;
					$total = $row->total;
				} else {
					$emp_id = '';
					$basic_pay = '';
					$total = '';
				}
			?>
              <input type="hidden" name="mode" value="tab" />
              <fieldset class="content-group">
              <legend class="text-bold">Salary head value Inputs</legend>
              
              <!-- Basic text input -->
              <div class="form-group">
                <label class="control-label col-lg-3">Employee Name <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <?php 
					$js = 'class="form-control" id=emp_id';
					echo form_dropdown('emp_id',$emps,$emp_id,$js);
					echo form_error('emp_id'); 
				  ?>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-lg-3">Basic Pay <span class="text-danger">*</span></label>
                <div class="col-lg-9">
                  <input type="text" name="basic_pay" value="<?php if($action == 'Edit'){echo $basic_pay;} else {echo set_value('basic_pay');} ?>" class="form-control" placeholder="Enter Basic Pay" id="basic_pay">
                  <?php echo form_error('basic_pay'); ?>
                </div>
              </div>
              
              <div class="col-sm-6">
                <table class="full-width">
                    <thead>
                        <tr>
                            <th colspan="2">EARNING</th>
                        </tr>
                    </thead>
                    <tbody class="earning"></tbody>
                </table>
                </div>
                <div class="col-sm-6">
                    <table class="full-width">
                        <thead>
                            <tr>
                                <th colspan="2">DEDUCTION</th>
                            </tr>
                        </thead>
                        <tbody class="deduction"></tbody>
                    </table>
                </div>
                <div class="col-sm-12" style="padding-top:10px;">
                    <label class="control-label col-lg-3">Total <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                      <input type="text" name="total" value="<?php if($action == 'Edit'){echo $total;} else {echo set_value('total');} ?>" class="form-control" placeholder="Enter total" id="total">
                      <?php echo form_error('total'); ?>
                    </div>
                 </div>
              
             </fieldset> 
              <div class="text-right">
                <button type="submit" class="btn btn-primary" id="btn_add">Submit <i class="icon-arrow-right14 position-right"></i></button>
              </div>
            <?php echo form_close(); ?>
          </div>
        </div>
        <!-- /form validation --> 
        
       <!-- Footer -->
    <div class="footer text-muted"> 
      <?php echo $footer; ?>
    </div>
    <!-- /footer -->
        
      </div>
      <!-- /content area --> 
      
    </div>
    <!-- /main content --> 
    
  </div>
  <!-- /page content --> 
  
</div>
<!-- /page container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
//////////////////////////////For Load dropdown/////////////////////////////////////
$(document).on('ready', function (e) {
	
   	var data = $('#salary-head-value-form').serialize();
   
	
	td_name = 'td_salary_head';
	$.ajax({
        type: "POST",
        cache: false,
        data: {tb_name:td_name},
        url: "<?php echo base_url(); ?>manage_salary_head_value/head_generate",
        success: function (data) {
				for(var i in data) {
					//console.log(data[i].salary_head_type);
					if(data[i].salary_head_type=='E') {
						htE = '<tr><td>'+data[i].salary_head_name+'</td><td><input type="hidden" name="salary_head_id[]" value="'+data[i].salary_head_id+'"><input type="number" style="padding-bottom:3px;" name="salary_head_value[]" value="0" id="" class="form-control"';
						if(data[i].is_fixed_percent==1) { 
						htE += ' data-percentage-autocalculate="'+data[i].percent_rate+'" data-calculate="+"';
						}
						else {
						htE += ' data-manual-calculate data-calculate="+"';	
						}
						htE += '></td></tr>';												
						$(".earning").append(htE);
					}
					else if(data[i].salary_head_type=='D') {
						htD = '<tr><td>'+data[i].salary_head_name+'</td><td><input type="hidden" name="salary_head_id[]" value="'+data[i].salary_head_id+'"><input type="number" style="padding-bottom:3px;" name="salary_head_value[]" value="0" id="" class="form-control"';
						if(data[i].is_fixed_percent==1) { 
						htD += ' data-percentage-autocalculate="'+data[i].percent_rate+'" data-calculate="-"';
						}
						else {
						htD += ' data-manual-calculate data-calculate="-"';	
						}
						htD += '></td></tr>';												
						$(".deduction").append(htD);
					}
  				}
					
				$('#basic_pay, [data-manual-calculate]').on('input', function() {
					bp = parseFloat($('#basic_pay').val()? $('#basic_pay').val():0);
					var tot=bp;
					$('[data-percentage-autocalculate]').each(function() {
						per = bp * parseFloat($(this).data('percentage-autocalculate'))/100;						
						$(this).val(per);
						if($(this).data('calculate')=='+') {
							tot += per;
						}
						else if($(this).data('calculate')=='-') {
							tot -= per;
						} 
						//console.log(tot);
					});	
					$('[data-manual-calculate]').each(function() {
						if($(this).data('calculate')=='+') {
							tot += parseFloat($(this).val());
						}
						else if($(this).data('calculate')=='-') {
							tot -= parseFloat($(this).val());
						}
						//console.log(tot); 
					});
					$('#total').val(tot);
				});
				
		}
    });
});

//////////////////////////////For Load dropdown/////////////////////////////////////

/////////////////////////Add Data//////////////////////////
    $("#btn_add").click(function (e) {
        e.preventDefault();
		var data=$('#salary-head-value-form').serialize();		
		
        $.ajax({
            type: "POST",
            cache: false,
            dataType: 'json',
			data: data,
            url: "<?php echo base_url(); ?>manage_salary_head_value/salary_head_value_add",
            success: function (data) {
                 window.location.href = "<?php echo base_url(); ?>manage_salary_head_value";
            },
			error: function (data) {
                 window.location.href = "<?php echo base_url(); ?>manage_salary_head_value";
            }
        });

    });
/////////////////////////Add//////////////////////////
</script>
