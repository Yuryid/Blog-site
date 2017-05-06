<?php
//Defining constants
define ('_DS', DIRECTORY_SEPARATOR); // directory separator in paths
$sitePath = realpath(dirname(__FILE__) . _DS) . _DS;
define ('SITE_PATH', $sitePath); // path to site root folder
 
//bd connection
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'Blog-site');
define('DB_NAME', 'free_blog');

?>