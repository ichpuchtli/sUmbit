<?php
error_reporting(0);
//error_reporting(E_ALL);
session_start(); 

$error = array('config'=>'<strong>sUmbit Error:</strong> Config file not found<br />','lang'=>'<strong>sUmbit Error:</strong> Language file not found<br />');
// Database Config
if(include_once('config.php')){
//Test connection
function con(){
	$connection = mysql_connect(db('dbhost'), db('username'), db('password'));
	return $connection;
}
if(!mysql_select_db(db('database'),con())){
	die(db('error'));
}
}else{
	die($error['config']);
}
// SMART RETRIEVE FUNCTION 
function r($col,$table,$field,$id){
$retrieve = mysql_fetch_assoc(mysql_query('SELECT '.$col.' FROM `'.$table.'` WHERE '.$field.' = "'.$id.'" LIMIT 1'));
return $retrieve[$col];
}
//Language File
if(!include_once('lang/'.r('value','settings','name','language').'.php')){die($error['lang']);}
include('sumbit-constants.php');
function idCount($table){
$id = mysql_fetch_assoc(mysql_query('SELECT id FROM '.$table.' ORDER by id desc LIMIT 1'));
return ($id['id']+1);
}
function sm($langEN){$_SESSION['message'][]=$langEN;}
// Setting retrieve 
function s($name){$setting = r('value','settings','name',$name);return $setting;}
function pass($username,$password){$cPassword = md5(sha1(md5($password.$username.md5($password))));return $cPassword;}
function ticket($username,$password,$id){
$uniqueID = md5($username.pass($username,$password).$id.'administrator');
$count = r('id','users','uniqueID',$uniqueID);
	if($count>0 && $count !== FALSE && isset($count) && r('permissions','users','password',pass($username,$password))=='administrator'){
		return 'administrator';
	}else {
		return FALSE;
	}
}
function strip_char($string){
$search = array('#','&','<','>',',','~','`',':',';','$','%','^','*','/','=','+','!','?','[',']','{','}','(',')');
$replace = '';
$string = str_replace($search,$replace,$string);
return $string;
}
// STRING CLEANER
function cleanx($string,$param){
$string = trim($string);
switch ($param){
case 'SEF':
$string = strip_tags($string);
$string = strip_char($string);
$string = str_replace(' ', '-', $string);
$string = strtolower($string);
break;
case 'comment':
$string = strip_tags($string,'<p></p><em></em><b><strong></strong><blockquote></blockquote>');
break;
case 'user_input':
$string = strip_tags($string);
$string = strip_char($string);
break;
case 'search':
$string = strip_tags($string);
$string = strip_char($string);
$string = substr($string,0,32);
}
$string = addslashes($string);
return $string;

}
// Title of pages
function moo($title){
	$name = 'header.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
}
// REDIRECT FUNCTION
function redirect($url = NULL) {
    if (!headers_sent()) {
	if($url==NULL){
	if($_GET[l('place')]==l('adminName')){
	header('Location: '._SITE.substr($_SERVER['REQUEST_URI'],1)._PROCESS);
	}
	header('Location: '._SITE.substr($_SERVER['REQUEST_URI'],1));
	}else
	header('Location:'._SITE.$url);
    }else {
		echo '<meta http-equiv="refresh" content="0;url='._SITE.$url.'">';
    }
}
function form($type,$name,$id,$value,$checked,$attributes,$method,$action){
switch($type){
case 'password': case 'text':
$checked = $checked == 'checked' ? ' checked="checked "' : ''; 
$input = '<label for="admin_'.$id.'">'.l($id).'</label><br />
<input type="'.$type.'" name="'.$name.'" id="admin_'.$id.'" class="form_input" value="'.$value.'"'.$checked.' '.$attributes.'/>';break;
case 'hidden':
$input = '<input type="'.$type.'" name="'.$name.'" value="'.$value.'" />';break;
case 'button':
$input = '<input type="'.$type.'" name="'.$name.'" value="'.$value.' &raquo" />';break;
case 'submit':
$input = '<input type="'.$type.'" class="form_submit" name="'.$name.'" value="'.l($id).' &raquo"'.$attributes.' /></form>';break;
case 'radio':
case 'checkbox':
$input = '<input type="'.$type.'" name="'.$name.'" id="admin_'.$id.'" value="'.$value.'"'.$checked.' '.$attributes.'/>
<label for="admin_'.$id.'">'.l($id).'</label>'."\n";break;
case 'textarea':if($attributes == 'settings'){$attributes = 'style="width: 500px; height:40px;"';}
$input = '<label onmousedown="resize(\'admin_'.$id.'\')" for="admin_'.$id.'">'.l($id).'</label><br />
<textarea name="'.$name.'" id="admin_'.$id.'" '.$attributes.' class="form_textarea">'.$value.'</textarea>';break;
case 'form':if($id != NULL){$id = ' id="'.$id.'" class="'.$id.'"';}
$input = '<form '.$id.' method="'.$method.'" action="'.$action.'"'.$class.' />';break;
}
if($type!='form' && $type != 'submit' && $type != 'hidden'){
$seperatorON = '<p>'."\n";
$seperatorOFF = '</p>';
}
echo $seperatorON.$input.$seperatorOFF;
}
// Mail Function
function postman($subject,$message,$email){
if($email!=NULL){$email = s('email');}
$headers = 'MIME-Version: 1.0' . "\r\n".'Content-type: text/html; charset=iso-8859-1' . "\r\n".'From: '.s('title').' <'.s('email').'>'."\r\n";
$messageHTML = '<html><head></head><body>'.$message.'</body></html>';
if(mail($email,$subject,$messageHTML,$headers)){return TRUE;}
}
function invite($name){
	$name .= '.php';
	$code = "file_exists(_TEMPLATE.'$name') ? include(_TEMPLATE.'$name') : include(_DEFAULT.'$name');";
	@eval($code);
	RETURN NULL;
}
function usersOnline(){
$session = 600; // 5 minutes
$time = microtime(TRUE)+$session;
$ip = $_SERVER['REMOTE_ADDR'];
$check = mysql_num_rows(mysql_query('SELECT id FROM usersOnline WHERE ip = "'.$ip.'"'));
mysql_query('UPDATE users SET online = "NO" WHERE lastVisit < "'.(microtime(TRUE)-$session).'"');
$query = mysql_query('SELECT id FROM users WHERE online = "YES" AND id = "'.$_SESSION['id'].'"');
mysql_query('UPDATE users SET online = "YES" AND SET lastVisit = "'.microtime(TRUE).'" WHERE id = "'.$query['id'].'"');
if($check!=0){
	mysql_query('UPDATE usersOnline SET date = "'.$time.'" WHERE ip = "'.$ip.'"');
}else {
	mysql_query('INSERT INTO usersOnline VALUES ("'.idCount('usersOnline').'", "'.$ip.'", "'.$time.'")');
}
mysql_query('DELETE FROM usersOnline WHERE date <= "'.microtime(TRUE).'"');
$membersOnline = mysql_num_rows(mysql_query('SELECT id FROM users WHERE online = "YES"'));
$usersOnline = ((mysql_num_rows(mysql_query('SELECT id FROM `usersOnline`')))-$membersOnline);
$name = 'online.php';
	file_exists(_TEMPLATE.$name) ? include(_TEMPLATE.$name) : include(_DEFAULT.$name);
}
function whoisonline(){
$query = mysql_query('SELECT name,username FROM users WHERE online = "YES"');
while($user = mysql_fetch_assoc($query)){
		echo '<li><a href="'._SITE._PLACE.'users&user='.$user['username'].'">'.$user['name'].'</a></li>';
	}
}



?>