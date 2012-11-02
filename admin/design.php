<?php
echo '<fieldset><legend><a onclick="toggle(\'templater\')" '.l('cursor').'>'.l('website_template').'</a></legend>
<div id="templater" class="admin_content">'; 
$path = './templates';
$handle = opendir($path);
echo '<form method="post" action="'._ADMIN.'design" id="templates">
<table class="adminTables" width="100%" cellspacing="1" border="0">
<tr>
<th width="5%">'.l('id').'</th>
<th width="65%">'.l('template_name').'</th>
<th width="10%">'.l('test').'</th>
<th width="10%">'.l('edit').'</th>
<th width="10%">'.l('delete').'</th>
</tr>';
$i = 0;
while (FALSE !== ($file = readdir($handle))){ 
	$filename = $file;
	$test = $_SESSION['template']==$filename ? '[Stop]' : l('try');
	$file = $path.'/'.$file;
	if($filename == s('template')){
		echo '<tr class="templateSelected">';
	}else{
		echo '<tr>';
	}
	if($filename!='.' && $filename!='..' && is_dir($file)){
		if($filename == s('template')){
			echo '<td><label for="template'.$i.'"><input type="radio" id="template'.$i.'" name="template" checked="checked" value="'.$filename.'" /></label></td>';
		}else {
			echo '<td><label for="template'.$i.'"><input type="radio" id="template'.$i.'" name="template" value="'.$filename.'"/></label></td>';
		}
		echo '<td><em><a onclick="checkRadio(document.forms[\'templates\'].elements[\'template\'], \''.$filename.'\');" href="#">'.$filename.'</a></em></td>';
		echo '<td><em><a href="'._ADMIN.'design'._ACTION.'test&template='.$filename.'">'.$test.'</a></em></td>';
		echo '<td><em><a href="'._ADMIN.'files&path=./templates/'.$filename.'">manage</a></em></td>';
		echo '<td><a onclick="approve(\''._ADMIN.'design'._ACTION.'del_template&id='.$filename.'\')" '.l('cursor').'>'.l('delete').'</a></td>';
		$i += 1;
	}
echo '</tr>';
}
echo '</table>';
form('hidden',l('post'),'','update_template');
form('submit','submit','update_website_template');
echo '</div>
</fieldset>';
?>