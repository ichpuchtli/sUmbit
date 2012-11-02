<?php
moo(l('search'));
$keywords = $_GET['keywords'] ? $_GET['keywords'] : $_POST['keywords'];
// filter keywords
$find = strtoupper($keywords);
$find = cleanx($find,'search');
$find = explode(' ', $find);
$findCount = count($find);
$public = $_SESSION['logged_in'] ? 'SPC' : 'NO';
$sql = 'SELECT category,seftitle,text,title FROM `articles` WHERE visible = "YES" AND public != "'.$public.'" AND ';
for ($i=0; $i!=$findCount; $i++){
$or = $i<($findCount-1) ? 'OR' : '';
$sql = $sql.$sqlSearch[$i] = 'upper(title) LIKE "%'.$find[$i].'%" OR upper(seftitle) LIKE "%'.$find[$i].'%" '.$or.' ';
}
$sql = $sql.' ORDER BY id';
$query = mysql_query($sql);
$numRows = mysql_num_rows($query);
file_exists(_TEMPLATE.'searchresults.php') ? include(_TEMPLATE.'searchresults.php') : include(_DEFAULT.'searchresults.php');
?>