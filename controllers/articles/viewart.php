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

}