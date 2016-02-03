<?php
#--------------------------------------------------------------------------
# USUARIO.PHP
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 03/02/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

require_once dirname(__FILE__) . '/../libs/phpactiverecord/ActiveRecord.php';

class Usuario extends ActiveRecord\Model {
	#config
	static $table_name = 'usuario';
	#relacionamentos
	static $has_many = array(
			array('reservas','disponibilidades')
		);	
}

?>