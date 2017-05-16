<?php
	//add view with add form
	//page header
  require(HEADER_PATH);
	?>
	<!-- title. -->
  <h1><?php print $page_title; ?></h1>
  <!-- add form -->
  <!-- <div class="login-status"> <?php print $contents['message']; ?> </div> -->
  <form action="<?php print _DS.'articles'._DS.'addart'._DS.'check'; ?>" method="POST" class="form-add">

  <div class="field-item">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" required maxlength="255">
  </div>

  <div class="field-item">
    <label for="shortdesc">Short description</label>
    <textarea name="shortdesc" id="short_desc"  maxlength="600"></textarea>
  </div>

  <div class="field-item">
    <!-- <label for="full_desc">Повний зміст</label> -->
    <textarea name="text" id="full_desc"></textarea>
  </div>
  <div class="field-item">
    <label for="allow_comments">Allow comments </label>
    <input name="allow_comments" type="checkbox" checked></input>
  </div>
  <input type="submit" name="submit" value="Send">

</form>
<?php


	//footer
	require(FOOTER_PATH);
?>