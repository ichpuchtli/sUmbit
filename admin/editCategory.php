<?php
$id = $_GET['id'];
$query = mysql_query('SELECT id,title,seftitle,catorder,max,sortBy,public,visible FROM `categories` WHERE id="'.$id.'"');
$r = mysql_fetch_assoc($query);
$public = array(l('yes'), l('no'), l('spc'));
$sortBy = array('artorder', 'id asc', 'id desc', 'views asc', 'views desc');
if($r['visible']=='YES') $vis = 'checked';
if($r['public']=='YES') $public_category = 'checked';
echo '<fieldset><legend>'.l('edit_category').' ['.$r['title'].']</legend>
<div id="edit_category" class="admin_content">';
form('form','','edit_category','','','','post',_ADMIN.'categories');
form('text','title','title',$r['title']);
form('text','seftitle','seftitle',$r['seftitle']);
form('text','catorder','category_order',$r['catorder']);
form('text','max','max_articles',$r['max']);
echo '<p><label for="sortBy" >'.l('sortBy').'</label><br />
<select id="sotrBy" name="sortBy" size="5">';
foreach ($sortBy as $sort){
echo '<option ';
if($sort==$r['sortBy']){echo 'selected="selected"';}
echo '>'.$sort.'</option>';
}
echo '</select>
</p><p>
<label for="public" >'.l('public').'</label><br />
<select id="public" name="public" size="3">';
foreach ($public as $public_name){
echo '<option ';
if($public_name == $r['public']){echo 'selected="selected"';}
echo '>'.$public_name.'</option>';
}
echo '</select>
</p>';
form('checkbox','visible','visible','YES',$vis);
form('hidden','id','',$r['id']);
form('hidden',l('post'),'','update_category');
form('submit','submit','update');
echo '</div>
</fieldset';
?>