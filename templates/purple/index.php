<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php head(); ?>
<link rel="stylesheet" type="text/css" href="templates/purple/style.css" />
</head>
<body>
<div id="container">

<div id="logo">
<h1><a href="#"><?php echo s('title'); ?></a></h1>
<h2 id="tagline"><?php echo s('subtitle'); ?></h2>
</div>

<div id="menu"> 
<a href="<?php echo _SITE._PLACE.'login'; ?>" id="login" title="login">login</a> 
<a href="<?php echo _SITE._PLACE.'rss'; ?>" id="rss-entries" title="rss entries">rss entries</a>
<a href="#comments" id="rss-comments" title="rss comments">rss comments</a> 
</div>

<div class="clearing">&nbsp;</div>

<ul id="nav">
 <?php categories(0); ?>
 <?php pages('contact'); ?>
</ul>

<div id="search">
<form method="get" id="searchform" action="<?php echo _SITE; ?>">
 <div id="s-text"> <input value="Search" name="keywords" id="s" type="text" onblur="if(document.forms['searchform'].s.value == '') document.forms['searchform'].s.value='<?php echo l('searchkeywords'); ?>';" onfocus="document.forms['searchform'].s.value='';" /> <label for="s">Search</label> </div>
 <input type="hidden" name="<?php echo l('place'); ?>" value="search" />
 <div id="s-submit"> <input id="searchsubmit" value="" type="submit" /> </div>
</form>
</div>

<div id="posts">
<?php center(); ?>
</div>

<div id="sidebar">

<ul>

  <li>
    <h2>Pages</h2>
   <ul>
 	<?php pages('home|login|admin|register'); ?>
   </ul>
  </li>

  <li>
    <h2>Categories</h2>
        <ul>
   <?php categories(0); ?>
    	</ul>
  </li>

  <li>

</div>
</div>

<!-- container .B -->
<div id="footer" class="clearfix">
<div class="wrapper">

<div id="footer-recent-posts">
<h2>Recent Posts</h2>
<ul>
  <li> <a href="#" rel="bookmark" title="Permanent link Post">Purple - A Free CSS Template by Henry Jorge and TF. <br /> <span>March 15, 2008</span></a> </li>
  <li> <a href="#" rel="bookmark" title="Permanent link Post">Purple - A Free CSS Template by Henry Jorge and TF. <br /> <span>March 15, 2008</span></a> </li>
  <li> <a href="#" rel="bookmark" title="Permanent link Post">Purple - A Free CSS Template by Henry Jorge and TF. <br /> <span>March 15, 2008</span></a> </li>
</ul>
</div>

<div id="footer-recent-comments">
<h2>Recent Comments</h2>
<ul>
  <li><a href="#" title="Nice Template!">Wow, great template! Good job both to Templatefusion and Henry Jorge! <br /> <span>Happy Camper</span></a></li>
  <li><a href="#" title="Nice Template!">Wow, great template! Good job both to Templatefusion and Henry Jorge! <br /> <span>Happy Camper</span></a></li>
  <li><a href="#" title="Nice Template!">Wow, great template! Good job both to Templatefusion and Henry Jorge! <br /> <span>Happy Camper</span></a></li>
</ul>
</div>

<div id="about">
<h2>About</h2>
<p id="info">This template was created by Henry Jorge, then recoded, touched up, and released by TemplateFusion.org</p>


<p id="copyright">
Copyright &copy; 2008 <a href="#logo" title="#">sUmbit.com</a>&nbsp;<br />
Powered by <a href="http://sumbit.com">sUmbit 2.1.4</a><br />
Managed by Sam Macpherson
</p>

<p id="valid"> <span><a href="http://validator.w3.org/check?uri=referer">XHTML</a></span>&nbsp;&nbsp;
<span><a href="http://jigsaw.w3.org/css-validator/validator?uri=http://dev.scotttaylorgroup.com/theme1&amp;usermedium=all">CSS</a></span>
</p>

</div>
<div class="clearing">&nbsp;</div>
</div>
</div>
</body>
</html>
