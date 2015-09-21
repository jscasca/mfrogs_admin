<?php

require 'common.php';

$user = $_REQUEST['user'];
$pwd = $_REQUEST['pwd'];

session_start();

$queryUser =
	"SELECT
		*
	FROM
		users
	WHERE
		userName = '".$_POST['user']."' AND
		userPass = '".md5($_POST['pwd'])."'";
$userList = mysql_query($queryUser,$conexion);
$userCount = mysql_num_rows($userList);
if($userCount==0)
{
	header("Location:../login.html?e=401");
}else
{
	$userData = mysql_fetch_assoc($userList);
	$user = new stdClass;
	$user->id = $userData['userId'];
	$user->name = $userData['userName'];
	$user->Fname = $userData['userFirstName'];
	$user->Lname = $userData['userLastName'];
	$_SESSION['user'] = $user;
	header("Location:../index.php");
}

?>
