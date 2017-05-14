<?php
//index controller(main page)
Class Controller_Login Extends Controller_Base {
	
	//view name
	public $view_name = "login";
	
	function __construct() {
		//creating proper view class (view_name, controller name)
		$this->view = new View($this->view_name, 'login');
	}

	//action show login form
	function index() {
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
				    $_SESSION['login'] = $result[0]['name'];
				    $_SESSION['admin'] = $result[0]['admin'];
				    //go to main page
				    header('Location: /');
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

	//action logout
	function logout() {
		//renew session before kill
		session_start();
		
		//kill session data
		session_destroy();

		//back to main page
		header('Location: /');
		exit;
	}
}