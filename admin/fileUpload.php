<?php
echo '<fieldset><legend><a name="files" onclick="toggle(\'upload\')" '.l('cursor').'>'.l('upload_file').'</a></legend>
<div id="upload" class="admin_content">';
$path = $_GET['path'];
if(!isset($_GET['path']) || empty($path) || $path=='.'){
	$uploadLocation = './';
}else {
	$uploadLocation = str_replace('//','/',$path.'/');
}
echo '<form class="files_address" action="'._ADMIN.'files&path='.$path.'" method="post" enctype="multipart/form-data">
<label>'.l('uploading_to').''.$uploadLocation.'</label><br /><br />
<label for="file">'.l('filename').':</label>
<input type="hidden" name="'.l('post').'" value="upload_file" />
<input type="file" name="file" size="60" id="file" /><input type="submit" name="submit" value="'.l('upload').'" /> 
</form>
</div>
</fieldset>';
?>