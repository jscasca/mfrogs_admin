<?php
require 'common.php';
require 'password.php';

$uid = $_REQUEST['uid'];
$name = $_REQUEST['user'];
$pwd = isset($_REQUEST['pwd'])?$_REQUEST['pwd']:"";
$first = $_REQUEST['first'];
$last = $_REQUEST['last'];

if($uid == -1) {
	//Check that user does not exist
	$userQuery = "select * from users where userName = '".$name."'";
	$userExists = mysql_query($userQuery, $conexion);
	if(mysql_num_rows($userExists)>0) die("User already exists");
	//Create
	$query = "insert into users (userName, userPass, userFirstName, userLastName)
		values (
			'".mysql_real_escape_string($name)."',
			'".md5($pwd)."',
			'".mysql_real_escape_string($first)."',
			'".mysql_real_escape_string($last)."')";
	mysql_query($query, $conexion);
} else if($uid > 0) {
	//Check that user does not exist
	$userQuery = "select * from users where userName = '".$name."' and userId <> ".$uid;
	$userExists = mysql_query($userQuery, $conexion);
	if(mysql_num_rows($userExists)>0) die("User already exists");
	//update
	$query = "update users set 
		userName = '".mysql_real_escape_string($name)."',
		".($pwd != "" ? "userPass = '".md5($pwd)."'," : "")."
		userFirstName = '".mysql_real_escape_string($first)."',
		userLastName = '".mysql_real_escape_string($last)."'
	where userId = ".$uid;
	mysql_query($query, $conexion);
} else {
	//nothing throw error
}
mysql_close();
?>
