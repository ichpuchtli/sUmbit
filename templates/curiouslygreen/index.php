<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/curiouslygreen/style.css" />
</head>
<body>
<div id="header">
	<div id="header_inner">
		<h1><span><?php echo s('title'); ?></span>.CMS</h1>
		<div id="slogan"><?php echo s('subtitle'); ?></div>
	</div>
</div>

<div id="main">

	<div id="lcol">
		<div id="menu">
			<ul>
				<?php categories(0); ?>
			</ul>
		</div>
		<div id="menu_end"></div>

		<div id="lcontent">
			<h3 class="first">Site.<span>Stuff</span></h3>
			<ul class="divided">
				<?php pages('home|login|admin|register|contact'); ?>
			</ul>
		
			<h3>Aliquam.<span>Cursus</span></h3>
			<p><a href="#">Sollicitudin sed</a> arcu et vivamus viverra. Nullam turpis. Vestibulum Nullam turpis vestibulum.</p>	
			<div class="divider"></div>

			<p><a href="#">Vestibulum veroeros</a> sed arcu et vivamus viverra lorem ipsum dolor sit amet dolore nulla facilisi.</p>
		</div>

	</div>

	<div id="rcol">
		<div id="rcontent">
		
			<?php center(); ?>

		</div>
	</div>

</div>

<div id="footer">
	<?php echo s('footer'); ?>
</div>

</body>
</html>
