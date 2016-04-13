<?php
// MIME-Type der Antwort definieren (*vor* allem HTML):
header ("Content-type: text/html");  
// alle möglichen Fehlermeldungen aktivieren:
error_reporting (E_ALL);

echo <<<EOT
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8" />
    <title>CGI-Formular-Echo</title>
</head>
<body>
	<h1>Formular-Echo</h1>
	<p>Sie haben folgende Formulardaten mit der Methode 
EOT;
if ($_SERVER["REQUEST_METHOD"]=="GET") {
	$Params = $_GET;
	echo "GET";
}
else if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$Params = $_POST;
	echo "POST";
}
echo " übermittelt:</p>\n";
echo "	<p>\n";

foreach($Params as $key => $value) {
	echo ("$key=$value<br />\n");
}
echo <<<EOT
	</p>
</body>
</html>
EOT;
