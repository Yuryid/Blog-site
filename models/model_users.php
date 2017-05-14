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
			//var_dump($row);
			$this->id = $row[0]['id'];
			$this->name = $row[0]['name'];
			$this->pass = $row[0]['pass'];
	 		$this->datastamp = $row[0]['datastamp'];
	 		$this->admin = $row[0]['admin'];
			return $row;
		} else {
			return false;
		}
	}
}
?>