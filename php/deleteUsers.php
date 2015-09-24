<?php
require 'common.php';
require 'password.php';

$uid = $_REQUEST['uid'];

$query = "delete from users where userId = ". $uid;
mysql_query($query, $conexion);

mysql_close();
?>
