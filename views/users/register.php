<?php
	//register view with form
	//page header
  require(HEADER_PATH);
	?>
  <main class="container container-narrow">
  	<!-- title. -->
    <h1 class="article-title-edit">Register new user</h1>
    <div class="lead <?php print ($contents['error'])? 'text-danger':'text-muted'; ?>"> <?php print $contents['message']; ?> </div>
    <!-- login form -->
   <form action="<?php print _DS.'users'._DS.'register'._DS."check"; ?>" method="POST" class="form-login">
      <div class="form-group">
        <label for="name">Login</label>
        <input class="form-control" type="text" name="name" id="name" required>
      </div>

      <div class="form-group">
        <label for="pass">Password</label>
        <input class="form-control" type="password" name="pass" maxlength="16" minlength="3" required>
      </div>
      <div class="form-group">
        <label for="sec_pass">Write password again</label>
        <input class="form-control" type="password" name="sec_pass" maxlength="16" minlength="3" required>
      </div>
      <input class="btn btn-primary" type="submit" name="submit" value="Send">
    </form>
  </main>
<?php
	//footer
	require(FOOTER_PATH);
?>