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
	require_once "../libs/complexify/Complexify.php";
	require_once "../includes/database.config.php";
	require_once "../helpers/route_helper.php";

	session_start();
	
	if(isset($_SESSION['idusuario'])) {
		$usuarioid = $_SESSION['idusuario'];
	}

	$router = new RouteHelper("../views/usuario/usuario_lista.php");

	function validateForcaSenha($password) {
		global $router;
		$check = new \Complexify\Complexify(array(
    		'minimumChars' => 8,         // the minimum acceptable password length
    	#	'strengthScaleFactor' => 1,  // scale the required password strength (higher numbers require a more complex password)
    	    'banMode' => 'loose',        // strict == don't allow substrings of banned passwords, loose == only ban exact matches
    		'encoding' => 'ISO-8859-1'   // password string encoding
		));

		$result = $check->evaluateSecurity($password);
		if($result->valid) {
			return true;
		} else {
			$router->addMsgErro("Senha muito fraca: " . implode(", ", $result->errors));
			return false;
		}
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
			$router->addMsg("Objeto excluido com sucesso!");
		} else {
			$router->addMsgErro("Nao foi possivel excluir objeto!");
		}
		$router->redirect();
		return;
	} elseif($action == "new") {
		if($login != NULL && $senha != NULL) {
			$usuario = new Usuario();
			$usuario->login = $login;

			#verifica a força da senha
			if(!validateForcaSenha($senha)) {
				$router->redirect(); return;
			}

			$usuario->senha = md5($senha);
			
			if($usuario->save()){
				$router->addMsg("Objeto salvo com sucesso!");
			} else {
				$router->addMsgErro("Nao foi possivel salvar objeto!");
			}
		} else {
			$router->addMsgErro("Login e Senha sao obrigatorias!"); 
		}
		$router->redirect();return;
	} elseif($action == "update") {
		$usuario = Usuario::find($id);
		if($usuario != null) {
			$usuario->login = $login;

			if(validateForcaSenha($senha)) {
				$usuario->senha = md5($senha);
			} else {
				$router->redirect(); return;
			}
						
			if($usuario->save()){
				$router->addMsg("Objeto salvo com sucesso!");
			} else {
				$router->addMsgErro("Nao foi possivel salvar objeto!");
			}
		} else {
			$router->addMsgErro("Usuario nao localizado.");
		}

		$router->redirect(); return;
	}  	
?>