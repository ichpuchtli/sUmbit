<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/measing/style.css" />
</head>
<body>
<div id="container">
  <div id="topMenu">
    <ul>
	<?php 
	categories(0,1);
	pages('contact');
	?>
    </ul>
  </div>
  <div id="header">
    <div id="title">
      <?php echo s('title'); ?>
      <em> 2.2</em></div>
    <div class="subtitle">
      <h4><?php echo s('subtitle'); ?></h4>
    </div>
  </div>
  <div id="breadCrumbs">
    <?php breadCrumbs(); ?>
  </div>
  <div id="center">
    <div id="left">
      <div class="search">
        <?php search('search..'); ?>
      </div>
      <h2>Categories</h2>
      <ul>
        <?php categories(0); ?>
      </ul>
      <h2>Site Menu</h2>
      <ul>
        <?php pages('login|admin|register|contact');	?>
      </ul>
      <h2>Latest Articles</h2>
      <ul>
        <?php latestArticles(5); ?>
      </ul>
      <h2>Popular Articles</h2>
      <ul>
        <?php popularArticles(5); ?>
      </ul>
    </div>
    <div id="right">
      <?php center(); ?>
    </div>
  </div>
  <div class="clearer"></div>
  <div id="footer"><?php echo s('footer'); ?></div>
</div>
</body>
</html>
