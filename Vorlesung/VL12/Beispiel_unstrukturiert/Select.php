<?php	// UTF-8 marker äöüÄÖÜß€

// Variante 1 (prozedural, sehr unstrukturiert)
// PHP, HTML und SQL stark vermischt

try {
	// alle möglichen Fehlermeldungen aktivieren:
	error_reporting (E_ALL);

	// Datenbank öffnen und abfragen:
	require_once 'pwd.php'; // Passwort & Co. einlesen
	$Connection = new MySQLi($host, $user, $pwd, "reisebuero");

	// Verbindung prüfen:
	if (mysqli_connect_errno())
		throw new Exception("Connect failed: ".mysqli_connect_error());
	if (!$Connection->set_charset("utf8"))
		throw new Exception("Charset failed: ".$Connection->error);

	// SQL-Abfrage festlegen:
	$SQLabfrage = "SELECT Land FROM zielflughafen GROUP BY Land";

	$Recordset = $Connection->query ($SQLabfrage);
	if (!$Recordset)
		throw new Exception("Query failed: ".$Connection->error);

	// MIME-Type der Antwort definieren (*vor* allem HTML):
	header("Content-type: text/html; charset=UTF-8");
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8"/>
	<title>Auswahl</title>
</head>
<body>
	<p>Bitte wählen Sie ein Land:</p>
	<form id="Auswahl" action="Result.php" method="post">
<?php

	$AnzahlRecords = $Recordset->num_rows;
	echo ("\t\t<p><select name=\"AuswahlLand\" size=\"$AnzahlRecords\">\n");

	$Record = $Recordset->fetch_assoc();

	while ($Record) {
		echo ("\t\t\t<option>".htmlspecialchars($Record["Land"])."</option>\n");
		$Record = $Recordset->fetch_assoc();
	}
	$Recordset->free();
	$Connection->close();

	echo ("\t\t</select></p>\n");
?>
		<p><input type="submit" value="Flughäfen anzeigen"/></p>
	</form>
	<p><input type="button" value="Flughafen einfügen"
		onclick="window.location.href='Add.php'"/></p>
</body>
</html>
<?php
} catch (Exception $e) {
	header("Content-type: text/plain; charset=UTF-8");
	echo $e->getMessage();
}
