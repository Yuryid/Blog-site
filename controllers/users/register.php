<?php
//register controller
Class Controller_Register Extends Controller_Base {
	
	//view name
	public $view_name = "register";
	
	function __construct() {
		//creating proper view class (view_name, controller name)
		$this->view = new View($this->view_name, 'users'._DS);
	}

	//action show register form
	function index() {
		$contents['page_title'] = 'Register new user';
		$contents['message'] = 'Write your login and password, please.';
		$this->view->show($contents);
	}

	//action check login
	function check() {
		$model = new Model_Users(); //model object 
		//if POST ok then check data
		if (!empty($_POST['name']) && !empty($_POST['pass'])) {
			//check login
			$name = $_POST['name'];
			$result = $model->findName($name);
			if(empty($result)){
				//ok login name
				$pass = $_POST['pass'];
				//put data to class
				$model->name = $name;
				$model->pass = md5($_POST['pass']);
				$model->datastamp = date('Y-m-d G:i:s');
				$model->admin = 0;
				if($model->add()) {
					//renew session
					session_start();
				    $_SESSION['login'] = $name;;
				    $_SESSION['admin'] = 0;
				    //go to main page
				    header('Location: '._DS);
				} else {
					//some error
					$contents['message'] = 'Unsuccesfull user creation, try again.';
					$contents['page_title'] = 'Register new user';
					$this->view->show($contents);
				}
			} else {
				//wrong login name
				$contents['message'] = 'Such login name already exists.';
				$contents['page_title'] = 'Register new user';
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
		header('Location: '._DS);
		exit;
	}
}