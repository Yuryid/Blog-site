<?php
//404 controller
Class Controller_404 Extends Controller_Base {
	
	//view name
	public $view_name = "404";
	
	function __construct() {
		//creating proper view class (view_name, controller prefix)
		$this->view = new View($this->view_name, 'errors'._DS);
	}
	//action
	function index() {
		$contents['page_title'] = 'Error 404';
		$this->view->show($contents);
	}
	
}