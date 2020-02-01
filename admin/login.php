<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Admin System</title>
	<!--include-->
		<?php include("../include/lib.php") ?>
	<!-- end of include -->

	<style type="text/css" media="screen">
		.vertical-center {
		  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */
		  min-height: 100vh; /* These two lines are counted as one :-)       */

		  display: flex;
		  align-items: center;
		}
		hr{
			margin-top: 5%;
		}
	</style>
</head>
<body>
	<div class="container vertical-center">
		<div class="col-12">
			<div class="col-12 text-center row">
				<div class="col-12" align="center">
					<h1>Admin System</h1>
				</div>
			</div>
			<form class="form-group" id="sendLoginForm">
				<div class="col-12  row">
					<div class="col-4 text-right">
						<label><b>Username:</b></label>
					</div>
					<div class="col-4">
						<input type="text" class="form-control" id="userlogin" required>
					</div>
				</div>
				<br>
				<div class="col-12 row">
					<div class="col-4 text-right">
						<label><b>Password:</b></label>
					</div>
					<div class="col-4">
						<input type="password" class="form-control" id="passlogin" required>
					</div>
				</div>
				<br>
				<div class="col-12 row">
					<div class="col-12" align="center">
						<button type="submit" class="btn btn-primary" id="login">Login</button>
						<button type="button" class="btn btn-primary" id="createAccount">Create Account</button>
					</div>
					<div class="col-12" align="center"><span id="loginSuccess"></span></div>
				</div>
			</form>
			<hr>
			<footer>&copy; Copyright 2020 learning.local</footer>
		</div>
	</div>
</body>
<!-- Add Script zone -->
	<script src="../js/auth_login.js"></script>
<!-- end of Add Script zone -->
</html>