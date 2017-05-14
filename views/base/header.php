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
//echo $_SESSION['login'], $_SESSION['admin'];
?>
<!-- main header. -->
<!DOCTYPE html>
<html>
<head>
  <title><?php print $page_title; ?></title>
  <meta charset="utf-8">
  <!-- CSS files -->
</head>
<body>
<!-- site menu -->
<div class="header" style="width:50%;margin:0 auto;border:1px solid black;background-color:gray;">
  <ul class="main-menu">
    <li><a href="<?php print _DS; ?>">Main page</a></li>
    <?php if ($admin): ?>
      <li><a href="<?php print _DS . "article" . _DS . "add"; ?>">Add article</a></li>
    <?php endif; ?>
    <?php if ($login): ?>
      <li><a href="<?php print _DS . "users". _DS . "login" . _DS . "logout"; ?>">Logout</a></li>
    <?php endif; ?>
    <?php if (!$login): ?>
      <li>
        <a href="<?php print _DS . "users". _DS . "login" . _DS . "index"; ?>">Login</a> or 
        <a href="<?php print _DS . "users". _DS . "register" . _DS . "index"; ?>">Register</a>
      </li>
    <?php endif; ?>
  </ul>
</div>
