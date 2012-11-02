<?php
//CONSTANTS
define('_SITE','http://'.$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']));
define('_SCRIPT','sumbit-administration.php');
$template = $_SESSION['template']==NULL ? r('value','settings','name','template') : $_SESSION['template'];
define('_TEMPLATE','templates/'.$template.'/');
$template = NULL;
define('_ADMIN_TEMPLATE','admin/templates/'.r('value','settings','name','admin_template').'/');
define('_ADMIN_DEFAULT','admin/templates/default/');
define('_INCLUDES','includes/sumbit-');
define('_DEFAULT','templates/default/');
define('_CON',con());
if($_SESSION['logged_in']){
define('_PROCESS','&'.l('process').'='.md5($_SESSION['user_p']));
}
define('_ADMIN',_SCRIPT.'?'.l('_admin').'=');
define('_PLACE','?'.l('place').'=');
define('_ACTION','&'.l('get').'=');
// URL CONSTANTS
if(file_exists('.htaccess')){
define('_CATEGORY',_SITE);
define('_ARTICLE','/');
define('_PAGE','/~');
}else {
define('_CATEGORY','?'.l('_category').'=');
define('_ARTICLE','&'.l('_article').'=');
define('_PAGE','&page=');
}
?>