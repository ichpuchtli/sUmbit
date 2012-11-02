<?php
if(s('email_on_register')=='YES'){$er = 'checked';}
if(s('email_on_comment')=='YES'){$ec = 'checked';}
echo '<fieldset><legend><a onclick="toggle(\'site_diag\')" '.l('cursor').'>'.l('notification').'</a></legend>
<div id="site_diag" class="admin_content" style="display: none;">';
form('form','','diagnostic_settings','','','','post',_ADMIN.'settings');
form('checkbox','email_on_register','email_on_register','YES',$er);
form('checkbox','email_on_comment','email_on_comment','YES',$ec);
form('hidden',l('post'),'','update_site_diag');
form('submit','submit','update');
echo '</div>
</fieldset>';
?>