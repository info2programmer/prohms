<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $head; ?>
</head>

<body>

<!-- Main navbar -->
<div class="navbar navbar-default header-highlight">
  <?php echo $header; ?>
</div>
<!-- /main navbar --> 

<!-- Page container -->
<div class="page-container"> 
  
  <!-- Page content -->
  <div class="page-content"> 
    
    <!-- Main sidebar -->
    <div class="sidebar sidebar-main">
      <?php echo $left_sidebar; ?>
    </div>
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
