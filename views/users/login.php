<?php
	//login view with login form
	//page header
  require(HEADER_PATH);
	?>
  <main class="container container-narrow">
  	<!-- title. -->
      <h1 class="article-title-edit">Login page</h1>
      <div class="lead <?php print ($contents['error'])? 'text-danger':'text-muted'; ?>"> <?php print $contents['message']; ?> </div>
    <!-- login form -->
   <form action="<?php print _DS.'users'._DS.'login'._DS."check"; ?>" method="POST" class="form-login">
      <div class="form-group">
        <label for="name">Login</label>
        <input class="form-control" type="text" name="name" id="name" cols="32" required>
      </div>
      <div class="form-group">
        <label for="pass">Password</label>
        <input class="form-control" type="password" name="pass" cols="32" maxlength="16" minlength="3">
      </div>
      <input class="btn btn-primary" type="submit" name="submit" value="Send">
    </form>
  </main>
<?php
	//footer
	require(FOOTER_PATH);
?>