<?php
#--------------------------------------------------------------------------
# route_helper.php
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 17/05/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
# Recebe as requisicoes da view e trata.
#--------------------------------------------------------------------------
class RouteHelper {

	private $url = "";
	private $msg = "";
	private $msgErro = "";
	private $query = array();

	public function __construct($url){
		$this->url = $url;
	}

	public function addParam($key, $value) {
		array_push($this->query, array($key => $value));
	}

	public function addMsg($msg) {
		$this->msg = $msg;
	}

	public function addMsgErro($msg) {
		$this->msgErro = $msg;
	}

	public function setUrl($value) {
		$this->url;
	}

	public function redirect() {
		$query = "";
		foreach ($this->query as $param) {
			if($query != "") $query .= "&";

			foreach ($param as $key => $value) {
				$query .= $key.'='.$value;
			}
		}
		$this->redirectWithParam($query, $this->msg, $this->msgErro);
	}

	public function redirectWithParam($query = "", $msg = "", $msg_erro = "") {
		$hasParam = false;
		$param1 = "";
		$param2 = "";
		$param3 = "";
		
		if($query != "" || $query != NULL) {
			$param1 = $query;
			$hasParam = true;
		}

		if($msg != "" || $msg != NULL) {
			$param2 = "&msg=" . htmlspecialchars($msg, ENT_COMPAT,'ISO-8859-1', true);
			$hasParam = true;
		}

		if($msg_erro != "" || $msg_erro != NULL) {
			$param3 = "&msg_erro=" . htmlspecialchars($msg_erro, ENT_COMPAT,'ISO-8859-1', true);
			$hasParam = true;
		}
		header('Location: '.$this->url.($hasParam ? "?" : "").$param1.$param2.$param3);
	}
}


?>