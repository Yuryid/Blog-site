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
  
<?php
	//footer
	require(FOOTER_PATH);
?>