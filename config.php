<?php

$db = mysqli_connect('localhost', 'root', '', 'vinly3_8');

if($db->connect_errno > 0) {
	die('Unable to connect to database [' . $db->connect_errno . ']');
}
$db->set_charset("utf8");
?>
