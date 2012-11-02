<?php
if(s('new_on_home')=='YES'){$new_on_home = 'checked';}
if(s('wysiwyg')=='YES'){$wysiwyg = 'checked';}
echo '<fieldset><legend><a onclick="toggle(\'site_articles\')" '.l('cursor').'>'.l('articles').'</a></legend>
<div id="site_articles" class="admin_content" style="display: none;">';
form('form','','article_settings','','','','post',_ADMIN.'settings');
form('text','date_format','date_format',s('date_format'));
form('checkbox','new_on_home','new_on_home','YES',$new_on_home);
form('checkbox','wysiwyg','wysiwyg','YES',$wysiwyg);
form('hidden',l('post'),'','update_site_articles');
form('submit','submit','update');
echo '</div>
</fieldset>';
?>