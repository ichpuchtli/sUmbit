<?php
$result = mysql_query('SELECT id,title,seftitle,visible,public,catorder,max FROM `categories` ORDER BY id');
$trail = _ADMIN.'categories';
echo '<div id="table_categories" class="admin_content">
<table class="adminTables" width="100%" cellspacing="1" border="0">
<tr>
<th width="3%">'.l('id').'</th>
<th width="27%">'.l('title').'</th>
<th width="30%">'.l('seftitle').'</th>
<th width="5%">'.l('visible').'</th>
<th width="5%">'.l('public').'</th>
<th width="5%">'.l('order').'</th>
<th width="5%">'.l('max').'</th>
<th width="5%">'.l('up').'</th>
<th width="5%">'.l('down').'</th>
<th width="5%">'.l('delete').'</th>
<th width="5%">'.l('edit').'</th>
</tr>';
while($r = mysql_fetch_assoc($result)){
$public = $r['public']=='YES' ? 'NO' : 'YES';
echo '<tr>
<td>'.$r['id'].'</td>
<td>'.$r['title'].'</td>
<td>'.$r['seftitle'].'</td>
<td><a href="'.$trail._ACTION.'hide_category&id='.$r['id'].'">'.$r['visible'].'</a></td>
<td><a href="'.$trail._ACTION.'public_category&id='.$r['id'].'&public='.$public.'">'.$r['public'].'</a></td>
<td>'.$r['catorder'].'</td>
<td>'.$r['max'].'</td>
<td><a href="'.$trail._ACTION.'update_category_order&order=up&id='.$r['id'].'&order_id='.$r['catorder'].'">'.l('up').'</a></td>
<td><a href="'.$trail._ACTION.'update_category_order&order=down&id='.$r['id'].'&order_id='.$r['catorder'].'">'.l('down').'</a></td>
<td><a onclick="approve(\''.$trail._ACTION.'del_category&id='.$r['id'].'\')" '.l('cursor').'>'.l('delete').'</a></td>
<td><a href="'._ADMIN.'edit_category&action=edit_category&id='.$r['id'].'">'.l('edit').'</a></td>
<tr>';
}
echo '</table>
</div>
</fieldset>';
?>