<?php
	//add view with add form
	//page header
  require(HEADER_PATH);
	?>
  <main class="container">
    <div class="row">
      <div class="col-sm-12">
      	<!-- title. -->
        <h2 class="article-title-edit"><?php print $page_title; ?></h2>
        <!-- add form -->
        <form action="<?php print _DS.'articles'._DS.'addart'._DS.'check'; ?>" method="POST" class="form-add">
        <div class="form-group">
          <label for="title">Title</label>
          <input class="form-control" type="text" name="title" id="title" required maxlength="255">
        </div>
        <div class="form-group">
          <label for="shortdesc">Short description</label>
          <textarea class="form-control" name="shortdesc" maxlength="600"></textarea>
        </div>
        <div class="form-group">
          <textarea class="form-control" name="text" rows="5"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input name="allow_comments" type="checkbox" checked> Allow comments
          </label>
        </div>
        <input class="btn btn-primary" type="submit" name="submit" value="Send">

      </form>
    </div>
  </div><!-- row -->
</main>
<?php
	//footer
	require(FOOTER_PATH);
?>