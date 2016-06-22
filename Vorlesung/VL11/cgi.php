<?php
	$params = array();

	if ($_SERVER["REQUEST_METHOD"]=="GET") {
		$params = $_GET; 
		echo ("(mit GET übermittelt)\n");
	}
	else if ($_SERVER["REQUEST_METHOD"]=="POST") {
		$params = $_POST; 
		echo ("(mit POST übermittelt)\n");
	}

	echo json_encode($params);
 ?>	