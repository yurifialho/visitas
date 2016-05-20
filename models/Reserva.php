<?php
#--------------------------------------------------------------------------
# RESERVA.PHP
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 03/02/2016
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

require_once dirname(__FILE__) . '/../libs/phpactiverecord/ActiveRecord.php';

class Reserva extends ActiveRecord\Model {
	#config
	static $table_name = 'reserva';
	#relacionamentos
	static $belongs_to = array(
		array('situacao', 'class_name' => 'ReservaSituacao', 
								  'foreign_key' => 'reserva_situacao_id'),
		array('transporte', 'class_name' => 'TransporteTipo', 
								  'foreign_key' => 'transporte_tipo_id'),
		array('escolaridade', 'class_name' => 'EscolaridadeTipo', 
								  'foreign_key' => 'escolaridade_tipo_id'),
		array('usuario', 'class_name' => 'Usuario', 
								  'foreign_key' => 'usuario_id'),
		array('disponibilidade')
	);
	
}

?>