<?php	// UTF-8 marker äöüÄÖÜß€
class BlockTemplate        // to do: change name of class
{
    protected $database = null;
    
    public function __construct($database) 
    {
        $this->database = $database;
        // to do: instantiate members representing substructures/blocks
    }

    protected function getViewData()
    {
        // to do: fetch data for this view from the database
    }
    
    public function generateView() 
    {
        // to do: call generateView() for all members
    }
    
    public function processReceivedData()
    {
        // to do: call processData() for all members
    }
}
