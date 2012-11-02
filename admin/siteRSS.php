<?php
if(s('rss_comments')=='YES'){$rc = 'checked';}
if(s('rss_articles')=='YES'){$ra = 'checked';}
echo '<fieldset><legend><a onclick="toggle(\'site_rss\')" '.l('cursor').'>'.l('rss').'</a></legend>
<div id="site_rss" class="admin_content" style="display: none;">';
form('form','','rss_settings','','','','post',_ADMIN.'settings');
form('text','rssLimit','rss_limit',s('rss_limit'));
form('checkbox','rssComments','rss_comments','YES',$rc);
form('checkbox','rssArticles','rss_articles','YES',$ra);
form('hidden',l('post'),'','update_site_rss');
form('submit','submit','update');
echo '</div>
</fieldset>';
?>