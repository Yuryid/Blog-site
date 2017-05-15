<?php
//index controller(main page)
Class Controller_Index Extends Controller_Base {
	
	//view name
	public $view_name = "index";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, '');
	}
	//action
	function index() {
		$model = new Model_Articles(); //model object
		$articles = $model->getShortList(); //list w/o full text
		$contents['articles'] = $articles;
		$contents['page_title'] = 'Free blog';
		$this->view->show($contents);
	}
	
}