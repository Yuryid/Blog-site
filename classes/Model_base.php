<?php
//model base class

Abstract Class Model_Base {

	protected $db; //db connect object
	protected $table; //table name
	private $res; //result ???????
	
	abstract public function __construct(); 
		
	public function getTable() {
		return $this->table;
	}
	
	//get $res - all table
	public function getRes(){
		if(!isset($this->res) OR empty($this->res)) return false;
		return $this->res;
	}

	//	row by id
	public function getRowById($id){
		try{
			$db = $this->db;
			$stmt = $db->query("SELECT * from $this->table WHERE id = $id");
			$row = $stmt->fetch();
		}catch(PDOException $e) {
			echo $e->getMessage();
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
			$this->res = $rows;//?
		}catch(PDOException $e) {
			echo $e->getMessage();
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
	
	//delete row by id
	public function deleteRowById(){
		try {
			$db = $this->db;
			if(!isset($this->id) OR empty($this->id)){
				echo "ID table `$this->table` not found!";
				exit;
			}
			$result = $db->exec("DELETE FROM $this->table WHERE id = $this->id");
		}catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
			echo '<br/>Error sql : ' . "'DELETE FROM $this->table WHERE id = $this->id'"; 
			exit();
		}			
		return $result;
	}
	//add new row
	public function add(){
		$All_fields_names = $this->fieldsTable();
		//filling params from class data
		foreach($All_fields_names as $field){
			if(isset($this->$field)){
				$field_names[] = $field;
				$data[] = $this->$field;
			}
		}
		$fields_q = strip_tags(implode(', ', $field_names));
		$data_q = strip_tags("'" . implode("', '", $data) . "'");
		//echo $fields_q, ' ',$data_q;
		//querry
		try {
			//echo "INSERT INTO $this->table (id, $fields_q) VALUES(NULL, $data_q)";
		    $stmt = $this->db->prepare("INSERT INTO $this->table (id, $fields_q) VALUES(NULL, $data_q)");
		    //executing querry
		    if($stmt->execute()) {
		    	return $this->db->lastInsertId();
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
			echo "Array data table `$this->table` empty!";
			exit;
		}
		if(!isset($key_id) OR empty($key_id)){
			echo "ID table `$this->table` not found!";
			exit;
		}
		$data_q = implode(", ", $data);
		//querry
		try {
    		$stmt = $this->db->prepare("UPDATE $this->table SET $data_q WHERE id = $key_id");
    		//echo "UPDATE $this->table SET $data_q WHERE id = $key_id";
			//executing querry
    		if($stmt->execute()) {
		    	return true;
		    } else return false;
		  } catch(PDOException $e) {
		    // 
		    print "ERROR: {$e->getMessage()}";
		    exit;
		  }
	}
}