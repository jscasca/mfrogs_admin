<nav role="navigation" class="navbar navbar-inverse">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
		<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a href="#" class="navbar-brand-image"><img src="img/mfi_alpha_nav.png" class="navlogo"/></a>
	</div>
	<!-- Collection of nav links, forms, and other content for toggling -->
	<div id="navbarCollapse" class="collapse navbar-collapse">
		<!--<form role="search" class="navbar-form navbar-left">
		<div class="form-group">
		<input type="text" placeholder="Search" class="form-control">
		</div>
		</form>-->
		<ul class="nav navbar-nav navbar-right">
			<!--<li><a href="#">Reports</a></li>-->	
			<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="#">Admin <b class="caret"></b></a>
			<ul role="menu" class="dropdown-menu">
			<li><a href="users.php">Users</a></li>
			<!--<li><a href="login.html"></a></li>-->
			</ul>
			</li>
			<li class="dropdown">
			<a data-toggle="dropdown" class="dropdown-toggle" href="#"><?php echo $name;  ?></a>
			<ul role="menu" class="dropdown-menu">
			<li><a href="php/logout.php">Log out</a></li>
			</ul>
			</li>
		</ul>
	</div>
</nav>
