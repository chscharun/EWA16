<?php
	
	session_start();

	$name = $_POST['name'];

	if(!isset($name)){
		$name = "Gast";
	}

	$_SESSION['username'] = $name;

	echo <<<HERE
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="UTF-8" />
				<title>Session</title>
			</head>
			<body>
				<p>Hallo $name!</p>
				<div>
					<a href="page2.php">Weiter</a>
				</div> 
			</body>
		</html>
HERE;

?>