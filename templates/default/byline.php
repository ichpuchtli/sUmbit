<div class="info_line">
	<ul>
		<li><?php echo l('posted_by'); ?><em> <?php echo $name; ?></em></li>
		<li><?php echo date(s('date_format'),$article['date']); ?></li>
		<?php if(strpos($text,l('breakchar'))> 0): ?>
		<li><a href="<?php echo $link; ?>"><?php echo l('read_more'); ?></a></li>
		<?php endif; ?>
		<li><a href="<?php echo $link; ?>#comments"><?php echo $num_comments.' '.l('comments'); ?></a></li>
		<?php if($_SESSION['user_p']=='administrator'): ?>
		<li><a href="<?php echo _ADMIN.'edit_article&id='.$article['id']; ?>"><?php echo l('edit'); ?></a></li>
		<?php endif; ?>
	</ul>
	<div class="clearer"></div>
</div>