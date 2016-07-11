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
 
	#verifica se usuario esta logado
	if(!isset($_SESSION['idusuario'])) {
		header("Location: ".$BASE."logout.php");	
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
  echo "<script src='".$BASE."js/jquery.complexify.min.js'></script>";
  echo "<script src='".$BASE."js/jquery.complexify.banlist.js'></script>";
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
            <li><a href="<?php echo $BASE ?>views/usuario/usuario_lista.php">Usuario</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Controle Reserva<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo $BASE ?>views/reserva/reserva_lista.php">Reserva</a></li>
            <li><a href="<?php echo $BASE ?>views/internet/internet_reserva_lista.php">Reserva - Modo Internet</a></li>
          </ul>
        </li>
        <li><a href="<?php echo $BASE ?>logout.php">Sair ( <?php echo $_SESSION['nomeusuario'] ?> )</a></li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<div class="container">
  