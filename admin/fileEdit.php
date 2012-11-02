<?php
$file = $_GET['file'];
$fileName = basename($file);
$rows = count(file($file));
$rows = $rows > 5 ? $rows+2 : 20 ;
echo '<fieldset><legend><a name="files" onclick="toggle(\'file_edit\')" '.l('cursor').'>Editing ['.$fileName.']</a></legend>
<div id="file_edit" class="admin_content">
<input type="submit" class="form_submit" value="'.l('save').'" onclick="save_return(\''._ADMIN.'edit_file&path='.$_GET['path'].'&file='.$file.'\')"/>
<input type="submit" class="form_submit" value="'.l('save&close').'" />
<a href="'._ADMIN.'files&path='.$_GET['path'].'"><input class="form_submit" type="button" value="'.l('return').'" /></a>
<a onclick="approve(\''._ADMIN.'files&path='.$_GET['path']._ACTION.'delete_file&file='.$file.'\')" '.l('cursor').'><input class="form_submit" type="button" value="'.l('delete').'" /></a>';
form('form','','edit_file','','','','post',_ADMIN.'files&path='.$_GET['path']);
echo '<textarea name="content" rows="'.$rows.'" class="large_textarea">
'.file_get_contents($file).'
</textarea>
<input type="hidden" name="action" value="edit_file" />
<input type="hidden" name="file" value="'.$file.'" />
<input type="submit" class="form_submit" value="'.l('save').'" onclick="save_return(\''._ADMIN.'edit_file&path='.$_GET['path'].'&file='.$file.'\')"/>
<input type="submit" class="form_submit" value="'.l('save&close').'" />
<a href="'._ADMIN.'files&path='.$_GET['path'].'"><input class="form_submit" type="button" value="'.l('return').'" /></a>
<a onclick="approve(\''._ADMIN.'files&path='.$_GET['path']._ACTION.'delete_file&file='.$file.'\')" '.l('cursor').'><input class="form_submit" type="button" value="'.l('delete').'" /></a>
</form>
</div>
</fieldset>';
?>