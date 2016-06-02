<?php	// UTF-8 marker äöüÄÖÜß€
abstract class Page
{
	protected $database = null;

	protected function __construct() {
		// activate full error checking
		error_reporting (E_ALL);

		// open database
		require_once 'pwd.php'; // read account data
		$this->database = new MySQLi($host, $user, $pwd, "Reisebuero");
		// check connection to database
	    if (mysqli_connect_errno())
	        throw new Exception("Keine Verbindung zur Datenbank: ".mysqli_connect_error());
		// set character encoding to UTF-8
		if (!$this->database->set_charset("utf8"))
		    throw new Exception("Fehler beim Laden des Zeichensatzes UTF-8: ".$this->database->error);
	}

	protected function __destruct()	{
	    $this->database->close();
	}

	protected function generatePageHeader($title = '') {
		$title = htmlspecialchars($title);

		// define MIME type of response (*before* all HTML):
		header("Content-type: text/html; charset=UTF-8");
		
		// output HTML header
		echo <<<EOT
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>$title</title>
	<style type="text/css">
		th, td { background-color:white; padding:3px; }
		table  { background-color:grey; }
	</style>
</head>
<body>

EOT;
	}

	protected function generatePageFooter() {
		echo <<<EOT
</body>
</html>

EOT;
	}
	
	protected function processReceivedData() {
		if (get_magic_quotes_gpc()){
			throw new Exception("Bitte schalten Sie magic_quotes_gpc in php.ini aus!");
		}
	}
}
