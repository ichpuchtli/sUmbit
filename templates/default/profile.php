<div id="User_Profile">
<table border="0" cellpadding="0" cellspacing="0" style="float:left;">
  <tr>
    <td><img src="images/personal.png" width="128" height="128" style="float:left;" /></td>
  </tr>
  <tr>
    <td style="text-align:center;">
		<?php echo $username; ?>
	</td>
  </tr>
</table>
<div class="name"><strong><?php echo $fullname; ?></strong><?php echo ' '.$wall;?></div>
<?php
if($you == $username){ ?>

<form action="?p=users&user=ichpuchtli" method="post" class="update_feeling" id="update_feeling" style="padding:5px;">	
			<input id="name" name="name" style="width:70%;" value="<?php echo l("howyoufeeling"); ?>" onblur="if(document.forms['update_feeling'].name.value == '') document.forms['update_feeling'].name.value='<?php echo l("howyoufeeling"); ?>';" onfocus="document.forms['update_feeling'].name.value='';" style="border:1px solid #BDC7D8;color:#666;padding:2px;">
			<input type="submit" style="float: right; cursor: pointer;" class="form_submit" name="submit" value="share"/>
			</form>
<?php } ?>
	<div class="about_me">
		<h2>About me</h2>
		<?php echo $about_me; ?>
	</div>
</div>