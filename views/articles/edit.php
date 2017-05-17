<?php
	//edit view with form
	//page header
  require(HEADER_PATH);
  $art = $contents['article'];
	?>
	<!-- title. -->
  <h1><?php print $page_title; ?></h1>
  <!-- edit form -->
  <form action="<?php print _DS.'articles'._DS.'editart'._DS.'check'; ?>" method="POST" class="form-add">

  <div class="field-item">
    <label for="title">Title</label>
    <input type="text" name="title" id="title" required maxlength="255" value="<?php print $art->title; ?>">
  </div>

  <div class="field-item">
    <label for="shortdesc">Short description</label>
    <textarea name="shortdesc" id="short_desc"  maxlength="600"><?php print $art->shortdesc; ?></textarea>
  </div>

  <div class="field-item">
    <textarea name="text" id="full_desc"><?php print $art->text; ?></textarea>
  </div>
  <div class="field-item">
    <label for="allow_comments">Allow comments </label>
    <input name="allow_comments" type="checkbox" <?php print ($art->allow_comments == 1)?'checked':''; ?>></input>
  </div>
  <input type="hidden" name="id" value="<?php print $art->id;?>">
  <input type="submit" name="submit" value="Send">

</form>
<?php
	//footer
	require(FOOTER_PATH);
?>