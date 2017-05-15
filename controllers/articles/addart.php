<?php
//add new article controller
Class Controller_AddArt Extends Controller_Base {
	
	//view name
	public $view_name = "add";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'articles' . _DS);
	}

	//action show add article form
	function index() {
		$contents['page_title'] = 'Add new article';
		$this->view->show($contents);
	}

	//action 
	function check() {
		$article = new Model_Articles(); //model object 
		//if POST ok then check data
		if (!empty($_POST['title'])) {
			//put data in object
			session_start();
			$article->title = $_POST['title'];
			$article->shortdesc = $_POST['shortdesc'];
			$article->text = $_POST['text'];
			$article->user_id = $_SESSION['user_id'];
			$article->datastamp = date('Y-m-d G:i:s');
			$article->allow_comments = $_POST['allow_comments'];
			$article->id = $article->add();
			if ($article->id) {
			    //go to view page
			    header('Location: '._DS."articles"._DS."viewart"._DS."index?id=$article->id"); 
			}	
		} else {
			//wrong POST
			die('Wrong call!');
		}
	}

	//action delete
	function logout() {
		//renew session before kill
		session_start();
		
		//kill session data
		session_destroy();

		//back to main page
		header('Location: '._DS);
		exit;
	}
}