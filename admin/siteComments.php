<?php
if(s('comments_freeze')=='YES'){$freeze = 'checked=';}
if(s('comments_order')=='DESC'){$order_desc = 'checked';}else {$order_asc = 'checked';}
if(s('comment_permissions')=='YES'){$reg = 'checked';}
if(s('comment_approval')=='YES'){$app = 'checked';}
echo '<fieldset><legend><a onclick="toggle(\'site_comments\')" '.l('cursor').'>'.l('comments').'</a></legend>
<div id="site_comments" class="admin_content" style="display: none;">';
form('form','','comment_settings','','','','post',_ADMIN.'settings');
form('text','comments_limit','comments_limit',s('comments_limit'));
form('checkbox','commments_freeze','comments_freeze','YES',$freeze);
echo l('comments_order').'<br />';
form('radio','comments_order','comments_sort_asc','asc',$order_asc);
form('radio','comments_order','comments_sort_desc','desc',$order_desc);
form('checkbox','comment_permissions','comments_permissions','YES',$reg);
form('checkbox','comment_approval','comments_approval','YES',$app);
form('hidden',l('post'),'','update_site_comments');
form('submit','submit','update');
echo '</div>
</fieldset>';
?>