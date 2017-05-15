<?php
	//view article 
	//page header
  require(HEADER_PATH);
  $art = $contents['article'];
	?>
	<!-- title. -->
  
<!-- output article -->
<div class="article-once">
  <h1> <?php print $art->title; ?> </h1>
  <div class="info-wrapp">
    <span class="timestamp"><?php print $art->datastamp; ?></span>
    <? if($admin): ?>
      <a href="/edit.php?id=<?php print $art->id; ?>">Edit</a>
      <a href="/delete.php?id=<?php print $art->id; ?>">Delete</a>
    <? endif; ?>
  </div>
  <div class="full-desc">
    <?php print $art->text; ?>
  </div>
</div>
<hr>
<!-- output comments   -->
 <?php 
    $coms = $contents['comments'];
    if(!empty($coms)):
      // var_dump($coms);
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
            <a href="/delete.php?id=<?php print $com['id']; ?>">Delete comment</a>
          <? endif; ?>
        </div>
      </div>
      <hr>
    <?php endforeach;
      else:?>
    <div><i>No comments</i></div>
    <?php endif; ?>
<?php
	//footer
	require(FOOTER_PATH);
?>