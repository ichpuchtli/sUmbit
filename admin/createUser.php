<?php
echo '<fieldset><legend><a onclick="toggle(\'create_user_admin\')" '.l('cursor').'>'.l('new_user').'</a></legend>
<div id="create_user_admin" class="admin_content">';
form('form','','diagnostic_settings','','','','post',_ADMIN.'users');
form('text','name','name');
form('text','username','username');
form('password','password','password');
form('text','email','email');
form('checkbox','permissions','administrator','administrator');
form('hidden',l('post'),'','create_user');
form('submit','submit','create');
echo '</div>
</fieldset>';
?>