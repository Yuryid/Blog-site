<?php
	//edit view with form
	//page header
  require(HEADER_PATH);

  $art = $contents['article'];
	?>
  <main class="container">
    <div class="row">
      <div class="col-sm-12">
      	<!-- title. -->
        <h2 class="article-title-edit"><?php print $page_title; ?></h2>
        <!-- edit form -->
        <form action="<?php print _DS.'articles'._DS.'editart'._DS.'check'; ?>" method="POST" class="form-add">

        <div  class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title" id="title" required maxlength="255" value="<?php print $art->title; ?>">
        </div>

        <div  class="form-group">
          <label for="shortdesc">Short description</label>
          <textarea class="form-control" name="shortdesc" id="short_desc"  maxlength="600"><?php print $art->shortdesc; ?></textarea>
        </div>

        <div  class="form-group">
          <textarea class="form-control" name="text" rows="10" id="full_desc"><?php print $art->text; ?></textarea>
        </div>
        <div class="checkbox">
          <label><input name="allow_comments" type="checkbox" <?php print ($art->allow_comments == 1)?'checked':''; ?>></input> Allow comments</label>
        </div>
        <input type="hidden" name="id" value="<?php print $art->id;?>">
        <input class="btn btn-primary" type="submit" name="submit" value="Send">
      </form>
    </div>
  </div><!-- row -->
</main>
<?php
	//footer
	require(FOOTER_PATH);
?>