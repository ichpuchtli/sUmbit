<?php
echo '<fieldset><legend><a onclick="toggle(\'filecreator\')" style="cursor: pointer;">'.l('file_creator').'</a></legend>
<div id="filecreator" class="admin_content">';
form('form','','file_creator','','','','post',_ADMIN.'files&path='.$_GET['path']);
form('text','filename','filename');
form('textarea','content','filecontent','','','style="height:250px; width:99%;"');
form('hidden',l('post'),'','file-create');
form('submit','submit','create');
echo '</div>
</fieldset>';
?>