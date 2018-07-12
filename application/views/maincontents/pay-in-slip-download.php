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
		.autogap{
		margin-bottom:0.5in;	
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

        body > table {background: url(<?php echo base_url(); ?>uploads/logo1482000521.png) 10px 10px no-repeat; background-size: auto 70px; width: 8in;}
		
		@media print {
			body > table {background: url(<?php echo base_url(); ?>uploads/logo1482000521.png) 10px 10px no-repeat;background-size: auto 70px;width: 100%;}
			.autogap{
				margin-bottom:0;	
			}
		}

    </style>
</head>
<body class="pay-in-slip-form">
<form method="post" id="pay-in-slip-form">
   <input type="hidden" name="tb_name" id="tb_name" value="td_salary">
   <input type="hidden" name="month_year" id="month_year" value="<?php echo $month_year; ?>">                
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
$(document).on('ready', function (e) {  
		month_year = $('#month_year').val();
		
    $.ajax({
        type: "POST",
        cache: false,
		datatype:"html",
        data: {month_year:month_year},
        url: "<?php echo base_url(); ?>generate_salary/payroll_details",
        success: function (data) {
            $('body').append(data);
        }
    });		
	
});
</script>
</body>
</html>