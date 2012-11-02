<div class="post">
<?php if($title): ?>
	<h2><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h2>
	<p class="date"><?php echo date('F d, Y',$date); ?></p>
<?php endif; ?>
	<div class="entry">
	<?php echo $text; ?>
	</div>
</div>