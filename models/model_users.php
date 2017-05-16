<?php
//model users class
//user_id, name, pass(hash), admin
class Model_Users extends Model_Base {
	public $id;
	public $name;
	public $pass;//password hash md5
	public $datastamp;
	public $admin;// admin rights(bool)

	public function __construct()
	{
		//db connect object
		global $dbconn;
		$this->db = $dbconn;
		
		//set table name 
		$this->table = 'users';
	}

	public function fieldsTable(){
        return array('id', 'name', 'pass', 'admin', 'datastamp');
    }
	
	public function findName($name) {
		$row = $this->makeRes("SELECT * from users WHERE name = '$name';");
		if(!empty($row)) {
			$this->fillData($row[0]);
			return $row;
		} else {
			return false;
		}
	}
}
?>