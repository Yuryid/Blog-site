<?php
//index controller(main page)
Class Controller_Index Extends Controller_Base {
	
	//template name
	public $view_name = "index";
	
	function __construct() {
		//creating proper view class
		$this->view = new View($this->view_name, 'index');
	}
	//action
	function index() {
		$this->view->show();
	}
	
}