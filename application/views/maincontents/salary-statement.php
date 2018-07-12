<?php
 
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=salary_statement.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Claim for DPI</title>
<style>

</style>
</head>

<body>
<table width="1191" border="0" height="842" align="center">
  <tr style="text-align:center; text-decoration:underline; font-size:17px;">
    <td height="20" style="text-align:left; width:33.3%;">&nbsp;</td>
    <td height="20" style="width:33.3%;"">PROHRM</td>
    <td height="20" style="text-align:left; width:33.3%;"">&nbsp;</td>
  </tr>
  <tr>
    <td height="20" style="text-align:left; text-decoration:underline; font-size:17px;">&nbsp;</td>
    <td height="20" style="text-align:center; font-weight:bolder; text-decoration:underline; font-size:17px;">Salary Statement for December, 2016</td>
    <td height="20" style="text-align:left; text-decoration:underline; font-size:17px;">&nbsp;</td>
  </tr>

  <tr>
    <td height="20" colspan="3">
    <table width="100%" border="1" cellspacing="0" style="text-align:center;">
 <?php  
 /*if($_REQUEST['department']=='TEACHING STAFF'){$department=1;}else{$department=2;}
 $fetchda= mysql_fetch_array(mysql_query("select * from `emp_pf_setting` where `dept_id`='".$department."'"));*/
 ?>   
  <tr style="text-align:left;">
    <td><strong>Sl. No.</strong></td>
    <td><strong>Name (Emp Code)</strong></td>
    <td><strong>Designation</strong></td>
    <td><strong>Date of Birth</strong></td>
    <td><strong>Date of Joining</strong></td>
    <td><strong>Date of Increment</strong></td>
    <td><strong>Payment Mode</strong></td>
    <td><strong>Basic Pay</strong></td>
    <td><strong>D.A. @65%</strong></td>
    <td><strong>H.R.A.</strong></td>
    <td><strong>M.A.</strong></td>
    <td><strong>Special Allowances</strong></td>
    <td><strong>T.A. to Phy.Challanged</strong></td>
    <td><strong>PF @12%</strong></td>
    <td><strong>ESI</strong></td>
    <td><strong>Total(Rs.)</strong></td>
  </tr>   
  <tr>
    <td>1</td>
    <td style="text-align:left;">Sourav Samanta (WDP/0001)</td>
    <td style="text-align:left;">Web Developer</td>
    <td>21-02-1989</td>
    <td>01-01-2015</td>
    <td>01-02-2016</td>
    <td>Transfer</td>
    <td>10000.00</td>
    <td>6500.00</td>
    <td>400.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1200.00</td>
    <td>1000.00</td>
    <td>17700</td>
  </tr>
  <tr>
    <td>2</td>
    <td style="text-align:left;">Komal Sinha(WDP/0002)</td>
    <td style="text-align:left;">Web Developer</td>
    <td>21-02-1989</td>
    <td>01-01-2015</td>
    <td>01-02-2016</td>
    <td>Transfer</td>
    <td>10000.00</td>
    <td>6500.00</td>
    <td>400.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1200.00</td>
    <td>1000.00</td>
    <td>17700</td>
  </tr>
  <tr>
    <td>3</td>
    <td style="text-align:left;">Syantan Bakshi(WDP/0003)</td>
    <td style="text-align:left;">UI Developer</td>
    <td>21-02-1989</td>
    <td>01-01-2015</td>
    <td>01-02-2016</td>
    <td>Cheque</td>
    <td>10000.00</td>
    <td>6500.00</td>
    <td>400.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1200.00</td>
    <td>1000.00</td>
    <td>17700</td>
  </tr>
  <tr>
    <td>4</td>
    <td style="text-align:left;">Syantan Bakshi(WDP/0003)</td>
    <td style="text-align:left;">UI Developer</td>
    <td>21-02-1989</td>
    <td>01-01-2015</td>
    <td>01-02-2016</td>
    <td>Cash</td>
    <td>10000.00</td>
    <td>6500.00</td>
    <td>400.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1000.00</td>
    <td>1200.00</td>
    <td>1000.00</td>
    <td>17700</td>
  </tr>	
  <tr>
    <td colspan="7"><strong>Grand Total</strong></td>
    <td>40000.00</td>
    <td>26000.00</td>
    <td>1600.00</td>
    <td>4000.00</td>
    <td>4000.00</td>
    <td>4000.00</td>
    <td>4800.00</td>
    <td>4000.00</td>
    <td>70800.00</td>
    <td></td>
  </tr>
</table>
    </td>
  </tr>
  <tr>
    <td height="100"><strong>Accountant :</strong></td>
    <td height="100"><strong>Remarks : </strong></td>
    <td height="100" align="center"><strong>Office Stamp</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>  
</table>





</body>
</html>
