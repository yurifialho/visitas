<?php
#--------------------------------------------------------------------------
# logout.PHP
#--------------------------------------------------------------------------
#
# @author: Yuri Fialho - 2º TEN FIALHO
# @since: 03/02/2016
# @contact: yurirfialho@gmail.com
#
#--------------------------------------------------------------------------

session_start();
$_SESSION = array();
session_unset();
session_destroy();


header("Location: login.php");

?>
