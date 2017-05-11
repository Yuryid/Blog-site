<?php
//model users class
//user_id, name, pass(hash), admin
class Model_Users extends Model_Base {
	public $id;
	public $name;
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
        return array('user_id', 'name', 'pass',  'admin');
    }
	//add new user
	public function add(){
		$All_fields_names = $this->fieldsTable();
		
		foreach($All_fields_names as $field){
			if(!empty($this->$field)){
				$field_names[] = $field;
				$data[] = $this->$field;
			}
		}
		$fields_q = implode(', ', $field_names);
		$data_q = "'" . implode("', '", $field_names) . "'";
		try {
		    $stmt = $this->db->prepare('INSERT INTO '. $this->table ."($fields_q) VALUES(NULL, $data_q)");
		    //
		    foreach ($fields as $key => $value) {
				if(empty($params[$key])) return false;
				$stmt->bindParam(':' . $key, strip_tags($params[$key]));
			}
    
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
	abstract public function update(){
		$All_fields_names = $this->fieldsTable();
		foreach($All_fields_names as $field){
			if(!empty($this->$field)){
				$field_names[] = $field;
				$data[] = $this->$field;
			}
		}
		$fields_q = implode(', ', $field_names);
		$data_q = "'" . implode("', '", $field_names) . "'";
		try {
    $stmt = $conn->prepare('UPDATE content SET title=:title, short_desc=:short_desc, full_desc=:full_desc WHERE id = :id');
	$stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    // Обрізаємо усі теги у загловку.
    $tmpsuka = strip_tags($_POST['title']);
    $stmt->bindParam(':title', $tmpsuka,PDO::PARAM_STR);

    // Екрануємо теги у полях короткого та повного опису.
    $tmpsuka1=htmlspecialchars($_POST['short_desc']);
    $stmt->bindParam(':short_desc', $tmpsuka1,PDO::PARAM_STR);
    $tmpsuka2=htmlspecialchars($_POST['full_desc']);
    $stmt->bindParam(':full_desc',$tmpsuka2 ,PDO::PARAM_STR);
   
    // Виконуємо запит, результат запиту знаходиться у змінні $status.
    // Якщо $status рівне TRUE, тоді запит відбувся успішно.
    $status = $stmt->execute();

  } catch(PDOException $e) {
    // Виводимо на екран помилку.
    print "ERROR: {$e->getMessage()}";
    // Закриваємо футер.
    require('base/footer.php');
    // Зупиняємо роботу скрипта.
    exit;
  }

	}
}
?>