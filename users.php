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
	
	<link rel="shortcut icon" href="img/favicon.ico"> 
	
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
	getUsers();
	
	$('body').on('click', 'img.editable', function() {
		var id = $(this).attr('target');
		displayForm(id);
	});
	
	$('body').on('click', '#newUser', function() {
		displayForm(-1);
	});
	
	$('body').on('click', 'img.deletable', function() {
		var id = $(this).attr('target');
		var name = $('#user_'+id).val();
		if(confirm("Are you sure you want to delete the user ["+name+"]?")) {
			deleteUser(id);
		}
	});
	
	$('body').on('click', '#cancelButton', function() {
		$('#userForm')[0].reset();
		getUsers();
	});
	
	$('body').on('click', '#saveButton', function() {
		saveForm();
	});
});

function saveForm() {
	//uid, user, pwd, first, last
	var uid = $('#uid').val();
	var user = $('#user').val();
	var first = $('#first').val();
	var last = $('#last').val();
	var pwd = $('#pwd').val();
	var pass = "";
	if(pwd != "") pass = "&pwd=" + pwd;
	$.ajax({
		type: "POST",
		url: "php/submitUser.php",
		data: "uid="+uid+"&user="+user+"&first="+first+"&last="+last+pass,
		success: function() {
			getUsers();
		},
		async: false
	});
}

function deleteUser(targetId) {
	$.ajax({
		type: "GET",
		url: "php/deleteUsers.php",
		data: "uid="+targetId,
		success: function(data) {
			getUsers();
		},
		async: false
	});
}

function displayForm(targetId) {
	console.log("displaying");
	jQuery('#userListDiv').hide();
	$('#uid').val(targetId);
	if(targetId != -1) {
		console.log($("#user_" + targetId).val());
		$('#user').val($("#user_" + targetId).val());
		console.log($('#user'));
		$('#first').val($("#first_" + targetId).val());
		$('#last').val($("#last_" + targetId).val());
	}
	jQuery('#userFormDiv').show();
	console.log("showing");
}

//Get users
function getUsers() {
	$.ajax({
		type: "GET",
		url: "php/getUsers.php",
		success:function(data){
			var users = jQuery.parseJSON(data);
			displayUsers(users);
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
function displayUsers(users) {
	jQuery('#userFormDiv').hide();
	var table = $('#userTable');
	table.find('tr:gt(0)').remove();
	jQuery.each(users, function(i, val) {
		var row = $('<tr>');
		row.append('<td>' + val.userFirstName + ' ' + val.userLastName +'</td>');
		row.append('<td>' + val.userName +'</td>');
		row.append('<td><img src="img/13.png" class="editable" target="'+val.userId+'"/></td>');
		row.append('<td><img src="img/118.png" class="deletable" target="'+val.userId+'"/></td>');
		row.append('<input type="hidden" value="'+val.userFirstName+'" id="first_'+val.userId+'" "/>');
		row.append('<input type="hidden" value="'+val.userLastName+'" id="last_'+val.userId+'" "/>');
		row.append('<input type="hidden" value="'+val.userName+'" id="user_'+val.userId+'" "/>');
		table.append(row);
	});
	jQuery('#userListDiv').show();
}

//function updateUser
</script>
	<div class="container">
		<?php include '_navbar.php'; ?>
		<div class="mainpage">
			<div class='userList' id='userListDiv'>
				<div class="addUser">
					<img src="img/95.png" class="actionButton" id="newUser"/>
				</div>
				<div class="table">
					<table class="table table-hover" id="userTable" data-row-style="rowStyle">
						<thead>
							<tr>
								<th>Name</th>
								<th>User</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Sample sample</td>
								<td>sample</td>
								<td><img src="img/13.png"/></td>
								<td><img src="img/118.png"/></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class='userForm' id='userFormDiv'>
				<form class="userForm" id="userForm">
					<input type="hidden" id="uid" value="0"/>
					<div class="form-group">
						<label for="user">Username:</label>
						<input type="text" class="form-control" id="user" placeholder="Username" />
					</div>
					<div class="form-group">
						<label for="first">First name:</label>
						<input type="text" class="form-control" id="first" placeholder="First name" />
					</div>
					<div class="form-group">
						<label for="user">Last name:</label>
						<input type="text" class="form-control" id="last" placeholder="Last name" />
					</div>
					<div class="form-group">
						<label for="user">Password:</label>
						<input type="text" class="form-control" id="pwd" placeholder="Password" />
					</div>
					<div class="text-center">
						<button type="button" class="btn btn-lg btn-primary" id="saveButton">Save</button>
						<button type="button" class="btn btn-lg btn-primary" id="cancelButton">Cancel</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
