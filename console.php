<html>
<head>
<title>Console</title>
</head>
<body>

<?php


	function isNumeric($valor){
		return ereg('^[0-9]+$', $valor);
	}


	echo isNumeric("2016222a22");

?>

</body>
</html>