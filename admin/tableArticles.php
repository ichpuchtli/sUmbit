<?php
$result = mysql_query('SELECT id,category,title,seftitle,artorder,public,views,date,visible FROM `articles` ORDER BY id');
$trail = _ADMIN.'manage';
echo '<div id="table_articles" class="admin_content">
<table class="adminTables" width="100%" cellspacing="1" border="0">
<tr>
<th width="2%">'.l('id').'</th>
<th width="15%">'.l('category').'</th>
<th width="41%">'.l('title').'</th>
<th width="5%">'.l('order').'</th>
<th width="5%">'.l('visible').'</th>
<th width="5%">'.l('public').'</th>
<th width="5%">'.l('views').'</th>
<th width="10%">'.l('date').'</th>
<th width="7%">'.l('delete').'</th>
<th width="5%">'.l('edit').'</th>
</tr>';
while($r = mysql_fetch_assoc($result)){
$public = $r['public']=='YES' ? 'NO' : 'YES';
echo '<tr>
<td>'.$r['id'].'</td>
<td>'.r('title','categories','id',$r['category']).'</td>
<td>'.$r['title'].'</td>
<td>'.$r['artorder'].'</td>
<td><a href="'.$trail._ACTION.'vis_article&id='.$r['id'].'">'.$r['visible'].'</a></td>
<td><a href="'.$trail._ACTION.'pub_article&id='.$r['id'].'&public='.$public.'">'.$r['public'].'</a></td>
<td>'.$r['views'].'</td>
<td>'.date('d.m.y',$r['date']).'</td>
<td><a onclick="approve(\''.$trail._ACTION.'del_article&id='.$r['id'].'\')" '.l('cursor').'>'.l('delete').'</a></td>
<td><a href="'._ADMIN.'edit_article&id='.$r['id'].'">'.l('edit').'</a></td>
<tr>';
}
echo '</table>
</div>';
?>