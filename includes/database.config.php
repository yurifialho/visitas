<?php
#--------------------------------------------------------------------------
# DATABASE.CONFIG.PHP
#--------------------------------------------------------------------------
#
#	@author: Yuri Fialho - 2º TEN FIALHO
#	@since: 17/10/2015
#	@contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------
	
	#DB username
	$username = "tenfialho";
	$password = "tenfialho";
	/*$username = "visita";
	$password = ";;visita;;";*/
	$host	  = "127.0.0.1";
	$database = "visita";

	require_once dirname(__FILE__) . '/../libs/phpactiverecord/ActiveRecord.php';

	#Load All Models
	$modelsFolders = dirname(__FILE__) . "/../models";
	
	foreach (scandir($modelsFolders) as $modelsClass) {
		$metaDados = pathinfo($modelsClass);
		if($metaDados['extension'] == "php") {
			require_once $modelsFolders . DIRECTORY_SEPARATOR . $modelsClass;
		}
	}
	
	#Initialize database
	ActiveRecord\Config::initialize(function($cfg) use(&$username, &$password, &$host, &$database)
	{
    	$cfg->set_model_directory('.');
    	$cfg->set_connections(array('development' => "mysql://$username:$password@$host/$database"));
	});

?>