<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php head(); ?>
<link href="style.css" rel="stylesheet" type="text/css" /></head>
<body>
<div id="header">
	<div id="header_inner">
		<h1><span><?php echo s('title'); ?></span>.Administration</h1>
		<div id="slogan"><a href="<?php home_link(); ?>">homepage</a>.<a href="<?php logout_link(); ?>">Logout [<?php echo $_SESSION['username']; ?>]</a></div>
	</div>
</div>
<div id="main">
	<ul>
	<?php categories(); ?>
	</ul>
			<?php center(); ?>
</div>

<div id="footer">
	<?php echo s('footer'); ?>
</div>

</body>
</html>