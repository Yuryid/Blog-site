<?php
//Defining constants
define ('_DS', DIRECTORY_SEPARATOR); // directory separator in paths
$sitePath = realpath(dirname(__FILE__) . _DS) . _DS;
define ('SITE_PATH', $sitePath); // path to site root folder
define ('HEADER_PATH', $sitePath . 'views'._DS.'base'._DS.'header.php');// path to header file
define ('FOOTER_PATH', $sitePath . 'views'._DS.'base'._DS.'footer.php');// path to footer file
define ('IMG_PATH', '..'._DS. 'img'._DS);// local path to img folder
 
//bd connection
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'Blog-site');
define('DB_NAME', 'free_blog');

?>