<?php
// STANDARD VARIBALES
$get = $_GET[l('get')];
$post = $_POST[l('post')];
$category = $_GET[l('_category')];
mysql_select_db(db('dbname'),con());
// SQL Query Executor
function chkSQL($sql,$message){
/*	if(mysql_query($sql)){
		sm($message);
	}else {
		sm('mysql_query_error');
	}
	*/
	mysql_query($sql);
}
function dir_copy($source, $target ){
	if (is_dir($source)){
		@mkdir($target);
		$d = dir($source);
	while (FALSE !== ($entry = $d->read())){
		if ($entry == '.' || $entry == '..'){
			continue;
		}
		$Entry = $source.'/'.$entry;            
		if (is_dir($Entry)){
			dir_copy($Entry,$target . '/' . $entry);
			continue;
		}
		copy($Entry,$target . '/' . $entry );
	}
	$d->close();
	}else{
		copy($source,$target);
	}
}
function dir_del($dirname){
	if(is_dir($dirname)){
		$dir_handle = opendir($dirname); 
		if(!$dir_handle){ return FALSE;}
		while($file = readdir($dir_handle)){ 
			if($file != '.' && $file != '..'){ 
				if(!is_dir($dirname.'/'.$file)){ 
					unlink($dirname.'/'.$file); 
				}else { 
					dir_del($dirname.'/'.$file);	
				}
			}
		}	
	closedir($dir_handle); 
	rmdir($dirname); 
	return TRUE; 
	}
}
switch($_POST['action']){
	case 'add_article':
		if(isset($_POST['title']) && isset($_POST['text']) && isset($_POST['category'])){
			$seftitle = cleanx($_POST['title'],'SEF');
			$id = idCount('articles');
			$visible = !$_POST['visible'] ? 'NO' : 'YES';
			$display_title = !$_POST['display_title'] ? 'NO' : 'YES';
			$byline = !$_POST['byline'] ?  'NO' : 'YES';
			$comments = !$_POST['comments'] ? 'NO' : 'YES';
			$text = addslashes($_POST['text']);
			$category = r('id','categories','title',$_POST['category']);
			$sql = 'INSERT INTO `articles` VALUES ('.$id.', "'.$_POST['title'].'", "'.$seftitle.'", "'.$text.'", "'.$category.'","'.$visible.'", "'.$_POST['artorder'].'", "'.$_POST['public'].'", "'.$byline.'", "'.$comments.'", 0, 0, "'.$display_title.'",'.time().',"'.$_SESSION['id'].'")';
			chkSQL($sql,'article_added');
		}
	break; case 'add_category':
	// ADD CATEGORY
	if(isset($_POST['title']) && isset($_POST['catorder'])){
	$seftitle = cleanx($_POST['title'],'SEF');
	$id = idCount('categories');
	if(!$_POST['visible']){$visible = 'NO';}else {$visible = 'YES';}
	$sql = 'INSERT INTO `categories` VALUES ("'.$_POST['id'].'", "'.$_POST['title'].'", "'.$seftitle.'", "'.$_POST['catorder'].'", "'.$visible.'", "'.$_POST['max'].'", "'.$_POST['public'].'", 0, "'.$_POST['sortBy'].'")';
	chkSQL($sql,'category_added');
	}
	break; case 'update_article':
	// Update Article
	$id = $_POST['id'];
	if(strlen($_POST['seftitle']) < 1){$seftitle = cleanx($_POST['title'],'SEF');}else {$seftitle = cleanx($_POST['seftitle'],'SEF');}
	$display_title = !$_POST['display_title'] ? 'NO' : 'YES';
	$byline = !$_POST['byline'] ? 'NO' : 'YES';
	$visible = !$_POST['visible'] ? 'NO' : 'YES';
	$comments = !$_POST['comments'] ? 'NO' : 'YES';
	$category = r('id','categories','title',$_POST['category']);
	$querys = array('title'=>$_POST['title'],'seftitle'=>$seftitle,'text'=>$text = addslashes($_POST['text']),'category'=>$category,'artorder'=>$_POST['artorder'],'visible'=>$visible,'public'=>$_POST['public'],'comments'=>$comments,'byline'=>$byline,'date'=>time(),'postedBy'=>$_SESSION['id'],'display_title'=>$display_title);
	foreach ($querys as $key => $value){
	mysql_query('UPDATE `articles` SET `'.$key.'` = "'.$value.'" WHERE id='.$id.'');
	}
	sm('article_updated');
	break; case 'update_category':
	// Update Category
	$id = $_POST['id'];
	$seftitle = !empty($_POST['seftitle']) ? cleanx($_POST['seftitle'],'SEF') : cleanx($_POST['title'],'SEF');
	$visible = !$_POST['visible'] ? 'NO' : 'YES';
	$querys = array('title'=>$_POST['title'],'seftitle'=>$seftitle,'catorder'=>$_POST['catorder'],'visible'=>$visible,'max'=>$_POST['max'],'public'=>$_POST['public'],'sortBy'=>$_POST['sortBy']);
	foreach ($querys as $key => $value){
	mysql_query('UPDATE `categories` SET `'.$key.'` = "'.$value.'" WHERE id='.$id.'');
	}
	sm('category_updated');
	break; case 'update_site_settings':
	// Update Setting
	$offline = isset($_POST['offline']) ? 'YES' : 'NO';
	$querys = array('title'=>$_POST['website_title'],'subtitle'=>$_POST['subtitle'],'email'=>$_POST['website_email'],'keywords'=>$_POST['keywords'],'description'=>$_POST['description'],'offline'=>$offline,'offline_message'=>$_POST['offline_message'],'footer'=>$_POST['footer']);
	foreach ($querys as $key => $value){
	mysql_query('UPDATE `settings` SET `value` = "'.$value.'" WHERE name="'.$key.'"');
	}
	sm('settings_saved');
	break; case 'update_site_comments':
	$ca = isset($_POST['comment_approval']) ? 'YES' : 'NO';
	$cp = isset($_POST['comment_permissions']) ? 'YES' : 'NO';
	$cf = isset($_POST['comments_freeze']) ? 'YES' : 'NO';
	$querys = array('comments_freeze'=>$cf,'comments_order'=>$_POST['comments_order'],'comment_permissions'=>$cp,'comments_limit'=>$_POST['comments_limit'],'comment_approval'=>$ca);
	foreach ($querys as $key => $value){
	mysql_query('UPDATE `settings` SET `value` = "'.$value.'" WHERE name="'.$key.'"');
	}
	sm('settings_saved');
	break; case 'update_site_articles':
	$new_on_home = isset($_POST['new_on_home']) ? 'YES' : 'NO';
	$article_views = isset($_POST['article_views']) ? 'YES' : 'NO';
	$article_ratings = isset($_POST['article_ratings']) ? 'YES': 'NO';
	$wysiwyg = isset($_POST['wysiwyg']) ? 'YES': 'NO';
	$querys = array('new_on_home'=>$new_on_home,'article_views'=>$article_views,'article_ratings'=>$article_ratings,'date_format'=>$_POST['date_format'],'wysiwyg'=>$wysiwyg);
	foreach ($querys as $key => $value){
	mysql_query('UPDATE `settings` SET `value` = "'.$value.'" WHERE name="'.$key.'"');
	}
	sm('settings_saved');
	break; case 'update_site_rss':
	mysql_query('UPDATE `settings` SET `value` = "'.isset($_POST['rssArticles']) ? 'YES' : 'NO'.'" WHERE name="rss_articles"');
	mysql_query('UPDATE `settings` SET `value` = "'.isset($_POST['rssComments']) ? 'YES' : 'NO'.'" WHERE name="rss_comments"');
	mysql_query('UPDATE `settings` SET `value` = "'.$_POST['rssLimit'].'" WHERE name="rss_limit"');
	sm('settings_saved');
	break; case 'update_site_diag':
	$eor = isset($_POST['email_on_register']) ? 'YES':'NO';
	$eoc = isset($_POST['email_on_comment']) ? 'YES':'NO';
	mysql_query('UPDATE `settings` SET `value` = "'.$eor.'" WHERE name="email_on_register"');
	mysql_query('UPDATE `settings` SET `value` = "'.$eoc.'" WHERE name="email_on_comment"');
	sm('settings_saved');
	break; case 'update_site_users':
	$rd = isset($_POST['registration_disabled']) ? 'YES':'NO';
	$ld = isset($_POST['login_disabled']) ? 'YES':'NO';
	$re = isset($_POST['register_email']) ? 'YES':'NO';
	mysql_query('UPDATE `settings` SET `value` = "'.$rd.'" WHERE name="registration_disabled"');
	mysql_query('UPDATE `settings` SET `value` = "'.$ld.'" WHERE name="login_disabled"');
	mysql_query('UPDATE `settings` SET `value` = "'.$re.'" WHERE name="register_email"');
	sm('settings_saved');
	break; case 'create_user':
	$cEmail = cleanx($_POST['email'],'user_input');
	$cName = cleanx($_POST['name'],'user_input');
	$cUsername = cleanx($_POST['username'],'user_input');
	$cPassword = cleanx($_POST['password'],'user_input');
	$id = idCount('users');
	$usermatch = mysql_query('SELECT id FROM `users` WHERE username = "'.$cUsername.'"');
	$permissions = 'user';
	switch(TRUE){
	case empty($_POST['name']):
	case empty($_POST['username']):
	case empty($_POST['password']):
	case empty($_POST['email']):
	sm('register-fieldsMissing');
	break;
	case mysql_num_rows($usermatch)>0:
	sm('register-username_taken');
	break;
	default:
		if(isset($_POST['permissions'])){
			$permissions = 'administrator';
		}
		if($_POST['name']==$cName && $_POST['password']==$cPassword && $_POST['username']==$cUsername && $_POST['email']==$cEmail){
			$sql = 'INSERT INTO `users` VALUES ("'.$id.'", "'.$cUsername.'", "'.pass($cUsername,$cPassword).'", "'.$cName.'", "'.$cEmail.'", "NO", "'.$permissions.'", "'.$_SERVER['REMOTE_ADDR'].'", "'.$_SERVER['REMOTE_ADDR'].'", "NO", "'.time().'", "'.time().'", "'.$_SERVER['HTTP_USER_AGENT'].'", "'.md5($cUsername.pass($cUsername,$cPassword).$id.$permissions).'","","","",",","","")';
			chkSQL($sql,'user_added');
		}else {
		sm('register-invalidCharactors');
		}
	}
	break; 
	case 'file-create':
		if(!empty($_POST['filename']) && !empty($_POST['content'])){
		$path = $_GET['path'];
		switch($path){
			case NULL:
			case '':
				$path = './';
			break;
			default:
				$path = $_GET['path'].'/';
				str_replace('//','/',$path);
		}
		$file = fopen($path.$_POST['filename'],'w');
		fwrite($file,$_POST['content']);
		fclose($file);
		sm('file-created');
		}
	break; case 'upload_file':
	$path = $_GET['path'];
	if(!isset($_GET['path']) || empty($path) || $path=='.'){
		$uploadLocation = './';
	}else {
		$uploadLocation = str_replace('//','/',$path.'/');
	}
	if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadLocation.basename($_FILES['file']['name']))){
		sm('upload-succesful');
	}
	break;
	case 'edit_file':
	if(!empty($_POST['content'])){
		$file = $_POST['file'];
		$file = fopen($file,'w');
		fwrite($file,$_POST['content']);
		fclose($file);
		sm('file-created');
		}
	break;
	case 'update_template':
		$template = $_POST['template'];
		$path = 'templates/'.$template.'/';
		$handle = opendir($path);
		if($template!=s('template')){
		while (FALSE !== ($file = readdir($handle))){
			    $filename = $file;
		        $file = $path.$file;
				if(is_file($file) && $filename=='index.php'){
				$sql = 'UPDATE `settings` SET `value` = "'.$template.'" WHERE name="template"';
				chkSQL($sql,'settings_saved');
				}
			}
		}
