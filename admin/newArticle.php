<?php
$categories = mysql_query('SELECT title FROM categories  ORDER BY catorder');
$r = mysql_fetch_assoc(mysql_query('SELECT MAX(artorder) FROM articles'));
$max = $r['MAX(artorder)']+1;
echo '<fieldset><legend><a onclick="toggle(\'new_article\')" style="cursor: pointer;">'.l('new_article').'</a></legend>
<div id="new_article" class="admin_content">';
form('form','','new_article','','','','post',_ADMIN.'manage');
form('text','title','title','','','','','');
if(s('wysiwyg')=='YES'){
echo '<label for="admin_text">'.l('text').'</label><br />
<textarea name="text" id="admin_text">'.$r['text'].'</textarea><br />
<script type="text/javascript">
			WYSIWYG.attach(\'admin_text\', sUmbit);
		</script>';
}else {form('textarea','text','text','','','style="height:400px; width:99%;"');}
echo '<p>
<label for="category" >'.l('category').'</label><br />
<select id="category" name="category" size="1">';
while($category = mysql_fetch_assoc($categories)){
echo '<option>'.$category['title'].'</option>';
} 
echo '
</select>
</p><p>
<label for="public" >'.l('public').'</label><br />
<select id="public" name="public" size="3">
<option selected="selected" >'.l('yes').'</option>
<option>'.l('no').'</option>
<option>'.l('spc').'</option>
</select>
</p>';
form('text','artorder','artorder',$max,'','','','');
form('checkbox','visible','visible','YES','checked','','','');
form('checkbox','comments','commentable','YES','checked','','','');
form('checkbox','byline','byline','YES','checked','','','');
form('checkbox','display_title','display_title','YES','checked','','','');
form('hidden',l('post'),'','add_article','','','','');
form('submit','submit','add_article','','','','','');
echo '</div>
</fieldset>';
?>