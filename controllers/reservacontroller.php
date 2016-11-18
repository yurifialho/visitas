<?php
#--------------------------------------------------------------------------
# reservacontroller.php
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
	require_once "../helpers/mail_helper.php";
	require_once "../helpers/application_helper.php";

	session_start();
	
	if(isset($_SESSION['idusuario'])) {
		$usuarioid = $_SESSION['idusuario'];
	}

	$msg="";
	$msg_erro="";

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
		$transp		= isset($_POST['transportetipo']) ? $_POST['transportetipo'] : NULL;
		$nrtransp	= isset($_POST['nrtransp']) ? $_POST['nrtransp'] : NULL;
		$escolaridade = isset($_POST['escolaridadetipo']) ? $_POST['escolaridadetipo'] : NULL;
		$sit_reserva = isset($_POST['sit_reserva']) ? $_POST['sit_reserva'] : NULL;
	} else {
		$action    = isset($_GET['action']) ? $_GET['action'] : NULL;
		$id 	   = isset($_GET['id']) ? $_GET['id'] : NULL;
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
		if($sit_reserva != NULL){
			$query .= "&sit_reserva=$sit_reserva";
		}
	} elseif($action == "delete") {
		$dispo = Disponibilidade::find($disponibilidade_id);
		if($dispo != null && $dispo->reserva != null) {
			$reserva = $dispo->reserva;
			if($reserva->delete()) {
				$msg = "Objeto excluído com sucesso!";
				$mail = new MailHelper();
				$mail->sendCancelamentoAgendamento($reserva->email, $reserva->entidade,
					$reserva->disponibilidade->data, $reserva->disponibilidade->hora);
			} else {
				$msg_erro = "Nao foi possivel excluir objeto!";
			}
		}
	} elseif($action == "new") {
		if($data != NULL && $hora != NULL) {
			$dispo = new Disponibilidade();
			$dispo->data = DateTime::createFromFormat('d/m/Y',$data);
			$dispo->hora = $hora;
			
			if($dispo->save()){
				$msg = "Objeto salvo com sucesso!";
			} else {
				$msg_erro = "Nao foi possivel salvar objeto!";
			}
		} else {
			$msg_erro = "Data e Hora sao obrigatorias!";
		}
	} elseif($action == "update") {
		$reserva = Reserva::find($id);
		
		if($reserva != null) {
			$reserva->entidade = $entidade;
			$reserva->nome = $nome;
			$reserva->telefone = $telefone;
			$reserva->celular = $celular;
			$reserva->email = $email;
			$reserva->quantidade = $quantidade;
			$reserva->transporte_tipo_id = $transp;
			$reserva->transporte_numero = $nrtransp;
			$reserva->escolaridade_tipo_id = $escolaridade;
			
			if($reserva->save()){
				$msg = "Objeto salvo com sucesso!";
			} else {
				$msg_erro = "Nao foi possivel salvar objeto!";
			}
		}
	} elseif($action == "confirmar") {
		$dispo = Disponibilidade::find($disponibilidade_id);
		
		
		if($dispo != null && $dispo->reserva != null) {
			$reserva = $dispo->reserva;
			$reserva->reserva_situacao_id = 2; #Confirmado
			
			if($reserva->save()){
				$msg = "Objeto salvo com sucesso!";

				$mail = new MailHelper();
				$mail->sendConfirmacaoAgendamento($reserva->email,
					$reserva->entidade, $dispo->data, $dispo->hora);
			} else {
				$msg_erro = "Nao foi possivel salvar objeto!";
			}
		} else {
			$msg_erro = "Objeto nao foi localizado!";
		}
	} elseif($action == "agendar") {
		$reserva = new Reserva();
		$reserva->entidade = $entidade;
		$reserva->nome = $nome;
		$reserva->telefone = $telefone;
		$reserva->celular = $celular;
		$reserva->email = $email;
		$reserva->quantidade = $quantidade;
		$reserva->disponibilidade_id = $disponibilidade_id;
		$reserva->reserva_situacao_id = 3; #Aguardando Confirmacao
		$reserva->transporte_tipo_id = $transp;
		$reserva->transporte_numero = $nrtransp;
		$reserva->escolaridade_tipo_id = $escolaridade;

		if($reserva->save()){
			$msg = "Objeto salvo com sucesso! A reserva se encontra em analise para aprovacao. $resp";

			$dispo = Disponibilidade::find($disponibilidade_id);
			$mail = new MailHelper();
			$resp = $mail->sendAgendamento($email, $entidade ,$dispo->data, $dispo->hora);
			
		} else {
			$msg_erro = "Nao foi possivel salvar objeto!";
		}
		
	}  	
	
	header('Location: '."../views/reserva/reserva_lista.php?msg=$msg&msg_erro=$msg_erro&a=1$query");	
	
?>