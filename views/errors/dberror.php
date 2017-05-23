<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php print $contents['page_title']; ?></title>
  	<!-- CSS files -->
  	<link href="<?php print  CSS_PATH.'bootstrap.min.css' ?>" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="<?php print  CSS_PATH.'main.css' ?>" rel="stylesheet">
</head>
<body>
	<div class="container error404">
	  <h1 class = "error404">Database Error</h1>
	  <div class="error-description">
	  	<p>Something went wrong. Try return to <a href="<?php print _DS; ?>">Main page</a></p>
	  	<p class="small"><?php print $contents['msg']; ?></p>
	  </div>
	</div>
</body>
</html>
