<?php	// UTF-8 marker äöüÄÖÜß€

// This is a template for top level classes, which represent a complete web page and
// which are called directly by the user.
// The order of methods might correspond to the order of thinking during implementation.

require_once './Page.php';

// to do: change name 'PageTemplate' throughout this file
class PageTemplate extends Page
{
	// to do: declare attributes (e.g. references for member variables representing substructures/blocks)

	protected function __construct() {
		parent::__construct();
		// to do: instantiate attribute objects
	}

	protected function __destruct() {
		// to do: if necessary, destruct attribute objects representing substructures/blocks
		parent::__destruct();
	}

	protected function getViewData() {
		// to do: fetch data for this view from the database
	}

	protected function generateView() {
		$viewData = $this->getViewData();
		$this->generatePageHeader('Titel');
		// to do: call generateView() for all member variables
		// to do: output view of this page
		$this->generatePageFooter();
	}

	protected function processReceivedData() {
		parent::processReceivedData();
		// to do: call processReceivedData() for all member variables
	}

	public static function main() {
		try {
			$page = new PageTemplate();
			$page->processReceivedData();
			$page->generateView();
		}
		catch (Exception $e) {
			header("Content-type: text/plain; charset=UTF-8");
			echo $e->getMessage();
		}
	}
}

PageTemplate::main();
