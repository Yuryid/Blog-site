<?php
//router class
//takes route from $_GET['route']
//directory structure = routes
Class Router {

	//private $path;
	//private $args = array();
	
	//?????????? function __construct() {
	
	// }

	//set path to folder with controllers
	// function setPath($path) {
	// 	//correcting d separator
	// 	$path = rtrim($path, '/\\');
 //        $path .= _DS;
	// 	//exception if path not exist
 //        if (is_dir($path) == false) {
	// 		throw new Exception ('Invalid controller path: `' . $path . '`');
 //        }
 //        $this->path = $path;
	// }	
	
	//get controller and action from url
	private function getController(&$file, &$controller, &$action, &$args) {
        $route = (empty($_GET['route'])) ? '' : $_GET['route'];
		unset($_GET['route']);
		//default route if route is empty line
        if (empty($route)) {
			$route = 'index'; 
		}
		
        //slicing route into parts
        $route = trim($route, '/\\');
        $parts = explode('/', $route);

        //find controller file and local path
        //$loc_path = $this->path;
        $loc_path = SITE_PATH . 'controllers' . _DS;
        //echo $loc_path, ' ';
        foreach ($parts as $part) {
			$fullpath = $loc_path . $part;//sp/controllers/index
			//build local path
			if (is_dir($fullpath)) {
				$loc_path .= $part . _DS;
				array_shift($parts);
				continue;
			}

			//find file
			if (is_file($fullpath . '.php')) {
				$controller = $part;
				array_shift($parts);
				break;
			}
        }

		// if no controller specified, taking index 
        if (empty($controller)) {
			$controller = 'index'; 
		}

        //get action
        $action = array_shift($parts);
        if (empty($action)) { 
			$action = 'index'; 
		}
		//resulting path to controller file
        $file = $loc_path . $controller . '.php';
        //$args = $parts;//??
	}
	
	function start() {
        //get initial path, have to be index
        $this->getController($file, $controller, $action, $args);
		echo $file, ' ', $controller,' ', $action,' ', $args;
        //can read check
        if (is_readable($file) == false) {
			die ('404 Not Found');
        }
		
        //controller (index)
        include ($file);

        //create controller obj
        $class = 'Controller_' . $controller;
        $controller = new $class();
		
        //check action
        if (is_callable(array($controller, $action)) == false) {
			die ('404 Not Found');
        }

        //and run it if ok
        $controller->$action();
	}
}
