<?php 
function numtowords($num){ 
$decones = array( 
            '01' => "One", 
            '02' => "Two", 
            '03' => "Three", 
            '04' => "Four", 
            '05' => "Five", 
            '06' => "Six", 
            '07' => "Seven", 
            '08' => "Eight", 
            '09' => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            );
$ones = array( 
            0 => " ",
            1 => "One",     
            2 => "Two", 
            3 => "Three", 
            4 => "Four", 
            5 => "Five", 
            6 => "Six", 
            7 => "Seven", 
            8 => "Eight", 
            9 => "Nine", 
            10 => "Ten", 
            11 => "Eleven", 
            12 => "Twelve", 
            13 => "Thirteen", 
            14 => "Fourteen", 
            15 => "Fifteen", 
            16 => "Sixteen", 
            17 => "Seventeen", 
            18 => "Eighteen", 
            19 => "Nineteen" 
            ); 
$tens = array( 
            0 => "",
            2 => "Twenty", 
            3 => "Thirty", 
            4 => "Forty", 
            5 => "Fifty", 
            6 => "Sixty", 
            7 => "Seventy", 
            8 => "Eighty", 
            9 => "Ninety" 
            ); 
$hundreds = array( 
            "Hundred", 
            "Thousand", 
            "Million", 
            "Billion", 
            "Trillion", 
            "Quadrillion" 
            ); //limit t quadrillion 
$num = number_format($num,2,".",","); 
$num_arr = explode(".",$num); 
$wholenum = $num_arr[0]; 
$decnum = $num_arr[1]; 
$whole_arr = array_reverse(explode(",",$wholenum)); 
krsort($whole_arr); 
$rettxt = ""; 
foreach($whole_arr as $key => $i){ 
    if($i < 20){ 
        $rettxt .= $ones[$i]; 
    }
    elseif($i < 100){ 
        $rettxt .= $tens[substr($i,0,1)]; 
        $rettxt .= " ".$ones[substr($i,1,1)]; 
    }
    else{ 
        $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        $rettxt .= " ".$tens[substr($i,1,1)]; 
        $rettxt .= " ".$ones[substr($i,2,1)]; 
    } 
    if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
    } 

} 
$rettxt = "Rupees ".$rettxt;

if($decnum > 0){ 
    $rettxt .= " and "; 
    if($decnum < 20){ 
        $rettxt .= $decones[$decnum]; 
    }
    elseif($decnum < 100){ 
        $rettxt .= $tens[substr($decnum,0,1)]; 
        $rettxt .= " ".$ones[substr($decnum,1,1)]; 
    }
    $rettxt = $rettxt." Paise"; 
} 
return $rettxt;}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payslip</title>
    <style>
        body {
            padding: 10px;
            margin: 0
        }

        body * {
            position: relative;
            font-family: Arial, SansSerif;
        }

        table {
            page-break-inside: avoid;
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            border: 1px solid;
            vertical-align: top;
        }

        table th {
            font-weight: normal;
            font-size: 12px
        }

        table th, table td {
            padding: 3px 7px;
            vertical-align: top;
        }

        table thead {
            border: 1px solid;
            border-bottom: 0px solid
        }

        table table {border: 0px solid}

        .bordered {
            border: 1px solid
        }

        .no-pad {
            padding: 0;
        }

        .extra-pad {
            padding: 7px;
        }

        .center {
            text-align: center
        }

        .right {
            text-align: right;
        }

        .header {
            font-size: 18px;
            font-weight: bold
        }

        .secondary-header {
            font-size: 14px;
            font-weight: bold
        }

        .subheader {
            font-size: 12px;
            font-weight: bold
        }

        .no-border {border: 0px solid}
        .no-left-border {border-left: 0px solid}
        .no-right-border {border-right: 0px solid}
        .no-top-border {border-top: 0px solid}
        .no-bottom-border {border-bottom: 0px solid}
        .left-border {border-left: 1px solid}
        .right-border {border-right: 1px solid}
        .top-border {border-top: 1px solid}
        .bottom-border {border-bottom: 1px solid}

        .signature-box-left, .signature-box-right {display: block; width: 65%; height: 80px; border-bottom: 1px solid}
        .signature-box-right {margin-left: auto; margin-right: 0}

        body > table {/*background: url(<?php echo base_url().'uploads/'.$rows_company->com_logo?>) 10px 10px no-repeat;*/ background-size: auto 70px; width: 8in;}
		
		@media print {
			body > table {width: 100%}
		}

    </style>
