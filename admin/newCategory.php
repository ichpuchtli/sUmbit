<?php
$c = mysql_fetch_assoc(mysql_query('SELECT MAX(catorder) FROM categories'));
$catorder = $c['MAX(catorder)']+1;
echo '<fieldset><legend><a onclick="toggle(\'new_category\')" style="cursor: pointer;">'.l('new_category').'</a></legend>
<div id="new_category" class="admin_content">';
form('form','','new_category','','','','post',_ADMIN.'categories');
form('text','title','title');
form('text','catorder','category_order',$catorder);
form('text','max','max_articles',0);
echo '<p>
<label for="asort" >'.l('sortBy').'</label><br />
<select id="asort" name="sortBy" size="5">
<option selected="selected" >artorder</option>
<option>id asc</option>
<option>id desc</option>
<option>views asc</option>
<option>views desc</option>
</select>
</p><p>
<label for="public" >'.l('public').'</label><br />
<select id="public" name="public" size="3">
<option selected="selected" >'.l('yes').'</option>
<option>'.l('no').'</option>
<option>'.l('spc').'</option>
</select>
</p>';
form('checkbox','visible','visible','YES','checked');
form('hidden',l('post'),'','add_category');
form('submit','submit','new_category');
echo '</div>
</fieldset>';
?>