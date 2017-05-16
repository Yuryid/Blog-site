<?php
//edit article controller
Class Controller_EditArt Extends Controller_Base {
	
	//view name
	public $view_name = "edit";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'articles' . _DS);
	}

	//action show edit article form
	function index() {
		//get data from db by id
		if(isset($_GET['id'])){
			$art = new Model_Articles();
			$res = $art->getRowById($_GET['id']);
			if(!empty($res)) {
				//ok, fill contents
				$contents['article'] = $art;
			} else {
				//no such id
				die('Wrong id!');
			}
		} else {
			//wrong action call
			die('Wrong action index call!');
		}
		$contents['page_title'] = 'Edit article';
		$this->view->show($contents);
	}

	//action check
	function check() {
		$article = new Model_Articles(); //model object 
		//if POST ok then check data
		if (!empty($_POST['id'])) {
			//put data in object
			session_start();
			$article->id = htmlspecialchars($_POST['id']);
			$article->title = htmlspecialchars($_POST['title']);
			$article->shortdesc = htmlspecialchars($_POST['shortdesc']);
			$article->text = htmlspecialchars($_POST['text']);
			$article->user_id = $_SESSION['user_id'];
			$article->datastamp = date('Y-m-d G:i:s');
			$article->allow_comments = (!empty($_POST['allow_comments']) && $_POST['allow_comments'] == 'on')?1: 0;
			if ($article->update()) {
			    //go to view page
			    header('Location: '._DS."articles"._DS."viewart"._DS."index?id=$article->id"); 
			} else {
				//unsuccesful update
				die('unsuccesful update!');
			}	
		} else {
			//wrong POST
			die('Wrong action check call!');
		}
	}

	//action delete
	function delete() {
		//if POST ok then check data
		if (!empty($_GET['id'])) {	
			$article = new Model_Articles();
			$article->id = $_GET['id'];
			if($article->deleteRowById()){
				//back to main page
				header('Location: '._DS);
				exit;
			} else {
				//unsuccesful delete
				die('unsuccesful delete!');
			}
		} else {
			//wrong POST
			die('Wrong action delete call!');
		}
	}
}