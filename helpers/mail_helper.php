<?php 
#--------------------------------------------------------------------------
# mail_helper.php
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 04/05/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

require_once('../libs/phpmailer/class.phpmailer.php');
	
class MailHelper {
	
	private $config = array();

	function __construct() {
		$this->config = parse_ini_file("../config.php");
	}

	public function sendAgendamento($to, $entidade, $data, $hora) {
		ob_start();
		include $this->config['PATH_TEMPLATE'] . "mail_agenda_template.php";
		$conteudo = ob_get_contents();
		ob_end_clean();

		$msg = sprintf($conteudo, $data->format('d/m/Y'), $hora);

		return $this->sendMailTo($to, "Agendamento Visita", $msg);
	}

	public function sendConfirmacaoAgendamento($to, $entidade, $data, $hora) {

		ob_start();
		include $this->config['PATH_TEMPLATE']. "mail_confirma_template.php";
		$conteudo = ob_get_contents();
		ob_end_clean();

		$msg = sprintf($conteudo, $data->format('d/m/Y'), $hora);

		return $this->sendMailTo($to, "Confirmação de Visita", $msg);
		
	}

	public function sendCancelamentoAgendamento($to, $entidade, $data, $hora) {
		ob_start();
		include $this->config['PATH_TEMPLATE'] . "mail_cancela_template.php";
		$conteudo = ob_get_contents();
		ob_end_clean();

		$msg = sprintf($conteudo, $data->format('d/m/Y'), $hora);

		return $this->sendMailTo($to, "Cancelamento Visita", $msg);
	}

	private function sendMailTo($to, $subject, $msg) {
		try {
			$mail = new PHPMailer();
			$mail->IsSMTP(); // telling the class to use SMTP
			#$mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
			                                           // 1 = errors and messages
			                                           // 2 = messages only
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->AuthType   = "PLAIN";
			$mail->SMTPSecure = 'tls';
			$mail->Host       = $this->config['HOST']; // sets the SMTP server
			$mail->Username   = $this->config['USER']; // SMTP account username
			$mail->Password   = $this->config['PASS']; // SMTP account password
			$mail->SetFrom($this->config['USER'], $this->config['USER_NAME']);
			$mail->AddReplyTo($this->config['USER'], $this->config['USER_NAME']);
			$mail->Subject    = $subject;
			$mail->MsgHTML($msg);

			$address = $to;
			$mail->AddAddress($address, $to);

			if(!$mail->Send()) {
			  return 0;
			} else {
			  return 1;
			}
		} catch (Exception $e) {
			return 0;
		}
	}
}

?>