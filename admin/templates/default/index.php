<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<?php head(); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo _ADMIN_TEMPLATE; ?>style.css" />
</head>

<body>
  <div id="main">
    <div id="links_container">
      <div id="logo"><h1>Administration</h1><h2><?php echo s('title'); ?></h2></div>
      <div id="links">
        <!-- **** INSERT LINKS HERE **** -->
        <a href="<?php home_link(); ?>">homepage</a> | <a href="<?php echo account_link(); ?>">my profile</a> | <a href="<?php logout_link(); ?>">logout</a> | <a href="<?php echo _SITE._ADMIN.$_GET[l('_admin')]._ACTION.'onoff'; ?>">site [on/off]</a>
      </div>
    </div>
    <div id="menu">
      <ul>
        <?php pages(); ?>
      </ul>
    </div>
    <div id="content">
      <div id="column1">
         <h1>Who's Online</h1>
			<ul>		 
				<?php whoisonline(); ?>
			</ul>
		  <h1>additional links</h1>
            <ul>
              <li><a href="http://www.w3schools.com/xhtml/default.asp">learn XHTML</a></li>
              <li><a href="http://www.w3schools.com/css/default.asp">learn CSS</a></li>
              <li><a href="http://www.google.com/chrome">get chrome</a></li>
            </ul>	
		  <h1>Statistics</h1>		  
		  <ul>
		  <?php fewstats(); ?>
		  </ul>   	  
	 </div>
      <div id="column2">
	  
       <?php center(); ?>
      </div>
    </div>
    <div id="footer">
		<?php echo s('footer'); ?>

	</div>
  </div>
</body>
</html>
