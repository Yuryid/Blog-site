<?php
	//index view(main page) with list of all articles
	//page header
	require(HEADER_PATH);
	?>
<main class="container">
  <!-- title. -->
  <div class="blog-header">
    <h1 class="blog-title"> The test blog site</h1>
    <p class="lead blog-description">The example blog created with php, css, sass and Bootstrap</p>
  </div>
  <div class="row">
    <!-- list fo all articles ordered by date-->
    <div class="col-sm-12 articles-list">
      <?php if (empty($contents)): ?>
        <!-- if no articles. -->
        No articles.
      <?php else: ?>
      <?php 
    	$articles = $contents['articles'];
    	foreach ($articles as $key => $art): ?>
      <article class="article-item">
        <div class="container">
          <h2 class="article-title"><a href="<?php print _DS."articles"._DS."viewart"._DS."index?id={$art['id']}"; ?>"><?php print $art['title']; ?></a></h2>

          <div class="date-autor">
            <?php print date_create($art['datastamp'])->format('j F Y'); ?> <span class="autor"><?php echo (!empty($art['name']))?$art['name']:"Deleted user"; ?></span>
          </div>
          <p class="description"><?php print $art['shortdesc']; ?></p>
        </div>
        <div class="tools container-fluid">
          <a class="blog-nav-item" href="<?php print _DS."articles"._DS."viewart"._DS."index?id={$art['id']}"; ?>">Read more...</a>
          <!-- links only for admins -->
          <?php if($admin): ?>
          <div class="pull-right">
            <a class="blog-nav-item" href="<?php print _DS."articles"._DS."editart"._DS."index?id={$art['id']}"; ?>">Edit</a>
            <a class="blog-nav-item" href="<?php print _DS."articles"._DS."editart"._DS."delete?id={$art['id']}"; ?>">Delete</a>
          </div>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; 
      endif; ?>
    </div>
  </div>
</main>

<?php
	//footer
	require(FOOTER_PATH);
?>