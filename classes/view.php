<?php
// класс для подключения шаблонов и передачи данных в отображение
Class View {

	//private $template;
	private $controller;
	private $view_name;
	//private $vars = array();
	//get layouts name and controller
	function __construct($view_name, $controllerName) {
		$this->view_name = $view_name;
		$this->controller = $controllerName;
	}
	
	// установка переменных, для отображения
	// function vars($varname, $value) {
	// 	if (isset($this->vars[$varname]) == true) {
	// 		trigger_error ('Unable to set var `' . $varname . '`. Already set, and overwrite not allowed.', E_USER_NOTICE);
	// 		return false;
	// 	}
	// 	$this->vars[$varname] = $value;
	// 	return true;
	// }
	
	//show the view
	function show() {
		$pathView = SITE_PATH . 'views' . _DS . $this->view_name . '.php';
		//$contentPage = SITE_PATH . 'views' . DS . $this->controller . DS . $name . '.php';
		if (file_exists($pathView) == false) {
			trigger_error ('View `' . $this->view_name . '` does not exist.');
			return false;
		}
		// if (file_exists($contentPage) == false) {
		// 	trigger_error ('Template `' . $name . '` does not exist.', E_USER_NOTICE);
		// 	return false;
		// }
		
		// foreach ($this->vars as $key => $value) {
		// 	$$key = $value;
		// }

		include ($pathView);                
	}
	
}