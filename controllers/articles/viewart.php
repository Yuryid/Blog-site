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
			$arts->id = $_GET['id'];
			$res = $arts->getRow();
			if(!empty($res)) {
				//read article data
				$contents['article'] = $res;
				$contents['page_title'] = $res['title'];
				//read comments data
				$coms = new Model_Comments();
				$contents['comments'] = $coms->getByArtId($_GET['id']);
				//show view 
				$this->view->show($contents);
			} else {
				//empty row
				header('Location: '._DS."errors"._DS."dberror"._DS."index?msg=DB Error: Not Found article"); 
				die ('404 Not Found (article)');
			}
		} else {
			//no id sent
			header('Location: '._DS."errors"._DS."404"._DS."index?msg=Wrong call( no id sent)");
			die ('404 Not Found (no id sent)');
		}
	}

}