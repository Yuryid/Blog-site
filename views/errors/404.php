<!DOCTYPE html>
<html>
<head>
  <title><?php print $contents['page_title']; ?></title>
  <meta charset="utf-8">
  <!-- CSS files -->
</head>
<body>
  <h1 class = "error404">Error 404</h1>
  <div>Something went wrong. Page not found or something else. Try to go back or return to <a href="<?php print _DS; ?>">Main page</a></div>
  <div class="Error-description"><small><i><?php print $_GET['msg']; ?></i></small></div>
</body>
</html>