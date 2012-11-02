<?php
$comments = mysql_query('SELECT id,articleID,userID,comment,websiteURL FROM `comments` ORDER BY id');
$trail = _ADMIN.'comments';
echo '<div id="table_comments" class="admin_content">
<table class="adminTables" width="100%" cellspacing="1" border="0">
<tr>
<th width="5%">'.l('id').'</th>
<th width="20%">'.l('article').'</th>
<th width="15%">'.l('username').'</th>
<th width="55%">'.l('comment').'</th>
<th width="5%">'.l('delete').'</th>
</tr>';
while($r = mysql_fetch_assoc($comments)){
if($r['websiteURL']){
$name = '<a href="'._SITE._PLACE.'users&user='.r('name','users','id',$r['userID']).'">'.r('name','users','id',$r['userID']).'</a>';
}else{
$name = $r['userID'];
}
echo '<tr>
<td>'.$r['id'].'</td>
<td>'.r('title','articles','id',$r['articleID']).'</td>
<td>'.$name.'</td>
<td>'.htmlentities(substr($r['comment'],0,70)).'</td>
<td><a href="'.$trail._ACTION.'del_comment&id='.$r['id'].'">'.l('delete').'</a></td>
</tr>';
}
echo '</table>
</div>';
?>