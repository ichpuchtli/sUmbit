<form name="search" method="get" action="<?php echo _SITE; ?>">
<input type="text"  value="<?php echo l('searchkeywords'); ?>" class="search" maxlength="32" name="keywords" id="search" onblur="if(document.forms['search'].search.value == '') document.forms['search'].search.value='<?php echo l('searchkeywords'); ?>';" onfocus="document.forms['search'].search.value='';" />
<input type="hidden" name="<?php echo l('place'); ?>" value="search" />
</form>