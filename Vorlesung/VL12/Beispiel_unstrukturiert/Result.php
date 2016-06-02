<?php	// UTF-8 marker äöüÄÖÜß€

// Variante 2 (prozedural, gegliedert)
// 1. Datenbankabfrage
// 2. Abfrageergebnis in Array übertragen
// 3. Helperfunktion definieren
// 4. HTML-Ausgabe mit HEREDOC, Helperfunktion und Daten aus Array
// 5. Ausnahmebehandlung, aber ohne ordentliche Fehlerseite

try {
	// alle möglichen Fehlermeldungen aktivieren:
	error_reporting (E_ALL);

	// Datenbank öffnen:
	require_once 'pwd.php'; // Passwort einlesen
	$Connection = new MySQLi($host, $user, $pwd, "reisebuero");

	// Verbindung prüfen:
	if (mysqli_connect_errno())
		throw new Exception("Connect failed: ".mysqli_connect_error());
	if (!$Connection->set_charset("utf8"))
		throw new Exception("Charset failed: ".$Connection->error);
	
	// SQL-Abfrage aus Formulardaten bestimmen:
	$Auswahl = "";
	$SQLabfrage = "SELECT * FROM zielflughafen WHERE Land = \"xxx\";";
	if (isset($_POST["AuswahlLand"])){
		$MyLand=$Connection->real_escape_string($_POST["AuswahlLand"]);		
		$SQLabfrage = "SELECT * FROM zielflughafen WHERE Land = \"".$MyLand."\"";
	}
		
	// Datenbank abfragen:
	$Recordset = $Connection->query ($SQLabfrage);

	// Einträge für HTML-Ausgabe anlegen:
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

	// MIME-Type der Antwort definieren (*vor* allem HTML):
	header("Content-type: text/html; charset=UTF-8");

	// Hier beginnt die HTML-Ausgabe:
	echo <<<EOT
<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8"/>
		<title>Ergebnis</title>
		<style type="text/css">
			th, td { background-color:white; padding:3px; }
			table  { background-color:grey; }
		</style>
	</head>
	<body>
		<h1>Ausgewählte Flughäfen:</h1>
		<table>
			<tr>
				<th>Zielflughafen</th>
				<th>Land</th>
				<th>Zielflughafen (Land)</th>
			</tr>

EOT;

	foreach($Flughafen as $Zielflughafen => $Land) {
		insert_tablerow("\t\t\t", $Zielflughafen, $Land, $Zielflughafen." (".$Land.")");
	}
	echo <<<EOT
		</table>
		<p><input type="button" value="Neue Auswahl"
			onclick="window.location.href='Select.php'"/></p>
	</body>
</html>
EOT;
} catch (Exception $e) {
	header("Content-type: text/plain; charset=UTF-8");
	echo $e->getMessage();
}
