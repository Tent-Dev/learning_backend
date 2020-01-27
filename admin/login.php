<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin System</title>
	<!--include-->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous" />
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
						<button type="submit" class="btn btn-primary">Login</button>
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