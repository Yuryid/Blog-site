<?php
//view one article controller
Class Controller_ViewArt Extends Controller_Base {
	
	//view name
	public $view_name = "view";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'articles' . _DS);
	}

	//action show 
	function index() {
		$arts = new Model_Articles();
		if(isset($_GET['id'])){
			//
			$res = $arts->getRowById($_GET['id']);
			if(!empty($res)) {
				//read article data
				$arts->fillData($res);
				$contents['article'] = $arts;
				$contents['page_title'] = $res['title'];
				//read comments data
				$coms = new Model_Comments();
				$contents['comments'] = $coms->getByArtId($_GET['id']);
				//show view 
				$this->view->show($contents);
			} else {
				//empty row 
				die ('404 Not Found (article)');
			}
		} else {
			//no id sent
			die ('404 Not Found (no id sent)');
		}
	}

	//action 
	function check() {
		$model = new Model_Users(); //model object 
		//if POST ok then check data
		if (!empty($_POST['name']) && !empty($_POST['pass'])) {
		  //if login correct put data in session
			$result = $model->findName($_POST['name']);
			if(!empty($result)){
				//ok login name
				//check pass
				if ($_POST['name'] == $result[0]['name'] && md5($_POST['pass']) == $result[0]['pass']) {
					session_start();
				    $_SESSION['login'] = $result[0]['name'];
				    $_SESSION['admin'] = $result[0]['admin'];
				    //go to main page
				    header('Location: '._DS);
				} else {
					//wrong password
					$contents['message'] = 'Wrong password.';
					$contents['page_title'] = 'Login page';
					$this->view->show($contents);
				}	
			} else {
				//wrong login name
				$contents['message'] = 'No such login name.';
				$contents['page_title'] = 'Login page';
				$this->view->show($contents);
			}
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