<?php 
	$a_date = "2016-03-23";
	$fim = date("t", strtotime($a_date));

	for($i =1; $i < $fim; $i++) {
		$nova_data = "2016-03-$i";
		echo date("Y-m-d", strtotime($nova_data));
		echo "<br/>";
	}
?>