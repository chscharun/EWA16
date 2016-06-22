<?php	// UTF-8 marker äöüÄÖÜß€
require_once './Page.php';
require_once './FormSelect.php';

class Select extends Page
{
	private $block_FormSelect;
	
	protected function __construct() {
		parent::__construct();
		$this->block_FormSelect = new FormSelect($this->database);
	}

	protected function __destruct() {
		parent::__destruct();
	}

	protected function generateView() {
		$this->generatePageHeader('Auswahl');
		echo <<<HERE
    <p>Bitte wählen Sie ein Land:</p>

HERE;
		$this->block_FormSelect->generateView();
		echo <<<HERE
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
