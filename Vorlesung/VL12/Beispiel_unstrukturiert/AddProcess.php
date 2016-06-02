<?php	// UTF-8 marker äöüÄÖÜß€

// Aufruf prüfen:
if (isset($_POST["Zielflughafen"]) && isset($_POST["Land"])) {

	$InZielflughafen = "";
	$InLand = "";

	// Datenbank öffnen und abfragen:
	require_once 'pwd.php'; // Passwort einlesen
	$Connection = new MySQLi($host, $user, $pwd, "reisebuero");

	// Verbindung prüfen:
	if (mysqli_connect_errno())
		throw new Exception("Connect failed: ".mysqli_connect_error());
	if (!$Connection->set_charset("utf8"))
		throw new Exception("Charset failed: ".$Connection->error);
	
	// Aufruf durch Formular:
	$InZielflughafen = $_POST["Zielflughafen"];
	$InLand = $_POST["Land"];
	if (strlen($InZielflughafen)<=0 || strlen($InLand)<=0)
		throw new Exception("Bitte geben Sie in beiden Feldern etwas an!");
	else {
		$sqlZielflughafen=$Connection->real_escape_string($InZielflughafen);
		$sqlLand = $Connection->real_escape_string($InLand);
		
		// Doppeleintrag verhindern:
		$SQLabfrage = 
			"SELECT * FROM zielflughafen ".
			"WHERE Zielflughafen = \"$sqlZielflughafen\" AND Land = \"$sqlLand\"";
		$Recordset = $Connection->query ($SQLabfrage);

		if ($Recordset->num_rows>0){
			throw new Exception("Dieser Flughafen ist bereits eingetragen.");
			$Recordset->free();
		}
		else { // neu eintragen
			$SQLabfrage = 
				"INSERT INTO zielflughafen ".
				"SET Zielflughafen = \"$sqlZielflughafen\", Land = \"$sqlLand\"";
			$Recordset = $Connection->query ($SQLabfrage);
		}
	}
	$Connection->close();
}