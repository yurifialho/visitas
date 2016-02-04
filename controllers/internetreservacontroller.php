<?php
#--------------------------------------------------------------------------
# reservacontroller.php
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2К TEN FIALHO
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
    	$action     = $_POST['action'];
		$id 	    = isset($_POST['id']) ? $_POST['id'] : NULL;
		$disponibilidade_id = isset($_POST['disponibilidade_id']) ? $_POST['disponibilidade_id'] : NULL;
		$entidade   = isset($_POST['entidade']) ? $_POST['entidade'] : NULL;
		$nome       = isset($_POST['nome']) ? $_POST['nome'] : NULL;
		$telefone   = isset($_POST['telefone']) ? $_POST['telefone'] : NULL;
		$celular    = isset($_POST['celular']) ? $_POST['celular'] : NULL;
		$email      = isset($_POST['email']) ? $_POST['email'] : NULL;
		$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : NULL;
		$ano        = isset($_POST['ano']) ? $_POST['ano'] : NULL;
		$mes        = isset($_POST['mes']) ? $_POST['mes'] : NULL;
	} else {
		$action    = $_GET['action'];
		$id 	   = $_GET['id'];
		$disponibilidade_id = isset($_GET['disponibilidade_id']) ? $_GET['disponibilidade_id'] : NULL;
	}
	
	$query = "";
	if($action == "index") {
		if($ano != NULL){
			$query .= "&ano=$ano";
		}
		if($mes != NULL){
			$query .= "&mes=$mes";
		}
	} elseif($action == "agendar") {
		$dispo = Disponibilidade::find($disponibilidade_id);

		if($dispo != null && $dispo->reserva == null) {
			$reserva = new Reserva();
			$reserva->entidade = $entidade;
			$reserva->nome = $nome;
			$reserva->telefone = $telefone;
			$reserva->celular = $celular;
			$reserva->email = $email;
			$reserva->quantidade = $quantidade;
			$reserva->disponibilidade_id = $disponibilidade_id;
			$reserva->reserva_situacao_id = 3; #Aguardando Confirmacao
			
			if($reserva->save()){
				$msg = "Objeto salvo com sucesso! A reserva encontra-se em anсlise para aprovaчуo.";
			} else {
				$msg_erro = "Nao foi possivel salvar objeto!";
			}
		} else {
			$msg_erro = "Essa data jс encontra-se reservada por outra pessoa, por favor tente agendar em outra data!";	
		}
		
	}  	
	
	header('Location: '."../views/internet/internet_reserva_lista.php?msg=$msg&msg_erro=$msg_erro&a=1$query");	
	
?>