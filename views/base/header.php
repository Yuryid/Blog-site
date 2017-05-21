<?php
//start buffer
ob_start();
//start or continue session
session_start();
//set page title from data send by controller
if (!isset($contents['page_title'])) {
  $page_title = 'Blog site';
} else {
  $page_title = $contents['page_title'];
}
//check login info
if (!isset($_SESSION['login'])) {
  $login = false;
  $login_name = 'Guest';
  $admin = false;
} else {
  $login = true;
  $login_name = $_SESSION['login'];
  $admin = (bool)$_SESSION['admin']; 
}
?>
<!-- main header. -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php print $page_title; ?></title>
  <!-- CSS files -->
  <!-- Bootstrap core CSS -->
  <link href="<?php print  '..'._DS.'..'._DS.'css'._DS.'bootstrap.min.css' ?>" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php print  '..'._DS.'..'._DS.'css'._DS.'main.css' ?>" rel="stylesheet">
</head>
<body>
  <!-- site menu -->
  <div class="blog-hmenu">
    <div class="container">
      <nav class="header blog-nav">
        <a class="blog-nav-item" href="<?php print _DS; ?>">Main page</a>
        <!-- add article for admins -->
        <?php if ($admin): ?>
          <a class="blog-nav-item" href="<?php print _DS . "articles" . _DS . "addart". _DS . "index"; ?>">Add article</a>
        <?php endif; ?>
        <!-- for logined users -->
        <?php if ($login): ?>
          <div class="navbar-right">
            <div class="blog-nav-item" >Welcome, <?php print($login_name); ?>!</div>
            <a class="blog-nav-item" href="<?php print _DS . "users". _DS . "login" . _DS . "logout"; ?>">Logout</a>
          </div>
        <!-- links for not logined users  -->
        <?php endif; ?>
        <?php if (!$login): ?>
          <div class="navbar-right">
            <a class="blog-nav-item" href="<?php print _DS . "users". _DS . "login" . _DS . "index?last_url={$_SERVER['REQUEST_URI']}"; ?>">Login</a> or 
            <a class="blog-nav-item" href="<?php print _DS . "users". _DS . "register" . _DS . "index?last_url={$_SERVER['REQUEST_URI']}"; ?>">Register</a>
          </div>
        <?php endif; ?>
      </nav>
    </div>
  </div>
