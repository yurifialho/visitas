<?php 
#--------------------------------------------------------------------------
# login.PHP
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
if(!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == ""){
    $redirect = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: $redirect");
}

  session_start(); 
  
  require_once "includes/commons.php";
  require_once "includes/database.config.php";
	
  $url_entrada = "views/reserva/reserva_lista.php";
  
  #verificar se ja esta autenticado
  if(isset($_SESSION['idusuario'])) {
  	header('Location: '.$url_entrada);
  }
  
  $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
  $senha   = isset($_POST['senha']) ? $_POST['senha'] : null;
	
  if($usuario != "" && isset($senha)) {
  	
  	
  		$objUsuario = Usuario::find('first', array('conditions' => "login = '$usuario' and senha = md5('$senha')"));
  		if($objUsuario) {
  			$_SESSION['idusuario'] = $objUsuario->id;
  			$_SESSION['nomeusuario'] = $objUsuario->login;
  			$_COOKIE['idusuario'] = $objUsuario->id;
  			header('Location: '.$url_entrada);
  		} else {
  			$msg_erro = "Usuario ou senha invalida!!";
  		}
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
      echo "<link rel='shortcut icon' type='image/x-icon' href='".$BASE."images/10rm.ico'></link>";
    ?>
    <title>VISITA - LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <style type="text/css">
      body { 
        background-image: url("images/QG10RM_reduzido.jpg");
        background-size: 100%;  
       }
    </style>
  </head>
  <body>
    <?php if(isset($msg_erro)) { ?>  
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <strong>Erro!</strong> <?php echo $msg_erro ?>
      </div>
    <?php } ?>
    <div class="container">
      <form class="form-signin" role="form" action="login.php" method="post">
        <h2 class="form-signin-heading">Visitas</h2>
        <label for="input" class="sr-only">Usuário</label>
        <input type="input" id="input" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="senha" name="senha" class="form-control" placeholder="Senha" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>
    </div> <!-- /container -->
    
   <nav class="navbar navbar-default navbar-fixed-bottom">
  <div class="container" style="padding-bottom: 1%;">
    Copyright © 2016 - 10ª Região Militar - Seção de Tecnologia e Informática
  </div>
</nav>
  </body>
</html>
