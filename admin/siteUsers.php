<?php
if(s('registration_disabled')=='YES'){$reg = 'checked';}
if(s('login_disabled')=='YES'){$user = 'checked';}
if(s('register_email')=='YES'){$re = 'checked';}
echo '<fieldset><legend><a onclick="toggle(\'site_users\')" '.l('cursor').'>'.l('users').'</a></legend>
<div id="site_users" class="admin_content" style="display: none;">';
form('form','','user_settings','','','','post',_ADMIN.'settings');
form('checkbox','registration_disabled','registration_disabled','YES',$reg);
form('checkbox','login_disabled','login_disabled','YES',$user);
form('checkbox','register_email','register_email','YES',$re);
form('hidden',l('post'),'','update_site_users');
form('submit','submit','update');
echo '</div>
</fieldset>';
?>