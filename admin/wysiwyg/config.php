<?php
function db($variable) {
	$db = array();
	$db['dbhost'] = 'localhost'; //MySQL Host
	$db['dbname'] = 'ichpucht_sUmbit'; //Database Name
	$db['username'] = 'ichpucht_sUmbit'; //Database Username
	$db['password'] = 'test'; //Database password
	return $db[$variable];
}
?>