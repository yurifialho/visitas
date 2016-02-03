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
	
	$BASE = "/visita/";
    
	if(session_id() == '' || !isset($_SESSION)) {		
		session_start();
	}
 
	#verifica se usuario esta logado
	if(!isset($_SESSION['idusuario'])) {
		header("Location: ".$BASE."logout.php");	
	}

?>
<!DOCTYPE html>
<html>
<head>
	
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
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $BASE ?>">Visita</a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
      	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastro Básico <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $BASE ?>views/disponibilidade/disponibilidade_lista.php">Disponibilidade</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Controle Reserva<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $BASE ?>views/reserva/reserva_lista.php">Reserva</a></li>
          </ul>
        </li>
        <li><a href="<?php echo $BASE ?>logout.php">Logout ( <?php echo $_SESSION['nomeusuario'] ?> )</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<div class="container">
  