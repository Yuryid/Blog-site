<?php
	//index view(main page) with list of all articles
	//page header
	require(HEADER_PATH);
	?>
	<!-- title. -->
  <h1> Welcome to blog site, <?php print($login_name); ?>!</h1>
  <!-- list fo all articles ordered by date-->
  <div class="articles-list">
  <?php if (empty($contents)): ?>
    <!-- if no articles. -->
    No articles.
  <?php else: ?>
  <?php 
  	$articles = $contents['articles'];
  	foreach ($articles as $key => $art): ?>
    <div class="article-item">
      <h2><a href="<?php print _DS."articles"._DS."viewart"._DS."index?id={$art['id']}"; ?>"><?php print $art['title']; ?></a></h2>
      <div class="autor">
        Autor:  <?php echo (!empty($art['name']))?$art['name']:"Deleted user"; ?>
      </div>
      <div class="description">
        <?php print $art['shortdesc']; ?>
      </div>
      <div class="info">
        <div class="timestamp">
        	<?php print $art['datastamp']; ?>
        </div>
        <div class="links">
          <a href="<?php print _DS."articles"._DS."viewart"._DS."index?id={$art['id']}"; ?>">Read more...</a>
          <!-- links only for admins -->
          <? if($admin): ?>
            <a href="<?php print _DS."articles"._DS."editart"._DS."index?id={$art['id']}"; ?>">Edit</a>
            <a href="<?php print _DS."articles"._DS."editart"._DS."delete?id={$art['id']}"; ?>">Delete</a>
          <? endif; ?>
        </div>
      </div>
    </div>
    <hr>
  <?php endforeach; 
  endif; ?>
</div>

<?php
	//footer
	require(FOOTER_PATH);
?>