<?php
session_start();
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
		    bottom: 0;
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

			</div>
		</div>
	</div>


	<footer>
		<div class="col-12">
			© Copyright 2020 learning.local
		</div>
	</footer>

	<!-- Modal edit -->
	<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขเนื้อหาบทเรียน</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="modal_edit_content">
	        
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary" id="update_btn">Save changes</button>
	        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal add -->
	<div class="modal fade" id="modal_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">เพิ่มบทเรียนใหม่</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="modal_add_content">
	        
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary" id="send_add_btn">Add</button>
	        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button> 
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Modal delete -->
	<div class="modal fade" id="modal_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">ลบบทเรียน</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body" id="modal_delete_content">
	        
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
