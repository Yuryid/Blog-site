<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php print $contents['page_title']; ?></title>
	<!-- CSS files -->
	<!-- Bootstrap core CSS -->
	<link href="<?php print  '..'._DS.'..'._DS.'css'._DS.'bootstrap.min.css' ?>" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="<?php print  '..'._DS.'..'._DS.'css'._DS.'main.css' ?>" rel="stylesheet">
</head>
<body>
	<div class="container error404">
		<img class= "center-block img-responsive" src="../../img/404.png">
		<h1 class = "">Error 404</h1>
		<div class="error-description">
			<p>Something went wrong. Page not found or something else. Try to go back or return to <a href="<?php print _DS; ?>">Main page</a>
			<p class="small"><?php print $_GET['msg']; ?></p>
		</div>
	</div>
</body>
</html>
