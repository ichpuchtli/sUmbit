<div class="article">
<?php
if($title):
	if($link):
?>
<h1><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h1>
<?php else: ?>
		<h1><?php echo $title; ?><h1>
		<?php
	endif;
endif;
?>  <div class="text">
	<?php
	echo $text;
	?>
	</div>
</div>