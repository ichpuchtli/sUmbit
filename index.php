<?php	
/********************************************************

	Engine: sUmbit
	Version: 1.0*
	Last Update: October 12 2009
	Developer: Sam Macpherson
	
*********************************************************/
// Toolbox 
include('sumbit-toolbox.php');
if(s('offline')=='YES'){
	$name = 'offline.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
}else {
	if($_GET[l('place')]=='rss'){
		include(_INCLUDES.'rss.php');
	}else{
		include_once(_TEMPLATE.'index.php');
	}
}
// MAIN CENTER FUNCTION HIGHEST LEVEL
function center(){
	$place = $_GET[l('place')];
	message($_SESSION['message']);
	switch($place){
		case 'contact': include(_INCLUDES.'contact.php');break;
		case 'search': include(_INCLUDES.'search.php');break;
		case 'users': userAccount(); break;
		case 'register': include(_INCLUDES.'register.php');break;
		case l('adminName'): header('Location: '._ADMIN.'home'); break;
		case 'logout':
			if($_GET['id']==md5($_SESSION['username'])){
				include(_INCLUDES.'gateKeeper.php');
			}
		break;
		case 'login':
			if($_POST[l('task')]=='userLogin'){
			include(_INCLUDES.'gateKeeper.php');
			header('Location: '._PLACE.'home');
		}else{
			login();
		}
		break;
		default:
			articles();
			include(_INCLUDES.'pagination.php');
			include(_INCLUDES.'comments.php');
	}
}
// CATEGORY LIST
function categories($start,$end = NULL){
$limit = $end==NULL ? '' : 'LIMIT '.$start.', '.($end-$start);
$query = $_SESSION['logged_in'] ? mysql_query('SELECT title,seftitle FROM `categories` WHERE visible = "YES" AND public != "SPC" ORDER by catorder '.$limit) : mysql_query('SELECT title,seftitle FROM `categories` WHERE visible = "YES" AND public != "NO" ORDER by catorder '.$limit);
$sefcategory = $_GET[l('_category')];
$place = $_GET[l('place')];
	while($category = mysql_fetch_assoc($query)){
		if(($category['seftitle']=='home' && !isset($place) && empty($sefcategory)) || ($sefcategory==$category['seftitle'])){
			$class = ' class="selected"';
		}else {
			$class = NULL;
		}
	$name = 'categories.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	}
}
function articles(){
// Vars
$category = $_GET[l('_category')];
if(empty($category) && empty($place)) $category = 'home';
$place = $_GET[l('place')];
$article = $_GET[l('_article')];
$page = $_GET[l('page')];
$article_id = r('id','articles','seftitle',$article);
$title = r('display_title','articles','seftitle',$article);
$title = $title == 'YES' ? TRUE : FALSE ;
// Article
if(!empty($article)){
	viewArticle($article_id,FALSE,$title,TRUE,FALSE);
	if($_SESSION['user_p']=='administrator'){
		echo '<div class="info_line"><ul>
		<li><a href="'._ADMIN.'edit_article&id='.$article_id.'">'.l('edit').'</a></li>
		</ul><div class="clearer"></div></div>';
	}
}else{
				
	// Query vars
	$max = r('max','categories','seftitle',$category);
	$order = 'ORDER by '.r('sortBy','categories','seftitle',$category);
	$public = $_SESSION['logged_in'] ? 'AND public != "SPC"' :  'AND public != "NO"'; 
	$category = 'category = "'.r('id','categories','seftitle',$category).'"';
	$query = mysql_query('SELECT id FROM `articles` WHERE visible = "YES" AND '.$category.' '.$order);
	// Setup for pagination
		switch(TRUE){
			case $max==0:
			case $max!=0 && mysql_num_rows($query) <= $max:
			$limit = NULL;
			unset($query);
			break;
			default:
			if(empty($page)) $page = 1;
			$range = $max*$page-$max;
			$limit = 'LIMIT '.$range.', '.$max;
		}
			// New Article on home
			if($category=='home'){
				if(s('new_on_home')=='YES'){
					$query = mysql_query('SELECT text,category,display_title,title,seftitle,byline,id,artorder,date FROM `articles` visible = "YES" '.$public.' ORDER BY ID desc '.$limit);
				}
			}
// LIST ARTICLE QUERY
$query = mysql_query('SELECT text,category,display_title,title,seftitle,byline,id,artorder,date FROM `articles` WHERE '.$category.' AND visible = "YES" '.$public.' '.$order.' '.$limit);
		listArticle($query);
	}
}
function listArticle($query){
		// LIST ARTICLE
			while($article = mysql_fetch_assoc($query)){
			$title = r('display_title','articles','id',$article['id'])=='YES' ? TRUE : FALSE;
				viewArticle($article['id'],strpos($text,l('breakchar')),$title,TRUE,TRUE);
				// INFO LINE
				if($article['byline']=='YES'){
					$link = _SITE._CATEGORY.r('seftitle','categories','id',$article['category'])._ARTICLE.$article['seftitle'];
					$query = mysql_query('SELECT id FROM `comments` WHERE approved = "YES" AND articleID = "'.$article['id'].'"');
					$num_comments = mysql_num_rows($query);
					$name = r('name','users','id',r('postedBy','articles','id',$article['id']));
					file_exists(_TEMPLATE.'byline.php') ? include(_TEMPLATE.'byline.php') : include(_DEFAULT.'byline.php');
				}
			}
		}
// Header
function head() {
$sefcategory = $_GET[l('_category')];
$sefarticle = $_GET[l('_article')];
$place = $_GET[l('place')];
if(!isset($place) && !isset($sefcategory)){
	$title = l('home');
}else{
	if(isset($place)){
		if($place==l('adminName')){
			$title = l('admin');
		}else {
			$title = l($place);
		}
	}else {
		if(isset($sefarticle)){
			$title = r('title','articles','seftitle',$sefarticle);
		}else{
			$title = r('title','categories','seftitle',$sefcategory);
		}
	}
}
echo '<title>'.$title.l('seperator').s('title').'</title>
<meta name="description" content="'.s('description').'" />
<meta name="keywords" content="'.s('keywords').'" />
<link rel="stylesheet" type="text/css" href="'._SITE.'sumbit.css" />';
if(s('rss_articles')=='YES') echo '<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="'._SITE._PLACE.'rssArticles" />';
}
// CATEGORY LIST
function pages($pages){
$pages = explode('|',$pages);
$template = file_exists(_TEMPLATE.'pages.php') ?  _TEMPLATE : _DEFAULT;
$template .= 'pages.php';
$place = $_GET[l('place')];
	foreach($pages as $page){
	$link = _PLACE;
		switch($page){
			case 'home':
				$link = _SITE;
				$title = l('home');
				include($template);
			break;
			case 'login':
				if($_SESSION['logged_in']){
					$link .= 'logout&id='.md5($_SESSION['username']);
					$title = l('logout').' [<em>'.$_SESSION['username'].'</em>]';
				}else{
					$link .= $page;
					$title = l('login');
				}
				include($template);
				break;
			case 'register':
				if($_SESSION['logged_in']){
					$link .= _PLACE.'users&user='.$_SESSION['username'];
					$title = l('account');
				}else {
					$link .= 'register';
					$title = l('register');
				}
				include($template);
				break;
			case 'admin':
				if($_SESSION['user_p']=='administrator'){
					$link = _ADMIN.'home';
					$title = l('admin');
					include($template);
				}
			break;
			case 'administration':
					$link = _ADMIN.'home';
					$title = l('admin');
					include($template);
			break;
			default:
				$link .= $page;
				$title = l($page);
				include($template);
			break;
		}
	}
}
// BREADCRUMBS
function breadCrumbs(){
$sefcategory = $_GET[l('_category')];
$sefarticle = $_GET[l('_article')];
$admin = $_GET[l('_admin')];
$user = $_GET['user'];
$place = $_GET[l('place')];
$userName = r('name','users','username',$user);
$page = $_GET['page'];
$category = r('title','categories','seftitle',$sefcategory);
$article = r('title','articles','seftitle',$sefarticle);
if(isset($place) || isset($sefcategory) && $category!='home'){$home = '<a href="'._SITE._CATEGORY.'home">'.l('home').'</a>'.l('divider');}else { $home = l('home');}
if(isset($sefcategory)){if(isset($sefarticle)){$stage1 = '<a href="'._SITE._CATEGORY.$sefcategory.'">'.$category.'</a>'.l('divider');$stage2 = $article;}else {$stage1 = $category;if(isset($page)){$stage2 = l('divider').' Page '.$page;}}}if(isset($place)){
switch ($place){
case 'users':if(isset($user)){$stage1 = '<a href="'._SITE._PLACE.'users">'.l('users').'</a>'.l('divider');$stage2 = $userName;}else{$stage1 = l('users');}break;case l('adminName'):if(isset($admin)){$stage1 = '<a href="'._SITE._PLACE.l('adminName').'">'.l('admin').'</a>'.l('divider');$stage2 = l($admin);}else{$stage1 = l('admin');}break;default:$stage1 = l($place);break;}}
echo $home.$stage1.$stage2;
}
// User Account
function userAccount(){
$fullname = r('name','users','username',$_GET['user']);
$username = $_GET['user'];
$about_me = r('about_me','users','username',$_GET['user']);
$wall = r('wall','users','username',$_GET['user']);
$name = 'profile.php';
$you = r('username','users','id',$_SESSION['id']);
file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
if($_POST['name']!=NULL){
$status = cleanx($_POST['name'],'user_input');
mysql_query('UPDATE users SET wall = "'.$status.'" WHERE id = "'.$_SESSION['id'].'"');
}

}

function rss_link(){
echo _SITE._PLACE.'rss';
}
function latestArticles($num = FALSE){
$public = $_SESSION['logged_in'] ? 'SPC' : 'NO';
$limit = $num ? ' LIMIT 0,'.$num : '';
$query = mysql_query('SELECT title,seftitle,category FROM `articles` WHERE visible = "YES" AND public != "'.$public.'" order by id desc'.$limit);
	while($article = mysql_fetch_assoc($query)){
		extract($article);
		$link = _CATEGORY.r('seftitle','categories','id',$category)._ARTICLE.$seftitle;
		$name = 'latestArticles.php';
		file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
		
	}
}
function updatedArticles($num){
$public = $_SESSION['logged_in'] ? 'SPC' : 'NO';
$limit = $num ? ' LIMIT 0,'.$num : '';
$query = mysql_query('SELECT title,seftitle,category,date FROM `articles` WHERE visible = "YES" AND public != "'.$public.'" order by date desc'.$limit);
	while($article = mysql_fetch_assoc($query)){
		extract($article);
		$link = _CATEGORY.r('seftitle','categories','id',$category)._ARTICLE.$seftitle;
		$name = 'updatedArticles.php';
		file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	}
}
function popularArticles($num){
$public = $_SESSION['logged_in'] ? 'SPC' : 'NO';
$limit = $num ? ' LIMIT 0,'.$num : '';
$query = mysql_query('SELECT title,seftitle,category,views FROM `articles` WHERE visible = "YES" AND public != "'.$public.'" order by views desc'.$limit);
	while($article = mysql_fetch_assoc($query)){
		extract($article);
		$link = _CATEGORY.r('seftitle','categories','id',$category)._ARTICLE.$seftitle;
		$name = 'popularArticles.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	}
}
function latestUsers($num){
$limit = $num ? ' LIMIT 0,'.$num : NULL;
$query = mysql_query('SELECT username,name,online FROM `users` WHERE banned != "YES" ORDER by id desc'.$limit);
	while($user = mysql_fetch_assoc($query)){
		extract($user);
		$link = _PLACE.'users&user='.$username;
		$name = 'latestUsers.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	}
}
function latestComments($num){
// fix
}
function relatedArticles($num){
//fix
}
// article views
function articleViews($id){
mysql_query('UPDATE articles SET views = "'.(r('views','articles','id',$id)+1).'" WHERE id='.$id);
}
function viewArticle($id,$end = FALSE,$title = TRUE,$link = TRUE,$list = FALSE){
	$article = r('text','articles','id',$id);
	if($title){
		$title = r('title','articles','id',$id);
	}
	$date = r('date','articles','id',$id);
	if(!$end){
		$article = str_replace(l('breakchar'),'',$article);
	}
	$mu = $id;
	$text = $end ? substr($article,0,$end) : $article;
	if($link){
		$link = _SITE._CATEGORY.r('seftitle','categories','id',r('category','articles','id',$id))._ARTICLE.r('seftitle','articles','id',$id);
	}
	if($list){
		$name = 'list_article.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	}else {
		$name = 'article.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	}
	articleViews($id);
}
// LOGIN PAGE
function login(){
	if($_SESSION['logged_in']){
		message('alreadyloggedin');
		if(isset($_GET['redirect'])){
			switch($_GET['redirect']){
				case "commentapproval":
				redirect(_ADMIN.'comments#commentapproval');
				break;
				case "userapproval":
				redirect(_ADMIN.'users#userapproval');
				break;
			}
		}
	}else{
		if($_GET['task']=="approve"){
			$id = cleanx($_GET['id'],'user_input');
			$token= cleanx($_GET['token'],'user_input');
			if(md5($id.r('dateJoined','users','id',$id))==$token){
				mysql_query('UPDATE `users` SET `banned` = "NO" WHERE id="'.$id.'"');
				sm('account-activated');
			}
		}
		if(isset($_GET['redirect'])){
			$redirect = '&redirect='.$_GET['redirect'];
		}
		echo '<div class="login">';
		moo(l('login'));
		form('form','','','','','','post',_PLACE.'login'.$redirect);
		form('text','username','username','','','','','');
		form('password','password','password','','','','','');
		form('hidden','task','','userLogin','','','','','');
		form('submit','submit','login','','','','','');
		echo '</div>';
	}
}

// SEARCH FORM
function search(){
	$name = 'search.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
}
//BILLBOARD
function message($zmessage){
	if(!empty($zmessage)){
	$name = 'billBoard.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
	$_SESSION['message'] = NULL;
	}
}

// Connection Closer 
mysql_close(_CON);
?>