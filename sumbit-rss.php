<?php header('Content-type: application/xml;'); ?>
<?xml version="1.0" encoding="ISO-8859-1" ?>
	<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" >
	<channel>
	<atom:link href="<?php echo _SITE._PLACE; ?>rss" rel="self" type="application/rss+xml" />
	<link><?php echo _SITE; ?></link>
	<description><?php echo htmlentities(s('title')); ?></description>
	<generator><?php echo l('sumbitVer');?></generator>
	<lastBuildDate><?php echo date('r',time()); ?></lastBuildDate>
	<webMaster><?php echo s('email'); ?> (Administrator)</webMaster>
	<title><?php echo htmlentities(s('title')).' - '.l('articles'); ?></title>
	<?php 
	$limit = s('rss_limit')==0 ? '' : ' LIMIT 0,'.s('rss_limit');
	$rssID = $_GET[l('rssID')];
	if(empty($rssID)){
		include(_INCLUDES.'rss-articles.php');
	}else{
		include(_INCLUDES.'rss-comments.php');
	}
	?>
	</channel>
</rss>