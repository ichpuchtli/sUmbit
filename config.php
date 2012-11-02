<?php
function db($variable) {
	$db = array();
	$db['host'] = 'localhost'; //MySQL Host
	$db['database'] = 'sumbit'; //Database Name
	$db['username'] = 'root'; //Database Username
	$db['password'] = ''; //Database password
	$db['error'] = 'Cound not connect to database: '.$db['database']; //Connection Error message
	return $db[$variable];
}
?>