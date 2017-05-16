<?php
//db error controller
Class Controller_DBError Extends Controller_Base {
	
	//view name
	public $view_name = "dberror";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'errors'._DS);
	}
	//action
	function index() {
		$contents['page_title'] = 'DB Error';
		$this->view->show($contents);
	}
	
}