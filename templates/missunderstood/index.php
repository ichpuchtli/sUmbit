<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/missunderstood/style.css"  />
</head>
<body>
<div id="container">
  <div id="logo">
    <h1><span class="pink"><?php echo s('title'); ?></span>2.1</h1>
  </div>
  <div id="search">
    <?php search('search..'); ?>
  </div>
  <div class="br"></div>
  <div id="navlist">
    <ul>
	<?php 
	categories(0);
	pages('contact|login|register|admin');
	?>
    </ul>
  </div>
  <div id="content">
    <?php center(); ?>
  </div>
  <div class="br"></div>
  <div id="footer">
    <p class="center"><?php echo s('footer'); ?></p>
    <br />
  </div>
</div>
</body>
</html>
