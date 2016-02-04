<?php 
#--------------------------------------------------------------------------
# header.php
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
  require_once "commons.php";
	require_once "database.config.php";
    
	if(session_id() == '' || !isset($_SESSION)) {		
		session_start();
	}
 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	  <meta charset="ISO-8859-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Yuri Fialho">
<?php
	echo "<script src='".$BASE."js/jquery-1.11.1.min.js'></script>";
	echo "<script src='".$BASE."js/bootstrap.min.js'></script>";
	echo "<script src='".$BASE."js/bootstrap-datepicker.js'></script>";
  echo "<script src='".$BASE."js/jquery.maskedinput.min.js'></script>";
	echo "<link rel='stylesheet' type='text/css' href='".$BASE."css/bootstrap.min.css'></link>";
	echo "<link rel='stylesheet' type='text/css' href='".$BASE."css/datepicker.css'></link>";
	echo "<link rel='stylesheet' type='text/css' href='".$BASE."css/bootstrap-responsive.css'></link>";
	echo "<link rel='stylesheet' type='text/css' href='".$BASE."css/starter-template.css'></link>";
	echo "<link rel='stylesheet' type='text/css' href='".$BASE."css/datepicker.css'></link>";
  echo "<link rel='shortcut icon' type='image/x-icon' href='".$BASE."images/10rm.ico'></link>";
?>

<style type="text/css">
	.green{color:green;}
	.red{color:red;}
</style>
</head>
<div class="container">
  