<?php
function pages($item = NULL){
	$items = array('home','write','manage','categories','settings','users','comments','files','design');
	if($item!=NULL){
		$items = explode('|',$item);
	}
	foreach($items as $item){
	$admin = $_GET[l('_admin')];
		$id = NULL;
		if(($item=='home' && empty($admin)) || ($item==$admin)) $id = 'id="selected"';
		file_exists(_ADMIN_TEMPLATE.'categories.php') ? include(_ADMIN_TEMPLATE.'categories.php') : include(_ADMIN_DEFAULT.'categories.php');
	}
}

function put($name){
$string = 'include(\'includes/admin/'.$name.'.php\');';
eval($string);
}
// ADMIN CONTENT
function center(){
$admin = $_GET[L('_admin')];
message($_SESSION['message']);
	switch($admin){
		case 'write':
			put('newArticle');
		break;
		case 'manage':
			put('tableArticles');
		break;
		case 'categories':
			put('tableCategories');
			put('newCategory');
		break;
		case 'settings':
			put('siteSettings');
			put('siteArticles');
			put('siteUsers');
			put('siteComments');
			put('siteRSS');
			put('siteDiag');
		break;
		case 'users':
			put('tableUsers');
			put('createUser');
		break;
		case 'edit_article':
			put('editArticle');
		break;
		case 'edit_category':
			put('editCategory');
		break;
		case 'comments':
			put('tableComments');
		break;
		case 'edit_file':
			put('fileEdit');
		break;
		case 'files':
			put('fileBrowser');
			put('fileUpload');
			put('fileCreate');
		break;
		case 'design':
			put('design');
			put('newTemplate');
		break;
		case '':
		case 'home':
		default:
		echo 'home';
		
		break;
	}
}
function phpinfo_array($return=FALSE){
 ob_start();
 phpinfo(-1);
 
 $pi = preg_replace(
 array('#^.*<body>(.*)</body>.*$#ms', '#<h2>PHP License</h2>.*$#ms',
 '#<h1>Configuration</h1>#',  "#\r?\n#", "#</(h1|h2|h3|tr)>#", '# +<#',
 "#[ \t]+#", '#&nbsp;#', '#  +#', '# class=".*?"#', '%&#039;%',
  '#<tr>(?:.*?)" src="(?:.*?)=(.*?)" alt="PHP Logo" /></a>'
  .'<h1>PHP Version (.*?)</h1>(?:\n+?)</td></tr>#',
  '#<h1><a href="(?:.*?)\?=(.*?)">PHP Credits</a></h1>#',
  '#<tr>(?:.*?)" src="(?:.*?)=(.*?)"(?:.*?)Zend Engine (.*?),(?:.*?)</tr>#',
  "# +#", '#<tr>#', '#</tr>#'),
 array('$1', '', '', '', '</$1>' . "\n", '<', ' ', ' ', ' ', '', ' ',
  '<h2>PHP Configuration</h2>'."\n".'<tr><td>PHP Version</td><td>$2</td></tr>'.
  "\n".'<tr><td>PHP Egg</td><td>$1</td></tr>',
  '<tr><td>PHP Credits Egg</td><td>$1</td></tr>',
  '<tr><td>Zend Engine</td><td>$2</td></tr>' . "\n" .
  '<tr><td>Zend Egg</td><td>$1</td></tr>', ' ', '%S%', '%E%'),
 ob_get_clean());

 $sections = explode('<h2>', strip_tags($pi, '<h2><th><td>'));
 unset($sections[0]);

 $pi = array();
 foreach($sections as $section){
   $n = substr($section, 0, strpos($section, '</h2>'));
   preg_match_all(
   '#%S%(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?(?:<td>(.*?)</td>)?%E%#',
     $section, $askapache, PREG_SET_ORDER);
   foreach($askapache as $m)
       $pi[$n][$m[1]]=(!isset($m[3])||$m[2]==$m[3])?$m[2]:array_slice($m,2);
 }

 return ($return === FALSE) ? print_r($pi) : $pi;
}
function fewstats(){
$stats = phpinfo_array(TRUE);

$Articles = mysql_num_rows(mysql_query('SELECT id FROM articles'));
$Categories = mysql_num_rows(mysql_query('SELECT id FROM categories'));
$Comments = mysql_num_rows(mysql_query('SELECT id FROM comments'));
$Users = mysql_num_rows(mysql_query('SELECT id FROM users WHERE permissions = "user"'));
$Admins = mysql_num_rows(mysql_query('SELECT id FROM users WHERE permissions = "administrator"'));
$guests = mysql_num_rows(mysql_query('SELECT id FROM usersOnline'));
$name = 'stats.php';
file_exists(_ADMIN_TEMPLATE.$name) ? include(_ADMIN_TEMPLATE.$name) : include(_ADMIN_DEFAULT.$name);

}
?>