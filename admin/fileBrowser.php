<?php
if(isset($_GET['path'])){
	$path =  $_GET['path'];
}
if($path==''){$path = '.';}
echo '<fieldset><legend><a onclick="toggle(\'filebrowser\')" '.l('cursor').'>'.l('file_browser').'</a></legend>
<div id="filebrowser" class="admin_content">';
if(isset($_GET['dirname'])){mkdir($path.'/'.$_GET['dirname']);sm('directory-created');redirect(_ADMIN.'files');}
echo '<table class="adminTables" width="100%" cellspacing="1" cellpadding="0" border="0">
<tr>
<td colspan="3">
<form method="get" class="admin_address" action="'._ADMIN.'files">
<input style="width:99%;margin:0px;" type="text" name="path" value="'.$path.'"/>
<input type="hidden" name="'.l('_admin').'"  value="files" />
</form>
</td>
<td>'.l('address').'</td>
</tr>
<tr>
<th style="text-align:left;"><img src="images/home.png" class="comment_img" />
<a href="'._ADMIN.'files&path=.">'.l('home').'</a>
</th>
<th>';
$up = substr($path, 0, (strrpos(dirname($path.'/.'),'/')));
if($up==''){$up='.';}
echo '<img src="images/up.png" class="comment_img" /><a href="'._ADMIN.'files&path='.$up.'">'.l('up-one-level').'</a>
</th>
<th>
<a onclick="prompter(\''._ADMIN.'files&path='.$path._ACTION.'new_dir&dir_name=\',\''.l('directory_name').':\')" '.l('cursor').'>'.l('new_directory').'</a>
</th>
<th>Actions</th>
</tr>';
if ($handle = opendir($path)){
	while (FALSE !== ($file = readdir($handle))){
		if ($file != '.' && $file != '..'){
			$fName = $file;
			$file = $path.'/'.$file;
			if(is_file($file)) {
				$filesize = filesize($file);
				switch($filesize){
					case $filesize < 1024:
						$filesize = $filesize.' bytes';
					break;
					case $filesize > 1024 && $filesize < 1048576:
						$filesize = round(($filesize/1024),2).' Kb';
					break;
					case $filesize > 1048576:
						$filesize = ($filesize/1048576). 'Mb';
					break;
				}
                   echo '<tr>
				   <td style="text-align:left;"> <img src="images/file.png" width="16" height="16" alt="" class="comment_img" style="vertical-align:middle;"/><a href="'.$file.'">'.$fName.'</a></td>
				   <td>'.date('dS M, Y', filemtime($file)).'</td>
                   <td>'.$filesize.'</td>
                   <td><a onclick="prompter(\''._ADMIN.'files&path='.$path._ACTION.'rename_file&id='.$file.'&new_filename=\',\'New Filename:\',\''.$fName.'\')" '.l('cursor').'>Rename</a> - 
                    <a onclick="prompter(\''._ADMIN.'files&path='.$path._ACTION.'copy_file&id='.$file.'&new_filename=\',\'New Filename:\',\''.$fName.'\')" '.l('cursor').'>Copy</a> - <a href="'._ADMIN.'edit_file&path='.$_GET['path'].'&file='.$file.'">Edit</a> - 
				   <a onclick="approve(\''._ADMIN.'files&path='.$_GET['path']._ACTION.'delete_file&file='.$file.'\')" '.l('cursor').'>Delete</a></td>
				   </tr>';
               } elseif (is_dir($file)) {
                   print '<tr>
				   <td style="text-align:left;"><img src="images/folder.png" width="16" height="16" alt="" class="comment_img" style="vertical-align:middle;"/> <a href="'._ADMIN.'files&path='.$file.'">'.$fName.'</a></td>
				   <td>'.date('dS M, Y', filemtime($file)).'</td>
				   <td>'.l('directory').'</td>
				   <td><a onclick="prompter(\''._ADMIN.'files&path='.$path._ACTION.'rename_file&id='.$file.'&new_filename=\',\'New Filename:\',\''.$fName.'\')" '.l('cursor').'>Rename</a> - 
                   <a onclick="prompter(\''._ADMIN.'files&path='.$path._ACTION.'copy_dir&id='.$file.'&new_filename=\',\'New Filename:\',\''.$fName.'\')" '.l('cursor').'>Copy</a> - 
				   <a onclick="approve(\''._ADMIN.'files&path='.$_GET['path']._ACTION.'rmdir&file='.$file.'\')" '.l('cursor').'>Delete</a></td>
				   </tr>';
               }
           }
       }
}
closedir($handle);
echo '
</table>
</div>
</fieldset>';
?>