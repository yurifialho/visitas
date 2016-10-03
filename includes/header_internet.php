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
  header('Content-Type: text/html; charset=iso-8859-1');
  require_once "commons.php";
  require_once "database.config.php";

/* 
 * Yuri Fialho - 11/07/2016 - Removido pois o certificado estava gerando
 * transtornos. 
  if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
  }  
*/
    
	if(session_id() == '' || !isset($_SESSION)) {		
		session_start();
	}
 	
 	setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
 	header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	  <meta charset="utf-8">
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
  