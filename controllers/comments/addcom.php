<?php
//add new comment controller
Class Controller_AddCom Extends Controller_Base {
	
	//view name
	public $view_name = "add";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'comments' . _DS);
	}

	//action check form data
	function index() {
		$comment = new Model_Comments(); //model object
		//check post and fill object with data
		if(!empty($_POST['text'])&&!empty($_POST['art_id'])){
			session_start();
			$comment->text = htmlspecialchars($_POST['text']);
			$comment->art_id = $_POST['art_id'];
			$comment->user_id = $_SESSION['user_id'];
			$comment->rate = 0;
			$comment->datastamp = date('Y-m-d G:i:s');
			$comment->id = $comment->add();
			if($comment->id) {
				//go to view page
			    header('Location: '._DS."articles"._DS."viewart"._DS."index?id=$comment->art_id"); 
			} else {

			}
		} else {
			//wrong POST
			die('Wrong call add comment action!');
		}

		$contents['page_title'] = 'Add new article';
		$this->view->show($contents);
	}

	//action delete comment
	function delete() {
		//if POST ok then check data
		if (!empty($_GET['id'])) {
		$comment = new Model_Comments(); //model object
			//put data in object
			$comment->id = $_GET['id'];
			if($comment->deleteRowById()){
				//back to last visited page
				header('Location: '.$_GET['last_url']);
				exit;
			} else {
				//unsuccesful delete
				die('unsuccesful comment delete!');
			}
		} else {
			//wrong POST
			die('Wrong action delete comment call!');
		}
	}
}