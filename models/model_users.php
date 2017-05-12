<?php
//model users class
//user_id, name, pass(hash), admin
class Model_Users extends Model_Base {
	public $id;
	public $name;
	public $pass;
	public $admin;//?

	public function __construct(); 
	{
		//db connect object
		global $dbconn;
		$this->db = $dbconn;
		
		//set table name 
		$this->table = 'users';
		
		//$this->_getResult("SELECT * FROM $this->table" . $sql);
	}

	public function fieldsTable(){
        return array('id', 'name', 'pass', 'admin');
    }
	
}
?>