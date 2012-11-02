<?php
// Contact FUnction
if($_POST['action']=='email'){
	$header = 'From: '.$_POST['email'].''."\r\n";
	$header .= $_POST['name'].' at '.$_POST['email']."\r\n";
	$subject = s('title').'Feedback';
	postman($subject,$_POST['message'],$header);
	sm('email-success');
}else {
echo '<div id="email_form">';
moo(l('contact'));
form('form','','','','','','post',_PLACE.'contact');
form('text','name','name');
form('text','email','email');
form('textarea','message','message');
form('hidden','action','','email');
form('submit','submit','send');
echo '</div>';
}
?>