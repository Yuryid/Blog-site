<?php
//index controller(main page)
Class Controller_Index Extends Controller_Base {
	
	//view name
	public $view_name = "index";
	
	function __construct() {
		//creating proper view class (view_name, controller name)
		$this->view = new View($this->view_name, 'index');
	}
	//action
	function index() {
		$model = new Model_Articles(); // создаем объект модели
		$articles = $model->getAll(); // получаем все строки
		$contents['articles'] = $articles;
		$contents['page_title'] = 'Free blog';
		$this->view->show($contents);
	}
	
}