</head>
<body>

<table align="center">
    <thead>
    <tr>
        <th class="header center" colspan="6"><?php echo $rows_company->com_name;?></th>
    </tr>
    <tr>
        <th class="center" colspan="6"><?php echo $rows_company->com_address;?></th>
    </tr>
    <tr>
        <th class="center" colspan="6"><?php echo $rows_company->com_phone." | ".$rows_company->com_email;?><br></th>
    </tr>
    <tr>
        <th class="secondary-header center" colspan="6"><?php if($rows->emp_skill=='S'){echo 'Pay ';}else{echo 'Wages ';}?>Slip for the period of <?php echo date_format(date_create($rows->from_date), "F"); ?> <?php echo date_format(date_create($rows->from_date), "Y"); ?></th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <td>Employee ID</td>
        <td>:</td>
        <td><?php echo $rows->emp_code;?></td>
        <td>Name</td>
        <td>:</td>
        <td><?php echo $rows->emp_name;?></td>
    </tr>
    <tr>
        <td>Department</td>
        <td>:</td>
        <td><?php echo $rows->department_name;?></td>
        <td>Designation</td>
        <td>:</td>
        <td><?php echo $rows->designation_name;?></td>
    </tr>
    <tr>
        <td>Date Of Joining</td>
        <td>:</td>
        <td><?php echo $rows->joining_date;?></td>
        <td>PF Account Number</td>
        <td>:</td>
        <td><?php echo $rows->epf_no;?></td>
    </tr>
    <tr>
        <td>Day Worked</td>
        <td>:</td>
        <td><?php //echo $rows->emp_name;?></td>
        <td>ESI Account Number</td>
        <td>:</td>
        <td><?php echo $rows->esi_no;?></td>
    </tr>
    <tr>
        <td>Bank Account Number</td>
        <td>:</td>
        <td><?php echo $rows->bank_acc_no;?></td>
        <td>Father's Name</td>
        <td>:</td>
        <td><?php echo $rows->father_name;?></td>
    </tr>
    <tr>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border">
            <table>
                <tr>
                	<?php
					  $late = 1;  
					  $emp_id = $rows->emp_id;
					  $sal_details = $this->db->query("select * from td_salary where salary_id='$id'")->row();
					  $from_date =$sal_details->from_date;
					  $to_date =$sal_details->to_date;
					  $late_details = $this->db->query("select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `late_id` LIKE  '%$emp_id%'")->result();
					  $late_count = $this->db->query("select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `late_id` LIKE  '%$emp_id%'")->num_rows();
					?>
                    <td width="75%" class="subheader extra-pad">Late ( <?php echo $late_count; ?> )</td>
                    <td width="25%" class="subheader extra-pad right">Date</td>
                </tr>
            </table>
        </td>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
            <table>
                <tr>
                	<?php
					  $absent = 1;
					  $absent_details = $this->db->query("select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `present_id` NOT LIKE  '%$emp_id%'")->result();
					  $absent_count = $this->db->query("select * from td_attendance where attendance_date>='$from_date' and attendance_date<='$to_date' and `present_id` NOT LIKE  '%$emp_id%'")->num_rows();
					?>
                    <td width="50%" class="subheader extra-pad">Absent ( <?php echo $absent_count; ?> )</td>
                    <td width="75%" class="subheader extra-pad right">Date</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="no-pad right-border">
            <table>
              	<?php if($late_details) {  foreach($late_details as $late_detail) {  ?>	
                <tr>
                    <td width="50%"><?php echo $late++; ?></td>
                    <td width="50%" class="right"><?php echo date_format(date_create($late_detail->attendance_date), "d-m-Y"); ?></td>
                </tr>
                <?php } } ?>
            </table>
        </td>
      <td colspan="3" class="no-pad">
            <table>
            	<?php if($absent_details) {  foreach($absent_details as $absent_detail) {  ?>	
                <tr>
                    <td width="50%"><?php echo $absent++; ?></td>
                    <td width="50%" class="right"><?php echo date_format(date_create($absent_detail->attendance_date), "d-m-Y"); ?></td>
                </tr>
               <?php } } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border">
            <table>
                <tr>
                    <td width="75%" class="subheader extra-pad">Earning</td>
                    <td width="25%" class="subheader extra-pad right">Amount</td>
                </tr>
            </table>
        </td>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
            <table>
                <tr>
                    <td width="50%" class="subheader extra-pad">Deduction</td>
                    <td width="75%" class="subheader extra-pad right">Amount</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="no-pad right-border">
            <table>
             <?php 
			   if($rows_ern){
			       foreach($rows_ern as $row_ern)
				   {
				   $arr_ern_amt[]=$row_ern->salary_head_value;
			   ?>
                <tr>
                    <td width="75%"><?php echo $row_ern->salary_head_name;?></td>
                    <td width="25%" class="right"><?php echo $row_ern->salary_head_value;?></td>
                </tr>
               <?php }}?> 
            </table>
        </td>
        <td colspan="3" class="no-pad">
            <table>
            <?php 
