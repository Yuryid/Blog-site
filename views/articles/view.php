<?php
	//view article 
	//page header
  require(HEADER_PATH);
  $art = $contents['article'];
  //var_dump($art);
	?>
	<!-- title. -->
  
<!-- output article -->
<div class="article-once">
  <h1> <?php print $art->title; ?> </h1>
  <div class="info-article">
    <span class="timestamp"><?php print $art->datastamp;?></span>
    <?php if($admin): ?>
      <a href="<?php print _DS."articles"._DS."editart"._DS."index?id=$art->id"; ?>">Edit</a>
      <a href="/delete.php?id=<?php print $art->id; ?>">Delete</a>
    <?php endif; ?>
  </div>
  <div class="text">
    <?php print $art->text;?>
  </div>
</div>

<hr>
<!-- output comments   -->
 <?php 
if($art->allow_comments):
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
    <?php endif; endif;?>
<?php
	//footer
	require(FOOTER_PATH);
?>