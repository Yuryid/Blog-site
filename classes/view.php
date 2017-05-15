<?php
//class calling proper view file
Class View {

	private $controller;//?
	private $view_name;

	//get layouts name and controller prefix
	function __construct($view_name, $controllerPrefix) {
		$this->view_name = $view_name;
		$this->controller = $controllerPrefix;//?
	}
	
	//show the view
	function show(&$contents) {
		$pathView = SITE_PATH . 'views' . _DS . $this->controller . $this->view_name . '.php';
		if (file_exists($pathView) == false) {
			trigger_error ('View `' . $this->view_name . '` does not exist.');
			return false;
		}

		include ($pathView);                
	}
	
}