$count_leave_withoutpay=$this->db->query("select * from td_leave_assign where td_leave_assign.emp_id='$rows->emp_id' and leave_date>='".$rows->from_date."' and leave_date<='".$rows->to_date."' and leave_left<0")->num_rows();
$sal_withoutpay_oneday=array_sum($arr_ern_amt)/30;
$sal_withoutpay=$sal_withoutpay_oneday*$count_leave_withoutpay;
?>
            <?php 
			   if($rows_ded){
			       foreach($rows_ded as $row_ded)
				   {
				   $arr_ded_amt[]=$row_ded->salary_head_value;
			   ?>
                <tr>
                    <td width="75%"><?php echo $row_ded->salary_head_name;?></td>
                    <td width="25%" class="right"><?php echo $row_ded->salary_head_value;?></td>
                </tr>
            <?php }}?>
            <?php 
			/*if($count_leave_withoutpay>0)
			{
			?>
               <tr>
                    <td width="75%">Leave Deduction</td>
                    <td width="25%" class="right"><?php echo $sal_withoutpay;?></td>
                </tr>
             <?php }*/?>   
            </table>
        </td>
    </tr>
    <tr>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border">
            <table>
                <tr>
                    <td width="75%" class="subheader extra-pad">Total Earning</td>
                    <td width="25%" class="subheader extra-pad right"><?php if($rows_ern){$tot_ern=array_sum($arr_ern_amt);}else{$tot_ern=0;}echo $tot_ern?></td>
                </tr>
            </table>
        </td>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
            <table>
                <tr>
                    <td width="75%" class="subheader extra-pad">Total Deduction</td>
                    <td width="25%" class="subheader extra-pad right"><?php if($rows_ded){if($count_leave_withoutpay>0){$tot_ded=array_sum($arr_ded_amt);}else{ $tot_ded=array_sum($arr_ded_amt);}}else{$tot_ded=0;}echo $tot_ded;?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
            <table>
                <tr>
                    <td width="50%" class="subheader extra-pad"></td>
                    <td width="25%" class="subheader extra-pad right">&nbsp;</td>
                    <td width="25%" class="subheader extra-pad right"></td>
                </tr>
            </table>
        </td>
        <td width="50%" colspan="3" class="no-pad bordered no-left-border no-right-border">
            <table>
                <tr>
                    <td width="50%" class="subheader extra-pad">Net Pay (Rounded)</td>
                    <td width="25%" class="subheader extra-pad right">&nbsp;</td>
                    <td width="25%" class="subheader extra-pad right"><?php echo $net_pay=$tot_ern-$tot_ded;?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="bottom-border">
        <td colspan="6" class="extra-pad">
            <strong>Amount in words:</strong>
            <?php echo numtowords($net_pay);?> Only
        </td>
    </tr>
    <tr class="bottom-border">
        <td colspan="6" class="extra-pad">
            <strong>Note:</strong>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="extra-pad">
            <div class="signature-box-left"></div>
            Employer's Signature
        </td>
        <td colspan="3" class="extra-pad right">
            <div class="signature-box-right"></div>
            Employee's Signature
        </td>
    </tr>
    </tbody>
</table>
</body>
</html>