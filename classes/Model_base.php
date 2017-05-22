<?php
//model base class

Abstract Class Model_Base {

	protected $db; //db connect object
	protected $table; //table name
	
	abstract public function __construct(); 
		
	public function getTable() {
		return $this->table;
	}
	
	//row by id
	public function getRowById($id){
		try{
			$db = $this->db;
			$stmt = $db->query("SELECT * from $this->table WHERE id = $id");
			$row = $stmt->fetch();
		}catch(PDOException $e) {
			header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: {$e->getMessage()}"); 
			exit;
		}
		$this->fillData($row);
		return $row;
	}
	
	//get all rows ordered by date
	public function getAll(){
		return $this->makeRes("SELECT * from $this->table ORDER BY datastamp DESC;");
	}

	//get data from table
	protected function makeRes($zapyt){
		try{
			$db = $this->db;
			$stmt = $db->query($zapyt);
			$rows = $stmt->fetchAll();
		}catch(PDOException $e) {
			header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: {$e->getMessage()}");
			exit;
		}
		return $rows;
	}
	//fill class data from one row
	public function fillData(&$row) {
		foreach ($row as $key => $value) {
			$this->$key = $value;
		}
	}
	
	//delete row by this->id
	public function deleteRowById(){
		try {
			$db = $this->db;
			if(!isset($this->id) OR empty($this->id)){
				header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=ID table $this->table not set!");
				exit;
			}
			$result = $db->exec("DELETE FROM $this->table WHERE id = $this->id");
		}catch(PDOException $e){
			header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: {$e->getMessage()}");
			exit;
		}			
		return $result;
	}
	//add new row
	public function add(){
		$All_fields_names = $this->fieldsTable();
		//filling params from class data minus id
		foreach($All_fields_names as $field){
			if(isset($this->$field)){
				$field_names[] = $field;
				$data[] = $this->$field;
			}
		}
		$fields_q = strip_tags(implode(', ', $field_names));
		$data_q = strip_tags("'" . implode("', '", $data) . "'");
		//querry
		try {
		    $stmt = $this->db->prepare("INSERT INTO $this->table (id, $fields_q) VALUES(NULL, $data_q)");
		    //echo "INSERT INTO $this->table (id, $fields_q) VALUES(NULL, $data_q)";
		    //executing querry
		    if($stmt->execute()) {
		    	return $this->db->lastInsertId();
		    } else return false;

		  } catch(PDOException $e) {
		    header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: {$e->getMessage()}");
		    exit;
			}
	}
	//update row by id
	public function update(){
		//filling params from class data
		$All_fields_names = $this->fieldsTable();
		foreach($All_fields_names as $field){
			if(isset($this->$field)){
				if($field != 'id') {
					$data[] = $field . ' = "' . $this->$field . '"';
				}
				else {
					$key_id = $this->$field;
				}
			}
		}

		if(!isset($data) OR empty($data)){
			header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: Array data table `$this->table` empty!");
			exit;
		}
		if(!isset($key_id) OR empty($key_id)){
			header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: ID table `$this->table` not set!");
			exit;
		}
		$data_q = implode(", ", $data);
		//querry
		try {
    		$stmt = $this->db->prepare("UPDATE $this->table SET $data_q WHERE id = $key_id");
			//executing querry
    		if($stmt->execute()) {
		    	return true;
		    } else return false;
		  } catch(PDOException $e) {
		  	header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: {$e->getMessage()}");
		    exit;
		  }
	}
}