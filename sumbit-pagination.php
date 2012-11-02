<?php
if($max > 0){
$max = r('max','categories','seftitle',$sef_category);
$sef_category = $_GET[l('_category')];
$page = $_GET[l('page')];
if($sef_category==NULL){$sef_category = 'home';}
$order = r('sortBy','categories','seftitle',$sef_category);
if(!isset($_GET[l('place')]) && !isset($_GET[l('_article')])){
	$query = mysql_query('SELECT id FROM `articles` WHERE visible = "YES" AND category = "'.r('id','categories','seftitle',$sef_category).'" ORDER by '.$order.'');
	$articles = mysql_num_rows($query);
	if($articles % $max > 0){$leftover = 1;}
$num_pages = (($articles - ($articles % $max)) / $max) + $leftover;
	if($articles>$max && $max!=0){
	echo '<div class="pagination">';
		if(!isset($page)){$page = 1;}
		$pages=0;
		echo '<ul>';
			if($page>1){$prevpage = $page-1;$pager = '&page='.$prevpage;
			echo '<li><a class="prevnext" href="'._SITE._CATEGORY.$sef_category.$pager.'">&lt; previous</a></li>';}
		while($pages<$num_pages){ 
		  $pages++;
		 echo '<li><a ';
			 if($pages==$page){echo 'class="currentpage"';}
			echo ' href="'._SITE._CATEGORY.$sef_category._PAGE.$pages.'">'.$pages.'</a></li>';
			  }
			 if($page<$num_pages){$prevpage = $page+1;$pager = _PAGE.$prevpage;
			 echo '<li><a class="prevnext" href="'._SITE._CATEGORY.$sef_category.$pager.'">next &gt;</a></li>';}
		echo '</ul>
		</div>';
		}
	}
}
?>