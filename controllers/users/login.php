<?php
//login controller
Class Controller_Login Extends Controller_Base {
	
	//view name
	public $view_name = "login";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'users' . _DS);
	}

	//action show login form
	function index() {
		$contents['error'] = false;
		$contents['page_title'] = 'Login page';
		$contents['message'] = 'Write your login and password, please.';
		$this->view->show($contents);
	}

	//action check login
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
				    $_SESSION['login'] = $model->name;
				    $_SESSION['admin'] = $model->admin;
				    $_SESSION['user_id'] = $model->id;
				    //go to last page
				    //echo $_SESSION['last_uri'];
				    header('Location: '.$_SESSION['last_uri']);
				} else {
					//wrong password
					$contents['error'] = true;
					$contents['message'] = 'Wrong password.';
					$contents['page_title'] = 'Login page';
					$this->view->show($contents);
				}	
			} else {
				//wrong login name
				$contents['error'] = true;
				$contents['message'] = 'No such login name.';
				$contents['page_title'] = 'Login page';
				$this->view->show($contents);
			}
		}
	}

	//action logout
	function logout() {
		//renew session before kill
		session_start();
		// Unset all of the session variables.
		$_SESSION = array();
		//kill session data
		session_destroy();

		//back to main page
		header('Location: '._DS);
		exit;
	}
}