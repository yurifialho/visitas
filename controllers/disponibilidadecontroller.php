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
	require_once "../includes/commons.php";
	require_once "../includes/database.config.php";
	require_once "../helpers/application_helper.php";
	require_once "../helpers/route_helper.php";

	session_start();
	
	if(isset($_SESSION['idusuario'])) {
		$usuarioid = $_SESSION['idusuario'];
	}

	$router = new RouteHelper("../views/disponibilidade/disponibilidade_lista.php");

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    	$action    = $_POST['action'];
		$id 	   = isset($_POST['id']) ? $_POST['id'] : NULL;
		$data	   = isset($_POST['data']) ? $_POST['data'] : NULL;
		$hora      = isset($_POST['hora']) ? $_POST['hora'] : NULL;
		$ano       = isset($_POST['ano']) ? $_POST['ano'] : NULL;
		$mes       = isset($_POST['mes']) ? $_POST['mes'] : NULL;

	} else {
		$action    = $_GET['action'];
		$id 	   = $_GET['id'];
	}
	
	$query = "";
	if($action == "index") {
		if($data != NULL) {
			$query .= "&data=$data";
		}
		if($hora != NULL){
			$query .= "&hora=$hora";
		}
		if($ano != NULL){
			$query .= "&ano=$ano";
		}
		if($mes != NULL){
			$query .= "&mes=$mes";
		}
	} elseif($action == "delete") {
		$dispo = Disponibilidade::find($id);
		
		if($dispo->delete()) {
			$msg = "Objeto excluido com sucesso!";
		} else {
			$msg_erro = "Nao foi possivel excluir objeto!";
		}
	} elseif($action == "new") {
		if($data != NULL && $hora != NULL) {
			$dispo = new Disponibilidade();
			$dispo->data = DateTime::createFromFormat('d/m/Y',$data);
			$dispo->hora = $hora;
			
			if($dispo->save()){
				$msg = "Objeto salvo com sucesso!";
			} else {
				$msg_erro = "Nao foi possível salvar objeto!";
			}
		} else {
			$msg_erro = "Data e Hora são obrigatórias!";
		}
	} elseif($action == "update") {
		$dispo = Disponibilidade::find($id);
		if($dispo != null) {
			$dispo->data = DateTime::createFromFormat('d/m/Y',$data);
			$dispo->hora = $hora;
			
			if($dispo->save()){
				$msg = "Objeto salvo com sucesso!";
			} else {
				$msg_erro = "Nao foi possivel salvar objeto!";
			}
		}
	} elseif($action == "gerarDisponibilidadeMensal") {
		if($ano == null || $ano == "" || $mes == null || $mes == "") {
			$msg_erro = "Ano e mês são obrigatórios para gerar as disponibilidades!";
		} else {
			$data_inicial = "$ano-$mes-01";
			$fim = date("t", strtotime($data_inicial));

			$query = " data = ? ";

			if(Disponibilidade::count(array('conditions' => array($query, date("Y-m-d", strtotime($data_inicial)))))){
				$msg_erro = "O mês já foi gerado.";
			} else {
				for($i =1; $i < $fim; $i++) {
					$nova_data = "$ano-$mes-$i";
					
					$data_disponivel = date("Y-m-d", strtotime($nova_data));
					if(date('N',strtotime($nova_data)) < 7) {
					for($hora = 8; $hora <= 11; $hora++) { #horario manha
							$dispo = new Disponibilidade();
							$dispo->data = $nova_data;
							$dispo->hora = "$hora:00";

							$dispo->save();
					}
					}
					if(date('N',strtotime($nova_data)) < 6) {
					for($hora = 13; $hora <= 15; $hora++) { #horario tarde
							$dispo = new Disponibilidade();
							$dispo->data = $nova_data;
							$dispo->hora = "$hora:00";

							$dispo->save();
					}
					}
				}
			}
		}
	}

	header('Location: '."../views/disponibilidade/disponibilidade_lista.php?msg=$msg&msg_erro=$msg_erro&a=1$query");	
	
?>
