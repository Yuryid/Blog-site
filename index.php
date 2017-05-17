<?php
//reporting all errors
error_reporting (-1); 
//config 
include ('config.php');

//connecting to db
try {
	$dbconn = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
	$dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$dbconn->exec('SET CHARACTER SET utf8');
}
catch(PDOException $e) {
    print "DB ERROR: {$e->getMessage()}";
}

//class autoloader, (find classes in folders classes, controllers, models)
if(!function_exists('classAutoLoader')){
        function classAutoLoader($className){
            $filename = strtolower($className) . '.php';
            $tmparr = explode('_', $className);
            if(empty($tmparr[1]) OR $tmparr[1] == 'Base'){
           		$folder = 'classes';
           	}else{			
				switch(strtolower($tmparr[0])){
					case 'controller':
						$folder = 'controllers';	
						break;
						
					case 'model':					
						$folder = 'models';	
						break;
						
					default:
						$folder = 'classes';
						break;
				}
			}
           	//full path
			$fpath = SITE_PATH . $folder . _DS . $filename;
			if (file_exists($fpath) == false) {
				return false;
			}
            include_once $fpath;
        }
}
spl_autoload_register('classAutoLoader');

//router loading
$router = new Router();

//start
$router->start();	
?>
