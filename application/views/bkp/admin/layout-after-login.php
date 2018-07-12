<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $head; ?>
</head>
<body>
<!-- Main navbar -->
<?php echo $header; ?>
<!-- /main navbar -->

<!-- Page container -->
<div class="page-container" style="min-height:700px">

	<!-- Page content -->
	<div class="page-content">
    
        <!-- Main sidebar -->
        <?php echo $left_sidebar; ?>
        <!-- /main sidebar -->
	
        <!-- Main content -->
    
        <div class="content-wrapper">
    
        <?php echo $maincontent; ?>
    
        </div>
        
        <!-- /main content -->
            
        </div>
	<!-- /page content -->

</div>
<!-- /page container -->
</body>
</html>