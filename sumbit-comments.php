<?php
include('form.class.php');
$article = $_GET[l('_article')];
$category = $_GET[l('_category')];
$article_id = r('id','articles','seftitle',$article);
// NEW COMMENT
if($_POST['action']=='user_comment_submit'){
	$time = time();
	$user = $_SESSION['logged_in'] ? TRUE : FALSE;
	$approved =  s('comment_approval')=='YES' ? 'NO' : 'YES';
	$userID = $_SESSION['logged_in'] ? $_SESSION['id'] : cleanx($_POST['name'],'user_input');
	$sql = "INSERT INTO `comments` VALUES ('".idCount('comments')."', '".cleanx($_POST['comment'],'comment')."', '".$userID."', '".$article_id."', '".$user."', '".$time."', '".$approved."', '')";
	if(mysql_query($sql)){
		sm('comments-success');
	}
	if($approved=='NO' || s('email_on_comment')=='YES'){
		$subject = s('title').' - New Comment Posted';
		$message = 'A new comment has been posted on '._SITE.'<br />Article:'.r('title','articles','id',$article_id).'<br />Posted by:'.$name.'<br />Comment:'.$cComment.'<br />Posted on:'.date(s('date_format'),$time);
		if($approved=='NO'){
			$message .= '<br />This comment requires approval <a href="'._SITE._PLACE.'login&redirect=commentapproval">Login</a> to approve comment';
		}
		postman($subject,$message);
	}
	
		
		if(s('email_on_comment')=='YES'){
			if($userID/2==FALSE){$name = $userID;
			}else { 
				$name = r('name','users','id',$userID);}
				$subject = s('title').' - New Comment Posted';
				
				postman($subject,$message);
			}
}
if(isset($article)){
// BEGENNING OF COMMENTS
	$max = s('comments_limit')>-1 ? s('comments_limit') : 0 ;
	$order = s('comments_order');
	$page = $_GET['page'];
	if(empty($page)){
	$page = 1;
	}
	if(r('comments','articles','seftitle',$article)=='YES'){
		$real_num_comments = mysql_num_rows(mysql_query('SELECT id FROM `comments` WHERE approved = "YES" AND articleID="'.$article_id.'"'));
	}
	$limit = 'LIMIT ';
	$limit .= $max*$page-$max.', '.$max;
		if($max==0){
			$limit = '';
		}else{
			if($real_num_comments <= $max){
				$limit = '';
			}else {
				if(!isset($page)){
					$page = 1;
				}
			}
		}
		$query = mysql_query('SELECT userID,websiteURL,date,comment FROM `comments` WHERE approved = "YES" AND articleID='.$article_id.' ORDER by id '.$order.' '.$limit);
		$num_comments = mysql_num_rows($query);
			if($num_comments > 0 ){
				echo '<div id="comments"><ul>';
				$i=1;
				while($comment = mysql_fetch_assoc($query)){
				if($i % 2 > 0){$odd = ' class="odd"';}else{$odd=NULL;}
					if($comment['websiteURL']){
					$name = '<a href="'._SITE._PLACE.'users&user='.r('name','users','id',$comment['userID']).'">'.r('name','users','id',$comment['userID']).'</a>';
					}else{
						$name = $comment['userID'];
					}
					
				echo '<li'.$odd.'>
				<cite>'.$name.'</cite><div style="display:inline;padding-left:3px;" class="small">'.date(s('date_format'),$comment['date']).'</div><br />'.$comment['comment'].'
				</li>';
				$i++;
				}
				echo '</ul>';
				if($max!=0 || !empty($max)){
					if($real_num_comments % $max > 0){$leftover = 1;}
						$num_pages = (($real_num_comments - ($real_num_comments % $max)) / $max) + $leftover;
					if($num_pages>1){
						echo '<div class="pagination">';
						if(!isset($page)){$page = 1;}
						$pages=0;
						echo '<ul>';
						if($page>1){$prevpage = $page-1;$pager = _PAGE.$prevpage;
						echo '<li><a class="prevnext" href="'._SITE._CATEGORY.$category._ARTICLE.$article.$pager.'#comments">&lt; previous</a></li>';}
						while($pages<$num_pages){ 
						  $pages++;
						 echo '<li><a ';
							 if($pages==$page){echo 'class="currentpage"';}
							echo ' href="'._SITE._CATEGORY.$category._ARTICLE.$article._PAGE.$pages.'#comments">'.$pages.'</a></li>';
							  }
							 if($page<$num_pages){$prevpage = $page+1;$pager = _PAGE.$prevpage;
							 echo '<li><a class="prevnext" href="'._SITE._CATEGORY.$category._ARTICLE.$article.$pager.'#comments">next &gt;</a></li>';}
						echo '<ul>
						</div>';
					}
				}	
			}
$user = s('comment_permissions');
$article_id = r('id','articles','seftitle',$article);
$category_id = r('category','articles','seftitle',$article);
$category = r('seftitle','categories','id',$category_id);
	if(s('comments_freeze')=='YES'){
		sm('comments-freeze');
	}else{
		if($user=='YES' && $_SESSION['logged_in']!=TRUE){
			sm('mustLogin');
		}else{
			echo '<div id="new_comment" class="comment_new">';
			form('form','','new_comment','','','','post',_CATEGORY.$category._ARTICLE.$article.'#comments','');
			if(!$_SESSION['logged_in']){
				?>
				<input id="name" name="name" value="<?php echo l("new_comment_name.value"); ?>" onblur="if(document.forms['new_comment'].name.value == '') document.forms['new_comment'].name.value='<?php echo l("new_comment_name.value"); ?>';" onfocus="document.forms['new_comment'].name.value='';" style="border:1px solid #BDC7D8;color:#666;padding:2px;">
				<?php
			}
			?>
			<textarea id="new_comment" name="comment" rows="1" onblur="if(document.forms['new_comment'].new_comment.value == '') 
			document.forms['new_comment'].new_comment.value='<?php echo l("new_comment.value"); ?>';" onfocus="document.forms['new_comment'].new_comment.value='';" style="height:inherit;"><?php echo l("new_comment.value"); ?></textarea>
			<?php
			form('hidden','action','','user_comment_submit','','','','');
			form('submit','submit','commentSubmit','','','','','');
			echo '</div>';
			

		}
	echo '</div>';
	}
}

?>