// End of POST		
}
switch($get){
	//USERS
	case 'ban_user':
	$banned = r('banned','users','id',$_GET['id'])=='NO' ? 'YES' : 'NO';
	chkSQL('UPDATE `users` SET `banned` = "'.$banned.'" WHERE id='.$_GET['id'],'ban_user');
	break; case 'per_user':
	$id = $_GET['id'];
	if(r('permissions','users','id',$id)=='administrator'){
	$permissions = 'user';
	$uniqueID =  md5(r('username','users','id',$id).r('password','users','id',$id).$id.$permissions);
	}else{
	$permissions = 'administrator';
	$uniqueID =  md5(r('username','users','id',$id).r('password','users','id',$id).$id.$permissions);
	}
	mysql_query('UPDATE `users` SET `permissions` = "'.$permissions.'" WHERE id='.$id);
	chkSQL('UPDATE `users` SET `uniqueID` = "'.$uniqueID.'" WHERE id='.$id,'per_user');
	break; case 'del_user':
	chkSQL('DELETE FROM `users` WHERE id='.$_GET['id'],'del_user');
	// CATEGORIES
	break; case 'del_category':
	chkSQL('DELETE FROM `categories` WHERE id='.$_GET['id'],'del_category');
	break; case 'public_category':
	chkSQL('UPDATE `categories` SET `public` = "'.$_GET['public'].'" WHERE id='.$_GET['id'],'pub_category');
	break; case 'hide_category':
	$visible = r('visible','categories','id',$_GET['id'])=='NO' ? 'YES':'NO';
	chkSQL('UPDATE `categories` SET `visible` = "'.$visible.'" WHERE id='.$_GET['id'],'vis_category');
	break; case 'update_category_order':
	$id = $_GET['id'];
	$order_id = $_GET['order_id'];
	if($_GET['order']=='up'){$order_id++;}
	if($_GET['order']=='down'){$order_id--;}
	chkSQL('UPDATE `categories` SET `catorder` = "'.$order_id.'" WHERE id='.$id,'category_order');
	// ARTICLES
	break; case 'update_article_order':
	$order_id = $_GET['order_id'];
	if($_GET['order']=='up'){$order_id++;}
	if($_GET['order']=='down'){$order_id--;}
	chkSQL('UPDATE `articles` SET `artorder` = "'.$order_id.'" WHERE id='.$_GET['id'],'article_order');
	break; case 'del_article':
	chkSQL('DELETE FROM `articles` WHERE id='.$_GET['id'],'del_article');
	mysql_query('DELETE FROM `comments` WHERE articleID='.$_GET['id']);
	
	break; case 'vis_article':
	$visible =  r('visible','articles','id',$_GET['id'])=='NO' ? 'YES' : 'NO';
	chkSQL('UPDATE `articles` SET `visible` = "'.$visible.'" WHERE id='.$_GET['id'],'vis_article');
	
	break; case 'pub_article':
	chkSQL('UPDATE `articles` SET `public` = "'.$_GET['public'].'" WHERE id="'.$_GET['id'].'"','pub_article');
	// COMMENTS
	break; case 'del_comment':
	chkSQL('DELETE FROM `comments` WHERE id='.$_GET['id'],'del_comment');
	break; case 'rename_file':
	rename($_GET['id'],$_GET['path'].'/'.$_GET['new_filename']);
	sm('file-renamed');
	break; case 'copy_file':
	copy($_GET['id'],$_GET['path'].'/'.$_GET['new_filename']);
	sm('file-copied');
	break; case 'del_template':
	dir_del('./templates/'.$_GET['id']);
	sm('directory-deleted');
	break; case 'copy_dir':
	dir_copy($_GET['id'],$_GET['path'].'/'.$_GET['new_filename']);
	sm('directory-copied');
	break; case 'rmdir':
	dir_del($_GET['file']);
	sm('directory-deleted');
	break; case 'delete_file':
	unlink($_GET['file']);
	sm('file-deleted');
	break; case 'new_dir':
	if(!empty($_GET['dir_name'])){
	mkdir(str_replace('//','/',$_GET['path'].'/').$_GET['dir_name']);
	sm('directory-created');
	}
	break; case 'onoff':
	$status = s('offline')=='YES' ? 'NO' : 'YES';
	mysql_query('UPDATE `settings` SET `value` = "'.$status.'" WHERE name="offline"');
	break; case 'test':
	if($_SESSION['template']==$_GET['template']){
	$_SESSION['template'] = NULL;
	}else {
	$_SESSION['template'] = $_GET['template'];
	}
	break;
	
}
?>