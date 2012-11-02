<?php 
$query = mysql_query('SELECT id,userID,comment,articleID,date FROM `comments` WHERE approved = "YES" ORDER by id desc'.$limit);
function name($name){
	$name = is_int($name) ? r('username','users','id',$name) : $name;
	return $name;
}
	while($c = mysql_fetch_assoc($query)):
			$link = _SITE._CATEGORY.r('seftitle','categories','id',r('category','articles','id',$c['articleID'])).htmlentities(_ARTICLE).r('seftitle','articles','id',$c['articleID']); 
			$articleTitle = r('title','articles','id',$c['articleID']);
			?>
			<item>
			<title>Commnet on <?php echo $articleTitle; ?> by <?php echo name($c['userID']); ?></title>
			<guid isPermaLink="TRUE"></guid>
			<link><?php echo $link; ?>#comment<?php echo $c['id']; ?></link>
			<description><?php echo htmlentities($c['comment']); ?></description>
			<pubDate><?php date('r',$c['date']); ?></pubDate>
			</item>
	<?php	endwhile;	?>
		