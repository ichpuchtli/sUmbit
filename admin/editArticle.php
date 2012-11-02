<?php
$id = $_GET['id'];
$query  = mysql_query('SELECT id,title FROM `categories`');
$r = mysql_fetch_assoc(mysql_query('SELECT visible,display_title,comments,byline,title,seftitle,text,artorder,public,id,category FROM `articles` WHERE id="'.$id.'"'));
if($r['visible']=='YES'){$visible = 'checked';}
if($r['display_title']=='YES'){$display_title = 'checked';}
if($r['comments']=='YES'){$comments = 'checked';}
if($r['byline']=='YES'){$byline = 'checked';}
$public = array(l('yes'), l('no'), l('spc'));
echo '<fieldset><legend>'.l('edit_article').' ['.$r['title'].']</legend>
<div id="edit_article" class="admin_content">';
form('form','','edit_article','','','','post',_ADMIN.'manage');
form('text','title','title',$r['title']);
form('text','seftitle','seftitle',$r['seftitle']);
if(s('wysiwyg')=='YES'){
echo '<label for="admin_text">'.l('text').'</label><br />
<textarea name="text" id="admin_text">'.$r['text'].'</textarea><br />
<script type="text/javascript">
			WYSIWYG.attach(\'admin_text\', sUmbit);
		</script>';
}else{form('textarea','text','text',$r['text']);}
form('text','artorder','artorder',$r['artorder']);
echo '<p>
<label for="category" >'.l('category').'</label><br />
<select id="category" name="category" size="1">';
while($c = mysql_fetch_assoc($query)){
echo '<option ';
if ($r['category']==$c['id']) {echo ' selected="selected"';}
echo '>'.$c['title'].'</option>';}
echo '</select>
</p><p>
<label for="public" >'.l('public').'</label><br />
<select id="public" name="public" size="1">';
foreach ($public as $public_name){
echo '<option';
if($public_name == $r['public']){echo ' selected="selected"';}
echo '>'.$public_name.'</option>';
}
echo '</select>
</p>';
form('checkbox','visible','visible','YES',$visible);
form('checkbox','display_title','display_title','YES',$display_title);
form('checkbox','byline','byline','YES',$byline);
form('checkbox','comments','commentable','YES',$comments);
form('hidden','id','',$r['id']);
form('hidden',l('post'),'','update_article');
form('submit','submit','update');
echo '</div>
</fieldset>';
?>