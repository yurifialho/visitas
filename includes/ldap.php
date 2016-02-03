<?php
#--------------------------------------------------------------------------
# ldap.php
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 03/02/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
# Responsável para autenticacao no servidor ldap da 10RM
#--------------------------------------------------------------------------
	
	function checkUserAndPassword($user, $password) {
		$ldap = ldap_connect("ldap://10.100.8.2", '389');
		ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
		ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
		#ldap_set_option($ldap, LDAP_OPT_NETWORK_TIMEOUT, 5);
		#ldap_set_option($ldap, LDAP_OPT_TIMELIMIT, 5);
		$bind = @ldap_bind($ldap, "10RM\\".$user, $password);
		if ($bind) {
			return true;
		} else {
			return false;
		}
	}

?>