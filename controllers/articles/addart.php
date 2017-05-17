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
			$article->title = htmlspecialchars($_POST['title']);
			$article->shortdesc = htmlspecialchars($_POST['shortdesc']);
			$article->text = htmlspecialchars($_POST['text']);
			$article->user_id = htmlspecialchars($_SESSION['user_id']);
			$article->datastamp = date('Y-m-d G:i:s');
			$article->allow_comments = (!empty($_POST['allow_comments']) && $_POST['allow_comments'] == 'on')?1: 0;
			$article->id = $article->add();
			if ($article->id) {
			    //go to view page
			    header('Location: '._DS."articles"._DS."viewart"._DS."index?id=$article->id"); 
			} else {
				//unsuccessful art add
				header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: unsuccessful article add!"); 
				die('unsuccessful article add!');
			}
		} else {
			//wrong POST
			header('Location: '._DS."errors"._DS."404"._DS."index?msg=Wrong call");
			die('Wrong call!');
		}
	}
}