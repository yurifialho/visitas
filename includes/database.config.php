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
	
	require_once dirname(__FILE__) . '/../libs/phpactiverecord/ActiveRecord.php';

	#Load All Models
	$modelsFolders = dirname(__FILE__) . "/../models";

	#Load Config File
	$config = parse_ini_file(dirname(__FILE__) ."/../config.php");

	$username = $config['DB_USER'];
	$password = $config['DB_PASS'];
	$host 	  = $config['DB_HOST'];
	$database = $config['DATABSE'];
	
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