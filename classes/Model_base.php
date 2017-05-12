<?php
//model base class

Abstract Class Model_Base {

	protected $db; //db connect object
	protected $table; //table name
	private $res; //result 
	
	abstract public function __construct($select = false); 
		
	public function getTable() {
		return $this->table;
	}
	
	//get all rows from table
	function getRes(){
		if(!isset($this->res) OR empty($this->res)) return false;
		return $this->res;
	}
		
	function getRowById($id){
		try{
			$db = $this->db;
			$stmt = $db->query("SELECT * from $this->table WHERE id = $id");
			$row = $stmt->fetch();
		}catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		return $row;
	}
	
	//get data from db
	private function makeRes($zapyt){
		try{
			$db = $this->db;
			$stmt = $db->query($zapyt);
			$rows = $stmt->fetchAll();
			$this->res = $rows;
		}catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		
		return $rows;
	}
	
	//delete row by id
	public function deleteRowById($id){
		try {
			$db = $this->db;
			$result = $db->exec("DELETE FROM $this->table WHERE id = $id");
		}catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
			echo '<br/>Error sql : ' . "'DELETE FROM $this->table WHERE id = $id'"; 
			exit();
		}			
		return $result;
	}
	//add new row
	public function add(){
		$All_fields_names = $this->fieldsTable();
		//filling params from class data
		foreach($All_fields_names as $field){
			if(!empty($this->$field)){
				$field_names[] = $field;
				$data[] = $this->$field;
			}
		}
		$fields_q = implode(', ', $field_names);
		$data_q = "'" . implode("', '", $field_names) . "'";
		//querry
		try {
		    $stmt = $this->db->prepare('INSERT INTO '. $this->table ."($fields_q) VALUES(NULL, $data_q)");
		    //executing querry
		    if($stmt->execute()) {
		    	return true;
		    } else return false;

		  } catch(PDOException $e) {
		    print "ERROR: {$e->getMessage()}";
		    exit;
			}
	}
	//update row by id
	public function update(){
		//filling params from class data
		$All_fields_names = $this->fieldsTable();
		foreach($All_fields_names as $field){
			if(!empty($this->$field)){
				if($field != 'id') {
					$data[] = $field . ' = "' . $this->$field . '"';
				}
				else {
					$key_id = $this->$field;
				}
				$data[] = $this->$field;
			}
		}
		if(!isset($data) OR empty($data)){
			echo "Array data table `$this->table` empty!";
			exit;
		}
		if(!isset($key_id) OR empty($key_id)){
			echo "ID table `$this->table` not found!";
			exit;
		}
		$data_q = "'" . implode("', '", $field_names) . "'";
		//querry
		try {
    		$stmt = $conn->prepare('UPDATE $this->table SET $data_q WHERE id = $key_id');
			//executing querry
    		$status = $stmt->execute();
		  } catch(PDOException $e) {
		    // 
		    print "ERROR: {$e->getMessage()}";
		    exit;
		  }
	}
}