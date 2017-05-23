<?php
	//view one article 
	//page header
  require(HEADER_PATH);
  $art = $contents['article'];
	?>
<main class="container">
  <!-- output article -->
  <article class="article-item">
    <!-- <div class="container"> -->
      <h2 class="article-title"> <?php print $art['title']; ?> </h2>
      <div class="date-autor">
        <span class="timestamp"><?php print date_create($art['datastamp'])->format('j F Y');?></span> <span class="autor"><?php echo (!empty($art['name']))?$art['name']:"Deleted user"; ?></span>
      </div>
      <div class="text">
        <?php print $art['text'];?>
      </div>
    <!-- </div> -->
    <div class="tools container-fluid">
      <?php if($admin): ?> 
          <a class="blog-nav-item" href="<?php print _DS."articles"._DS."editart"._DS."index?id={$art['id']}"; ?>">Edit</a>
          <a class="blog-nav-item pull-right" href="<?php print _DS."articles"._DS."editart"._DS."delete?id={$art['id']}"; ?>">Delete</a>
        <?php endif; ?>
    </div>
  </article>
  <hr>
  <!-- comments   -->
  <?php if($art['allow_comments']):
          if($login):?>
    <!-- write a comment   -->
    <form action="<?php print _DS.'comments'._DS.'addcom'._DS.'index'; ?>" method="POST" class="form-comment">
    <div class="form-group">
      <textarea class="form-control add-comment" name="text" id="text" placeholder="Start discussion..." required></textarea>
    </div>
    <input type="hidden" name="art_id" value="<?php print $art['id'];?>">
    <input type="submit" class="btn btn-primary" name="submit" value="Send">
  </form>

  <?php endif;//login
    $coms = $contents['comments'];
      if(!empty($coms)):
        foreach ($coms as $key => $com): ?>
        <div class="comment-item">
          <div class="container">
            <div class = "comment-header">
              <span class="timestamp"><?php print $com['datastamp']; ?></span> <span class="autor"><?php print $com['name']; ?></span>
            </div>
            <div class="comment-text">
              <?php print $com['text']; ?>
            </div>
          </div>
            <!-- links only for admins -->
          <div class="tools container-fluid">
            <?php if($admin): ?>
              <a class="blog-nav-item" href="<?php print _DS.'comments'._DS.'addcom'._DS."delete?id={$com['id']}&last_url={$_SERVER['REQUEST_URI']}"; ?>">Delete comment</a>
            <?php endif; ?>
          </div>
        </div>
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