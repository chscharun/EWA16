<?php	// UTF-8 marker äöüÄÖÜß€
class FormSelect        // to do: change name of class
{
	protected $database = null;

	public function __construct($database) {
		$this->database = $database;
	}

	protected function getViewData() {
		$sql = "SELECT Land FROM zielflughafen GROUP BY Land";

		$recordset = $this->database->query ($sql);
		if (!$recordset)
			throw new Exception("Abfrage fehlgeschlagen: ".$this->database->error);
		        
		// read selected records into result array
		$country = array();
		$record = $recordset->fetch_assoc();
		while ($record) {
		    $country[] = $record["Land"];
		    $record = $recordset->fetch_assoc();
		}
		$recordset->free();
		return $country;
	}

	private function insert_option($indent, $name) {
		echo ($indent."<option>".htmlspecialchars($name)."</option>\n");
	}

	public function generateView() {
		$countries = $this->getViewData();
		$numOfRecords = count($countries);

		echo <<<EOT
	<form id="Auswahl" action="Result.php" method="post">
		<p>
			<select name="AuswahlLand" size="$numOfRecords">

EOT;

		foreach($countries as $country) 
			$this->insert_option("\t\t", $country);

		echo <<<EOT
			</select>
		</p>
		<p><input type="submit" value="Flughäfen anzeigen"/></p>
	</form>

EOT;
	}

	public function processReceivedData(&$selectedCountry) {
		if (isset($_POST["AuswahlLand"])) {
			$selectedCountry = $_POST["AuswahlLand"];
		}
	}
}
