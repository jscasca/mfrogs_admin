<?php
function check_loged(){
	global $_SESSION;
	if(!isset($_SESSION["user"])){
		header("Location: /admin/index.php");
	}
}

//DATABASE CONNECT
$conexion=mysql_connect("localhost","root","root");
mysql_select_db("trucking",$conexion);
?>
