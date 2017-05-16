<?php
//model comments class
//id, text, user_id, art_id , rate
class Model_comments extends Model_Base {
	public $id;
	public $text;
	public $user_id;
	public $art_id;
	public $datastamp;
	public $rate;

	public function __construct() 
	{
		//db connect object
		global $dbconn;
		$this->db = $dbconn;
		
		//set table name 
		$this->table = 'comments';
	}

	public function fieldsTable(){
        return array('id', 'text', 'user_id', 'art_id', '$rate', 'datastamp');
    }
	//list of comments from article id w user names
    public function getByArtId($art_id){
    	return $this->makeRes("Select comments.id, text, comments.datastamp, rate, user_id, users.name FROM comments INNER JOIN users ON comments.user_id = users.id WHERE comments.art_id=$art_id ORDER BY comments.datastamp DESC;");
    }
}
?>