<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/default/style.css" />
</head>
<body>
<div class="container">
  <div class="main">
    <div class="header">
      <div class="title">
        <h1><?php echo s('title'); ?></h1>
      </div>
    </div>
    <div class="content">
      <div class="breadcrumbs">
        <?php breadCrumbs(); ?>
      </div>
      <?php center(); ?>
    </div>
    <div class="sidenav">
      <h1>Search</h1>
      <?php search() ?>
      <h1>Pages</h1>
      <ul>
        <?php pages('login|contact|admin'); ?>
      </ul>
      <h1>Categories</h1>
      <ul>
        <?php categories(0); ?>
      </ul>
      <h1>Latest Articles</h1>
      <ul>
        <?php latestArticles(5); ?>
      </ul>
    </div>
    <div class="clearer"></div>
  </div>
  <div class="footer"><?php echo s('footer'); ?></div>
</div>
</body>
</html>