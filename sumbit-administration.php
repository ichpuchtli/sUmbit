<?php 
include('sumbit-toolbox.php'); 

if($_POST['task']=='userLogin'){
	include(_INCLUDES.'gateKeeper.php');
}
//BILLBOARD
function message($zmessage){
	if(!empty($zmessage)){
		foreach($zmessage as $message){
		file_exists(_ADMIN_TEMPLATE.'billboard.php') ? 	include(_ADMIN_TEMPLATE.'billboard.php') : include(_ADMIN_TEMPLATE.'billboard.php');
		}
		$_SESSION['message'] = NULL;
	}
}
if(ticket($_SESSION['username'],$_SESSION['password'],$_SESSION['id'])=='administrator'){
	include(_INCLUDES.'admin.php');
	include(_INCLUDES.'processor.php');
}

function logout_link(){
	echo _SITE._PLACE.'logout&id='.md5($_SESSION['username']);
}
function account_link(){
	echo _SITE._PLACE.'users&username='.$_SESSION['username'];
}
function home_link(){
	echo _SITE;
}
function head(){
?>
<title><?php echo s('title'); ?> - Administration[sUmbit]</title>
<style type="text/css">
			<!--
			img.admin_img {vertical-align:middle;margin:2px;}
			-->
		</style>
<script type="text/javascript">
	function checkRadio(radioObj, newValue) {
		if(!radioObj)
			return;
		var radioLength = radioObj.length;
		if(radioLength == undefined) {
			radioObj.checked = (radioObj.value == newValue.toString());
			return;
		}
		for(var i = 0; i < radioLength; i++) {
			radioObj[i].checked = false;
			if(radioObj[i].value == newValue.toString()) {
				radioObj[i].checked = true;
			}
		}
	}

	function toggle(div) {
		var elem = document.getElementById(div);
		if (elem.style.display==''){
			elem.style.display='none';
		return;
	}
	elem.style.display='';
	}
	function approve(url) {
		var pass=confirm("<?php echo l('confirmation-box-message'); ?>")
		if (pass==true){
			window.location=url;
		}
	}	
	function prompter(url, message, default_val) {
		var name = prompt(message, default_val)
		if (name != null && name != ""){
			window.location=url + name;
		}
	}	
	function save_return(path) {
	document.forms[0].action = path;
	document.edit_file.submit();
	}
		</script>
<?php
	if(s('wysiwyg')=='YES'){
		if($_GET[l('_admin')]=='write' || $_GET[l('_admin')]=='edit_article'){
	?>
	<script type="text/javascript" src="<?php echo _SITE; ?>admin/wysiwyg/wysiwyg.js"></script>
	<script type="text/javascript" src="<?php echo _SITE; ?>admin/wysiwyg/wysiwyg-settings.js"></script>
	<?php 
	}
}

}
if(ticket($_SESSION['username'],$_SESSION['password'],$_SESSION['id'])!='administrator'){
?>
<html>
<head>
		<style type="text/css">
			<!--
			* {padding:0;}
			body {background:#fff;color:666;font-family: "Trebuchet MS", "verdana", "sans-serif";}
			#sumbit-admin-login { margin:10% auto 0;padding:15px;width:300px;border:1px solid #eee;background:#f9f9f9}
			input {padding:4px; border-left:1px solid #FFF;border-right:none;border-top:none;border-bottom:none;color:#666;font-size:1.2em;background:#d4f1c3;}
			input.form_input {width:99%;}
			input:hover, input:focus{padding:4px; background:#BEFC99;color:#410366;}
			input:focus{border-left:2px solid #FFF;}
			-->
		</style>
	</head>
	<body>
	<?php
		unset($_SESSION);
		echo '<div id="sumbit-admin-login">';
		moo(l('login'));
		echo '<form method="post" action="'._ADMIN.'home">';
		form('text','username','username','','','','','');
		form('password','password','password','','','','','');
		form('hidden','task','','userLogin','','','','');
		echo '<input type="submit" value="Login &raquo">
		</div>';
	?>
	</body>
</html>
<?php	
}else {
file_exists(_ADMIN_TEMPLATE.'index.php') ? include_once(_ADMIN_TEMPLATE.'index.php') : include_once(_ADMIN_DEFAULT.'index.php');
}
?>