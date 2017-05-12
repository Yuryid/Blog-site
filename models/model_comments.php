<?php
//model comments class
//id, text, user_id, art_id , rate
class Model_comments extends Model_Base {
	public $id;
	public $text;
	public $user_id;
	public $art_id;
	public $rate;

	public function __construct(); 
	{
		//db connect object
		global $dbconn;
		$this->db = $dbconn;
		
		//set table name 
		$this->table = 'comments';
		
		//$this->_getResult("SELECT * FROM $this->table" . $sql);
	}

	public function fieldsTable(){
        return array('id', 'text', 'user_id', 'art_id', '$rate');
    }
	
}
?>