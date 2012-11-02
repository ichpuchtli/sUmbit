<?php
	if($_GET[l('place')]!='logout'){
		if(!empty($_POST['username']) && !empty($_POST['password'])){
			$cUsername = cleanx($_POST['username'],'user_input');
			$cPassword = cleanx($_POST['password'],'user_input');
			$name = r('name','users','username',$cUsername);
			$id = r('id','users','username',$cUsername);
			$user_check = mysql_query('SELECT id FROM `users` WHERE username = "'.$cUsername.'" AND password = "'.pass($cUsername,$cPassword).'"');
			if(mysql_num_rows($user_check)==1){
				if(r('banned','users','id',$id)=='NO'){
				$time = microtime(TRUE);
					if(ticket($cUsername,$cPassword,$id)=='administrator'){
						$_SESSION['logged_in']=TRUE;
						$_SESSION['user_p']='administrator';
						$_SESSION['username']=$cUsername;
						$_SESSION['password']=$cPassword;
						$_SESSION['id']=$id;
						mysql_query('UPDATE `users` SET `ipVisit` = "'.$_SERVER['REMOTE_ADDR'].'" WHERE id="'.$id.'"');
						mysql_query('UPDATE `users` SET `lastVisit` = "'.$time.'" WHERE id="'.$id.'"');
						mysql_query('UPDATE `users` SET `online` = "YES" WHERE id="'.$id.'"');
						$_SESSION['message']='login-success';
					}else{
						if(s('login_disabled')=='NO'){
						mysql_query('UPDATE `users` SET `ipVisit` = "'.$_SERVER['REMOTE_ADDR'].'" WHERE id="'.$id.'"');
						mysql_query('UPDATE `users` SET `lastVisit` = "'.$time.'" WHERE id="'.$id.'"');
						mysql_query('UPDATE `users` SET `online` = "YES" WHERE id="'.$id.'"');
						$_SESSION['logged_in']=TRUE;
						$_SESSION['user_p']='user';
						$_SESSION['username']=$cUsername;
						$_SESSION['password']=$cPassword;
						$_SESSION['id']=$id;
						$_SESSION['message']='login-success';
						}else{
						$_SESSION['message']='login-user_login_disabled';
						redirect(_PLACE.'login');
						}
					}
				}else{
				$_SESSION['message']='login-user_banned';
				redirect(_PLACE.'login');
				}
			}else{
			$_SESSION['message']='wrong_username-password';
			redirect(_PLACE.'login');
			}
			
		}else{
		$_SESSION['message']='login-fields_missing';
		redirect(_PLACE.'login');
		}
	
}else {
mysql_query('UPDATE users SET online = "NO" WHERE id = "'.$_SESSION['id'].'"');
unset($_SESSION['logged_in']);
unset($_SESSION['user_p']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['id']);
redirect();
$_SESSION['message']='logged_out';
}
?>