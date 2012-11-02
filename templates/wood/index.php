<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
<head>
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/wood/style.css" media="screen" />
</head>
<body>
<div id="view">
  <div id="head">
    <div id="mainMenu">
      <ul>
         <?php 
        categories(0,4);
        pages('register|contact');
		?>
      </ul>
    </div>
    <div id="logo">
      <h1><?php echo s('title'); ?></h1>
      <h2><?php echo s('subtitle'); ?></h2>
    </div>
  </div>
  <div id="content">
    <div id="left">    
      <?php center(); ?>
    </div>
    <div id="right">
      <div class="side_menu">
	  <form method="get" id="searchform" action="<?php echo _SITE; ?>">
<input value="Search" name="keywords" id="s" type="text" onblur="if(document.forms['searchform'].s.value == '') document.forms['searchform'].s.value='<?php echo l('searchkeywords'); ?>';" onfocus="document.forms['searchform'].s.value='';" />
 <input type="hidden" name="<?php echo l('place'); ?>" value="search" />
</form>
        <h3>Categories:</h3>
        <ul>
          <?php categories(0); ?>
        </ul>
      </div>
      <div class="side_menu">
        <h3>Archives:</h3>
        <ul>
         <?php pages('login|register|contact|admin'); ?>
        </ul>
      </div>
    </div>
  </div>
  <div id="foot">
   <?php echo s('footer'); ?>
</div>
</body>
</html>
