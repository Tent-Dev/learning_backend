<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<!--include-->
		<?php include("../include/lib.php") ?>
	<!-- end of include -->
	<style type="text/css" media="screen">
		footer{
			background-color: #6c757d;
		    padding-top: 10px !important;
		    padding-bottom: 10px !important;
		    position: absolute;
		    width: 100%;
		    bottom: 0;
		    color: white;
		    text-align: center;
		}
		.card-header {
		    background-color: grey !important;
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
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="#">Admin System</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
	    <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Features</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Pricing</a>
	      </li>
	    </ul>
	    <span class="navbar-text">
			<i class="fas fa-user"></i><?php echo(" ".$_SESSION['getUsername']); ?>
			<button class="btn btn-sm btn-outline-secondary" type="button"><i class="fas fa-cog"></i>&nbsp;setting</button>
			<button class="btn btn-sm btn-outline-danger" type="button" id="logout"><i class="fas fa-sign-out-alt"></i>&nbsp;logout</button>
	    </span>
	  </div>
	</nav>

	<br>
	<div class="container">
		<div>
			<div class="col-12 row" id="query_lessonlist">
				<div class="col-4">
					<div class="card shadow-sm">
						<div class="card-header blur">
							Lesson - 1 Introduction
						</div>
						<div class="card-body" align="center">
							<button class="btn btn-lg btn-outline-success" type="button"><i class="fas fa-plus-circle"></i>&nbsp;Add</button>
						</div>
						<div class="card-footer blur">
							<div class="col-12 row" align="center" style="margin: 0px;">
								<div class="col-6" align="left">
									<button class="btn btn-sm btn-outline-primary" type="button" disabled><i class="fas fa-edit"></i>&nbsp;Edit</button>
								</div>
								<div class="col-6" align="right">
									<button class="btn btn-sm btn-outline-danger" type="button" disabled><i class="far fa-trash-alt"></i>&nbsp;Delete</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<footer>
		<div class="col-12">
			© Copyright 2020 learning.local
		</div>
	</footer>

	<!-- Modal -->
	<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="modal_edit_content">
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" id="update_btn">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>
</body>
<!-- Add Script zone -->
	<script src="../js/auth_login.js"></script>
	<script src="../js/query.js"></script>
<!-- end of Add Script zone -->
</html>
