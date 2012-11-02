<?php $query = mysql_query('SELECT title,category,text,date,seftitle FROM `articles` WHERE visible = "YES" ORDER by id desc'.$limit);
	while($a = mysql_fetch_assoc($query)):
			$link = _SITE._CATEGORY.r('seftitle','categories','id',$a['category']).htmlentities(_ARTICLE).$a['seftitle']; ?>
			<item>
			<title><?php echo $a['title']; ?></title>
			<guid isPermaLink="TRUE"></guid>
			<link><?php echo $link; ?></link>
			<description><?php echo str_replace('&nbsp;','&#160;',htmlentities($a['text'])); ?></description>
			<pubDate><?php date('r',$a['date']); ?></pubDate>
			</item>
	<?php	endwhile;	?>