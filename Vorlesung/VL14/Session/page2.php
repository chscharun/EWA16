<?php

	session_start();

	$name = $_SESSION['username'];

	echo <<<HERE
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="UTF-8" />
			<title>Session</title>
		</head>
		<body>
			<p>Your name is still: $name!</p>
		</body>
	</html>
HERE;

?>