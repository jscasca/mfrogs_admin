<?php
require 'common.php';
require 'password.php';

$queryUsers = "Select userId, userName, userFirstName, userLastName from users";
$results = mysql_query($queryUsers, $conexion);

$jsondata = array();
while($row = mysql_fetch_assoc($results)){
	$jsondata[] = $row;
}
	
echo json_encode($jsondata); 
mysql_close();
?>
