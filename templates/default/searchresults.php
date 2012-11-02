
<h2><?php echo $numRows; ?> results found for <span style="color:#f10"><?php echo $keywords; ?></span></h2>
<?php

while($results = @mysql_fetch_assoc($query)):
extract($results);
$link = _CATEGORY.r('seftitle','categories','id',$category)._ARTICLE.$seftitle;
$categoryTitle = r('title','categories','id',$category);
?>

<a href="<?php echo $link ?>"><h3 style="margin:15px 0px 0px 0px;padding:0px;"><?php echo $title ?> (<?php echo $categoryTitle ?>)</h3></a><br />
<small><?php echo _SITE.$link ?></small><br />

<?php
endwhile;
?>