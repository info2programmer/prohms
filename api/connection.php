<?php
error_reporting(0);
session_start();

date_default_timezone_set('Asia/Calcutta');
$con=mysql_connect("localhost","root","") or die(mysql_error());
mysql_select_db("db_bonggeneers",$con) or die(mysql_error());

?>