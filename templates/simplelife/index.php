<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/simplelife/style.css" />
</head>
<body>
<div id="wrapper">
  <div id="content">
    <div id="header">
      <h1><?php echo s('title'); ?></h1>
      <h2><span class="highlight"><?php echo s('subtitle'); ?></span></h2>
    </div>
    <ul id="menu" class="four">
     <?php categories(0,4);	 ?>
    </ul>
    <div id="page">
     <?php center(); ?>
      <p class="footer">
       <?php echo s('footer'); pages('login|admin'); ?></p>
    </div>
  </div>
</div>
</body>
</html>