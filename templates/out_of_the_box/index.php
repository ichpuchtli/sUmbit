<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/out_of_the_box/style.css" />
</head>
<body>
<div id="head">
  <div class="wrap">
    <h1>
      <?php echo s('title'); ?>
    </h1>
    <h2><?php echo s('subtitle'); ?></h2>
    <div id="nav">
      <ul>
	  <?php 
        categories(0,4);
        pages('login|admin');
		?>
      </ul>
    </div>
  </div>
</div>
<div class="wrap">
  <div id="right">
  <h1>Search</h1>
  <?php search();?>
    <h1>Recent Posts</h1>
    <ul>
     <?php latestArticles(10); ?>
    </ul>
	 <h1>Categories</h1>
    <ul>
     <?php categories(0); ?>
    </ul>
	 <h1>RSS</h1>
    <ul>
    <li> <?php rss_link(); ?></li>
    </ul>
	<h1>who's online</h1>
	<ul>
	<li><a href="#"><?php usersOnline(); ?></a></li>
	</ul>
  </div>
  <div id="content">
  <?php center(); ?>
  </div>
</div>
<div id="footer">
<div class="wrap">
    <div id="footnav">
      <ul>
       <?php pages('home|login|register|admin|contact'); ?>
      </ul>
    </div>
    <div class="linksright">
      <h4><a href="#">Recent Updates</a></h4>
      <ul>
       <?php updatedArticles(5); ?>
      </ul>
    </div>
    <div class="linksright">
      <h4>Recent Comments</h4>
      <ul>
        <?php latestComments(5); ?>
      </ul>
    </div>
    <div class="linksright">
      <h4>Recent Posts</h4>
      <ul>
        <?php popularArticles(5); ?>
      </ul>
    </div>
    <div class="linksright">
      <h4>Recent Users</h4>
      <ul class="null">
        <?php latestUsers(5); ?>
      </ul>
    </div>
	</div>
    <p class="foot"><?php echo s('footer'); ?> </p>
</div>
</body>
</html>
