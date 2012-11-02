<?php
if(s('offline')=='YES'){$offline = 'checked';}
echo '<fieldset><legend><a onclick="toggle(\'site_settings\')" style="cursor: pointer;">'.l('settings').'</a></legend>
<div id="site_settings" style="display: none;">';
form('form','','site_settings','','','','post',_ADMIN.'settings');
form('text','website_title','website_title',s('title'),'','','');
form('text','website_email','website_email',s('email'),'','','');
form('textarea','subtitle','subtitle',s('subtitle'),'','settings','','','');
form('textarea','keywords','keywords',s('keywords'),'','settings','','','');
form('textarea','description','description',s('description'),'','settings','','');
form('textarea','offline_message','offline_message',s('offline_message'),'','settings','','');
form('textarea','footer','footer',s('footer'),'','settings','','');
form('checkbox','offline','offline','YES',$offline,'onclick="confirm(\''.l('confirmation-box-message').'\')"','','');
form('hidden',l('post'),'','update_site_settings');
form('submit','submit','update','','','','','');
echo '</div>
</fieldset>';
?>