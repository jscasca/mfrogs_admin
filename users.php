<?php
session_start();

if(!isset($_SESSION["user"])){
	header("Location: /admin/login.html");
} else {
	$name = $_SESSION['user']->Fname." ".$_SESSION['user']->Lname;
}
?>
<!doctype HTML>
<html>
<head>
	<title>Admin Portal</title>
	
	<meta charset="UTF-8" />
	<meta description="Description" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	
	<link rel="shortcut icon" href="img/favicon.png"> 
	
	<!-- bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" >
	<link href="css/mfi.css" rel="stylesheet" >
	
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!--<script src="https://code.jquery.com/jquery.js"></script>-->
	<script type="text/javascript" src="js/jquery.js"></script>
	<!-- Include all compiled plugins -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- Backbone js for mvc -->
	<script type="text/javascript" src="js/underscore.1.8.3.js"></script>
	<script type="text/javascript" src="js/backbone.min.1.2.1.js"></script>
</head>
<body>
<script type="text/javascript" >
$(document).ready(function()
{
	
});

//Get users
function getUsers() {
	$.ajax({
		type: "GET",
		url: "php/getUsers.php",
		success:function(data){
			displayUsers(data);
			/*var obj=jQuery.parseJSON(data);
			var material=$('#driverId');
			material.children().remove();
			material.append("<option value='0' >--Select Driver--</option>");
			jQuery.each(obj, function(i,val){
				material.append("<option value='"+i+"' >"+val+"</option>");
			});*/
		},
		async: false
	});
}

//
function displayUsers() {
	
}
</script>
	<div class="container">
		<?php include '_navbar.php'; ?>
		<div class="mainpage">
			<div class='userList'>
			
			</div>
			<div class='userEdit'>
			
			</div>
			<div class='newUser'>
				
			</div>
		</div>
	</div>
</body>
</html>
