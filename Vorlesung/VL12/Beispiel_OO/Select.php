<?php	// UTF-8 marker äöüÄÖÜß€
require_once './Page.php';

class Select extends Page
{
	protected function __construct() {
		parent::__construct();
	}

	protected function __destruct() {
		parent::__destruct();
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

	private function insert_option($indent, $name){
	    echo ($indent."<option>".htmlspecialchars($name)."</option>\n");
	}

	protected function generateView() {
		$countries = $this->getViewData();
		$numOfRecords = count($countries);

		$this->generatePageHeader('Auswahl');
		echo <<<HERE
    <p>Bitte wählen Sie ein Land:</p>
    <form id="Auswahl" action="Result.php" method="post">
        <p>
            <select name="AuswahlLand" size="$numOfRecords">

HERE;

		foreach($countries as $country) $this->insert_option("\t\t", $country);

		echo <<<HERE
            </select>
        </p>
        <p><input type="submit" value="Flughäfen anzeigen"/></p>
    </form>
	<p><input type="button" value="Flughafen einfügen"
		onclick="window.location.href='Add.php'"/></p>

HERE;
		$this->generatePageFooter();
	}

	protected function processReceivedData() {
		parent::processReceivedData();
	}

	public static function main() {
		try {
			$page = new Select();
			$page->processReceivedData();
			$page->generateView();
		}
		catch (Exception $e) {
			header("Content-type: text/plain; charset=UTF-8");
			echo $e->getMessage();
		}
	}
}

Select::main();
