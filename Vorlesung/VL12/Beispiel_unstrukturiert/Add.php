<?php	// UTF-8 marker äöüÄÖÜß€

// Variante 3 (prozedural, gegliedert mit Formularauswertung)
// 1. Auswertung übermittelter Daten in inkludiertem Skript
// 2. Datenbankabfrage
// 3. Abfrageergebnis in Array übertragen
// 4. Helperfunktion definieren
// 5. HTML-Ausgabe mit HEREDOC, Helperfunktion und Daten aus Array
// 6. Ausnahmebehandlung mit ordentlicher Fehlerseite

// Diese Seite wertet Eingaben von sich selbst aus und zeigt sich dann wieder an
try { 
	// MIME-Type der Antwort definieren (*vor* allem HTML):
	header("Content-type: text/html; charset=UTF-8");
	// alle möglichen Fehlermeldungen aktivieren:
	error_reporting (E_ALL);

	require_once 'AddProcess.php';

	// Datenbank öffnen und abfragen:
	require_once 'pwd.php'; // Passwort einlesen
	$Connection = new MySQLi($host, $user, $pwd, "reisebuero");

	// Verbindung prüfen:
	if (mysqli_connect_errno())
		throw new Exception("Connect failed: ".mysqli_connect_error());
	if (!$Connection->set_charset("utf8"))
		throw new Exception("Charset failed: ".$Connection->error);
		
	$SQLabfrage = "SELECT * FROM zielflughafen";
	$Recordset = $Connection->query ($SQLabfrage);
	if (!$Recordset){
		throw new Exception("Kein Flughafen in der Datenbank");
	}

	$Flughafen = array();
		
	if ($Recordset){
		// Benötigte Einträge für HTML-Ausgabe auslesen:
		$Record = $Recordset->fetch_assoc();
		while ($Record) {
			$MyZielflughafen = htmlspecialchars($Record["Zielflughafen"], ENT_QUOTES);
			$MyLand = htmlspecialchars($Record["Land"], ENT_QUOTES);
			$Flughafen[$MyZielflughafen]=$MyLand;
			$Record = $Recordset->fetch_assoc();
		}
		$Recordset->free();
	}
	$Connection->close();

	// Helperfunktion:
	function insert_tablerow($indent, $entry1="", $entry2="", $entry3=""){
		echo $indent."<tr>\n";
		echo $indent."\t<td>$entry1</td>\n";
		echo $indent."\t<td>$entry2</td>\n";
		echo $indent."\t<td>$entry3</td>\n";
		echo $indent."</tr>\n";	
	}

} catch (Exception $fehler) {
	// fängt die Exceptions ab und gibt sie formatiert als HTML-Seite aus
	$Fehlermeldung=$fehler->getMessage();
	echo <<<EOT
<!DOCTYPE html>
	<html lang="de">
	<head>
		<meta charset="UTF-8"/>
		<title>Fehler</title>
		<style type="text/css"></style>
	</head>
	<body>
		<h3>$Fehlermeldung</h3>
		<form action="Add.php" method="link">
			<input type="submit" value="ok">
		</form>
	</body>
	</html>
EOT;
	exit();
}

// Hier beginnt die HTML-Ausgabe:

echo <<<EOT
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="UTF-8"/>
	<title>Hinzufügen</title>
	<style type="text/css">
		th, td { background-color:white; padding:3px; }
		table  { background-color:grey; }
	</style>
</head>
<body>
	<h1>Tabelle der Flughäfen:</h1>
	<form action="Add.php" method="post">
	<table>
		<tr>
			<th>Zielflughafen</th>
			<th>Land</th>
			<th>Zielflughafen (Land)</th>
		</tr>

EOT;

foreach($Flughafen as $Zielflughafen => $Land) {
	insert_tablerow("\t\t", $Zielflughafen, $Land, $Zielflughafen." (".$Land.")");
}
echo <<<EOT
		<tr>
			<td><input type="text" name="Zielflughafen" size="25" maxlength="50"/></td>
			<td><input type="text" name="Land" size="25" maxlength="50"/></td>
			<td><input type="submit" value="Hinzufügen"/></td>
		</tr>
	</table>
	</form>
</body>
</html>
EOT;
