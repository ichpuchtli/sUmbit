<?php
$cName = cleanx($_POST['name'],'user_input_name');
$cUsername = cleanx($_POST['username'],'user_input');
$cPassword = cleanx($_POST['password'],'user_input');
$cEmail = cleanx($_POST['email'],'user_input');
$id = idCount('users');
$time = microtime(TRUE);
$usermatch = mysql_query('SELECT id FROM `users` WHERE username = "'.$cUsername.'"');
if($_POST['action']=='register'){
switch(FALSE){
case isset($_POST['name']):
case isset($_POST['username']):
case isset($_POST['password']):
case isset($_POST['email']):
	sm('register-fieldsMissing');
	redirect();
break;
case $_POST['name']==$cName:
case $_POST['password']==$cPassword:
case $_POST['username']==$cUsername:
case $_POST['email']==$cEmail:
	sm('register-invalidCharactors');
	redirect();
break;
case mysql_num_rows($usermatch)==0:
	sm('register-username_taken');
	redirect();
break;
default:
$banned = s('register_email') == 'YES' ? 'YES' : 'NO';
			mysql_query('INSERT INTO `users` VALUES ("'.$id.'", "'.$cUsername.'", "'.pass($cUsername,$cPassword).'", "'.$cName.'", "'.$cEmail.'", "'.$banned.'", "user", "'.$_SERVER['REMOTE_ADDR'].'", "'.$_SERVER['REMOTE_ADDR'].'", "NO", "'.$time.'", "'.$time.'", "'.$_SERVER['HTTP_USER_AGENT'].'", "'.md5($cUsername.pass($cUsername,$cPassword).$id.'user').'" ,"","","","","","","")');
			if($banned=='YES'){
		$subject = s('title').' - User Activation';
		$message = 'Your account at '._SITE.' requires activation <a href="'._SITE._PLACE.'login&task=approve&token='.md5($id.$time).'&id='.$id.'">click here</a> to activate your account<br /><br />Username: '.$cUsername.'<br />Password: '.$cPassword.'<br />';
		postman($subject,$message,$cEmail);
		sm('register-email-sent');
		redirect(_PLACE.'login');
		}else {
		sm('register-success');
		redirect(_PLACE.'login');
		if(s('email_on_register')=='YES'){
		$subject = s('title').' - New user';
		$message = 'A new user has registerd with '._SITE.'	<br />Name:'.$cName.'<br />Username: '.$cUsername.'<br />Email:'.$cEmail.'<br />Registerd on:'.date(s('date_format'),$time);
		postman($subject,$message);
		}
		}
}
	
		
}else{
		if(s('registration_disabled')=='NO'){
		echo '<div class="register_form">';
		moo(l('register'));
		form('form','','','','','','post',_PLACE.'register');
		form('text','name','register_name');
		form('text','username','register_username');
		form('password','password','register_password');
		form('text','email','register_form_email');
		form('hidden','action','','register');
		form('submit','update','register');
		echo'</div>';
		}else {
		sm('register-banned');
		}
	}	
?>