<?php
//router class
//takes route from $_GET['route']
//directory structure = routes
Class Router {
	//get controller and action from route GET param
	private function getController(&$file, &$controller, &$action) {
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
        $loc_path = SITE_PATH . 'controllers' . _DS;
        foreach ($parts as $part) {
			$fullpath = $loc_path . $part;
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

		// if no controller specified, taking index controller
        if (empty($controller)) {
			$controller = 'index'; 
		}

        //get action if no then index action
        $action = array_shift($parts);
        if (empty($action)) { 
			$action = 'index'; 
		}
		//resulting path to controller file
        $file = $loc_path . $controller . '.php';
	}
	
	function start() {
        //get initial path (have to be index at start page)
        $this->getController($file, $controller, $action);
        //can read check
        if (is_readable($file) == false) {
        	header('Location: '._DS."errors"._DS."404"._DS."index?msg=Not Found controller file ". $file); 
			die ('404 Not Found controller file '. $file);
        }
		
        //controller (index)
        include ($file);

        //create controller obj
        $class = 'Controller_' . $controller;
        $controller = new $class();
		
        //check action
        if (is_callable(array($controller, $action)) == false) {
         	header('Location: '._DS."errors"._DS."404"._DS."index?msg=Not found action ". $action); 
			die ('404 Not found action '. $action);
        }

        //and run it if ok
        $controller->$action();
	}
}
