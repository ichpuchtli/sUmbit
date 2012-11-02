<?php 
switch(TRUE){
	case $membersOnline>0:
		if($usersOnline<1){
			echo $membersOnline.' member(s) online';
		}else{
			echo $membersOnline.' member(s) online and '.$usersOnline.' guest(s) online';
		}
	break;
	default:
		echo $usersOnline.' guest(s) online';
break;
}
?>