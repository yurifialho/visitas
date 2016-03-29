<?php
#--------------------------------------------------------------------------
# TRANSPORTETIPO.PHP
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 03/02/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

require_once dirname(__FILE__) . '/../libs/phpactiverecord/ActiveRecord.php';

class TransporteTipo extends ActiveRecord\Model {
	#config
	static $table_name = 'transporte_tipo';
	#relacionamentos
	static $has_many = array(
			array('reservas')
		);

}

?>