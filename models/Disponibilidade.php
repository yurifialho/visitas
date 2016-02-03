<?php
#--------------------------------------------------------------------------
# DISPONIBILIDADE.PHP
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 03/02/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

require_once dirname(__FILE__) . '/../libs/phpactiverecord/ActiveRecord.php';

class Disponibilidade extends ActiveRecord\Model {
	#config
	static $table_name = 'disponibilidade';
	#relacionamentos
	static $has_one = array(
		array('reserva')
	);
	static $belongs_to = array(
		array('usuario', 'class_name' => 'Usuario', 
								  'foreign_key' => 'usuario_id')
	);
}

?>