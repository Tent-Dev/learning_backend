<?php
session_start();
if($_SESSION['getUsername'] == ""){
	header("Location:login.php");
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title></title>
	<!--include-->
		<?php include("../include/lib.php") ?>
	<!-- end of include -->
	<style type="text/css" media="screen">
		footer{
			background-color: #4E4D4D;
		    padding-top: 10px !important;
		    padding-bottom: 10px !important;
		    position: absolute;
		    width: 100%;
		    bottom: -1000;
		    color: white;
		    text-align: center;
		}
		.card-header {
		    background-color: #4E4D4D !important;
		    border-bottom: 1px solid rgba(0,0,0,.125);
		    color: white;
		}
		.card{
			border: 2px solid rgba(0,0,0,.125) !important;
		    border-style: dashed !important;
		}
		.card-footer {
		    background-color: rgba(0,0,0,.03) !important;
		    border-top: 0px solid rgba(0,0,0,.125) !important;
		}
		.blur{
			-webkit-filter: blur(2px); /* Chrome, Safari, Opera */
    		filter: blur(2px);
		}
		.card_space{
			margin-bottom: 10px;
		}
		.modal-header{
			background-color: #CACACA !important;
			/*color: white !important;*/
		}
		.form-group .form-control{
			margin-bottom: 10px;
		}
		.input-group-prepend{
			margin-bottom: 10px;
		}
		.margin-10{
			margin-bottom: 10px;
		}
		.fontWeight{
			font-weight: unset !important;
		}
	</style>
</head>
<body>
	<?php include('../include/nav.php')?>

	<br>
	<div class="container">
		<div>
			<form class="form-group" id="sendEditAccount">
				<div class="col-12  row">
					<div class="col-4 text-right">
						<label><b>Username:</b></label>
					</div>
					<div class="col-4">
						<input type="text" class="form-control" data-member_id="<?php echo $_SESSION['getId'] ?>" id="username" value="<?php echo $_SESSION['getUsername'] ?>" readonly>
					</div>
				</div>
				<br>
				<div class="col-12 row">
					<div class="col-4 text-right">
						<label><b>Old Password:</b></label>
					</div>
					<div class="col-4">
						<input type="password" class="form-control" id="old_password" required>
					</div>
				</div>
				<br>
				<div class="col-12 row">
					<div class="col-4 text-right">
						<label><b>New Password:</b></label>
					</div>
					<div class="col-4">
						<input type="password" class="form-control" id="new_password" required>
					</div>
				</div>
				<br>
				<div class="col-12 row">
					<div class="col-4 text-right">
						<label><b>Confirm New Password:</b></label>
					</div>
					<div class="col-4">
						<input type="password" class="form-control" id="confirm_new_password" required>
					</div>
				</div>
				<div class="col-12 row">
					<div class="col-12" align="center">
						<button type="submit" class="btn btn-success" id="save_edit">Save</button>
						<!-- <button type="button" class="btn btn-primary" id="">Create Account</button> -->
					</div>
					<div class="col-12" align="center"><span id="editSuccess"></span></div>
				</div>
			</form>
		</div>
	</div>


	<footer>
		<div class="col-12">
			© Copyright 2020 learning.local
		</div>
	</footer>
</body>
<!-- Add Script zone -->
	<script src="../js/auth_editAccount.js"></script>
	<script src="../js/query.js"></script>
<!-- end of Add Script zone -->
</html>
