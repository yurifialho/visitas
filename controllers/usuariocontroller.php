<?php
#--------------------------------------------------------------------------
# disponibilidadecontroller.php
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 03/02/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
# Recebe as requisicoes da view e trata.
#-------------------------------------------------------------------------- 
	require_once "../includes/database.config.php";

	session_start();
	
	if(isset($_SESSION['idusuario'])) {
		$usuarioid = $_SESSION['idusuario'];
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    	$action    = $_POST['action'];
		$id 	   = isset($_POST['id']) ? $_POST['id'] : NULL;
		$login	   = isset($_POST['login']) ? $_POST['login'] : NULL;
		$senha     = isset($_POST['senha']) ? $_POST['senha'] : NULL;

	} else {
		$action    = $_GET['action'];
		$id 	   = $_GET['id'];
	}
	
	if($action == "delete") {
		$usuario = Usuario::find($id);
		
		if($usuario->delete()) {
			$msg = "Objeto excluido com sucesso!";
		} else {
			$msg_erro = "Nao foi possivel excluir objeto!";
		}
	} elseif($action == "new") {
		if($login != NULL && $senha != NULL) {
			$usuario = new Usuario();
			$usuario->login = $login;
			$usuario->senha = md5($senha);
			
			if($usuario->save()){
				$msg = "Objeto salvo com sucesso!";
			} else {
				$msg_erro = "Nao foi possível salvar objeto!";
			}
		} else {
			$msg_erro = "Login e Senha são obrigatórias!";
		}
	} elseif($action == "update") {
		$usuario = Usuario::find($id);
		if($usuario != null) {
			$usuario->login = $login;

			if($senha != '') {
				$usuario->senha = md5($senha);
			}
						
			if($usuario->save()){
				$msg = "Objeto salvo com sucesso!";
			} else {
				$msg_erro = "Nao foi possivel salvar objeto!";
			}
		}
	}  	
	
	header('Location: '."../views/usuario/usuario_lista.php?msg=$msg&msg_erro=$msg_erro");	
	
?>