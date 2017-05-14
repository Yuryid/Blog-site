<?php
//model articles class
//id, title, short_desc, text , foreign user id
class Model_articles extends Model_Base {
	public $id;
	public $title;
	public $short_desc;
	public $text;
	public $user_id;
	public $datastamp;
	public $allow_comments;

	public function __construct() 
	{
		//db connect object
		global $dbconn;
		$this->db = $dbconn;
		
		//set table name 
		$this->table = 'articles';
		
		//$this->_getResult("SELECT * FROM $this->table" . $sql);
	}

	public function fieldsTable(){
        return array('id', 'title', 'short_desc', 'text', '$user_id', 'datastamp', 'allow_comments');
    }
	
}
?>