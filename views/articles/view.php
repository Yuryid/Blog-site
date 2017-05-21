<?php
	//view one article 
	//page header
  require(HEADER_PATH);
  $art = $contents['article'];
	?>
<main class="container">
  <!-- output article -->
  <article class="article-item">
    <h2 class="article-title"> <?php print $art->title; ?> </h2>
    <div class="info-article">
      <span class="timestamp"><?php print $art->datastamp;?></span>
      <?php if($admin): ?>
        <a href="<?php print _DS."articles"._DS."editart"._DS."index?id=$art->id"; ?>">Edit</a>
        <a href="<?php print _DS."articles"._DS."editart"._DS."delete?id=$art->id"; ?>">Delete</a>
      <?php endif; ?>
    </div>
    <div class="text">
      <?php print $art->text;?>
    </div>
  </article>
  <hr>
  <!-- comments   -->
  <?php if($art->allow_comments):
          if($login):?>
    <!-- write a comment   -->
    <form action="<?php print _DS.'comments'._DS.'addcom'._DS.'index'; ?>" method="POST" class="form-comment">
    <div class="field-item">
      <textarea name="text" id="text" cols="80" rows="5" placeholder="Start discussion..." required></textarea>
    </div>

    <input type="hidden" name="art_id" value="<?php print $art->id;?>">
    <input type="submit" name="submit" value="Send">

  </form>

  <?php endif;//login
    $coms = $contents['comments'];
      if(!empty($coms)):
        foreach ($coms as $key => $com): ?>
        <div class="comment-item">
          <div class = "comment-header">
            <div class="username">
              <?php print $com['name']; ?>
            </div>
            <div class="timestamp">
              <?php print $com['datastamp']; ?>
            </div>
          </div>
          <div class="comment-text">
            <?php print $com['text']; ?>
          </div>
            <!-- links only for admins -->
          <div class="comment-links">
            <? if($admin): ?>
              <a href="<?php print _DS.'comments'._DS.'addcom'._DS."delete?id={$com['id']}&last_url={$_SERVER['REQUEST_URI']}"; ?>">Delete comment</a>
            <? endif; ?>
          </div>
        </div>
        <hr>
      <?php endforeach;
        else:?>
      <div><i>No comments yet.</i></div>
      <?php endif;
      else: ?>
      <div><i>Comments not allowed.</i></div>
    <?php endif;?>
</main>
<?php
	//footer
	require(FOOTER_PATH);
?>