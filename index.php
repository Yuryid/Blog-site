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

//class autoloader, (all in classes folder now)
if(!function_exists('classAutoLoader')){
        function classAutoLoader($className){
            $filename = strtolower($className) . '.php';
           	$folder = 'classes';
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
//set path where are all controllers
$router->setPath (SITE_PATH . 'controllers');

//start
$router->start();	
?>
