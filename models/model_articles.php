<?php
//model articles class
//id, title, short_desc, text , foreign user id
class Model_articles extends Model_Base {
	public $id;
	public $title;
	public $shortdesc;
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
	}
	//
	public function fieldsTable(){
        return array('id', 'title', 'shortdesc', 'text', 'user_id', 'datastamp', 'allow_comments');
    }
    //list of articles w/o text
    public function getShortList(){
    	return $this->makeRes("SELECT articles.id, title, shortdesc, user_id, articles.datastamp, allow_comments, users.name FROM articles LEFT JOIN users ON articles.user_id = users.id ORDER BY articles.datastamp DESC");
    }
	
}
?>