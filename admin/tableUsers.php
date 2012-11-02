<?php
$users = mysql_query('SELECT id,name,username,banned,permissions FROM `users` ORDER BY id');
$trail = _ADMIN.'users'._ACTION;
echo '<div id="table_users" class="admin_content">
<table class="adminTables" width="100%" cellspacing="1" border="0">
<tr>
<th width="6%">'.l('id').'</th>
<th width="31%">'.l('name').'</th>
<th width="31%">'.l('username').'</th>
<th width="12%">'.l('permissions').'</th>
<th width="10%">'.l('banned').'</th>
<th width="10%">'.l('delete').'</th>
</tr>';
while($r = mysql_fetch_assoc($users)){
$banned = $r['banned']=='NO' ? l('no') : l('yes');
echo '<tr>
<td>'.$r['id'].'</td>
<td>'.$r['name'].'</td>
<td>'.$r['username'].'</td>
<td><a href="'.$trail.'per_user&id='.$r['id'].'">'.$r['permissions'].'</a></td>
<td><a href="'.$trail.'ban_user&id='.$r['id'].'">'.$banned.'</a></td>
<td><a onclick="approve(\''.$trail.'del_user&id='.$r['id'].'\')" '.l('cursor').'>'.l('delete').'</a></td>
</tr>';
}
echo '</table>
</div>';
?>