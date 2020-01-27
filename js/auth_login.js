$( document ).ready(function() {

//ส่งข้อมูลสมัครUserไปให้ insert
	$("#createAccount").click(function(event){
	    event.preventDefault();
		    $.ajax({
		     	url: "../system/cmd.php",
		      	data:{
		        command: "signup",
			        user: "admin",
			        pass: "1234",
			        Fname: "ABC",
			        Lname: "DEF",
			    },
			    type: "POST",
			    success:function(data){
			    	data = JSON.parse(data);
	      			console.log(data.check);
	      			if(data.check == 1){
			    		$("#createAccount").prop('disabled',true);
			    	}else if(data.check == 0){
			    		alert("คุณสร้าง Account ไปแล้ว");
			    		$("#createAccount").prop('disabled',true);
			    	}
			    },
			    error:function(){}
			})
	});

//ส่งข้อมูล login
	$("#sendLoginForm").submit(function(event){
  		$('#loginSuccess').html('<div class="col-12" style="text-align: center; padding: 20px;"><h5>logging in</h5><h5><i class="fas fa-spinner fa-spin"></i></h5></div>');
    	event.preventDefault();
    	jQuery.ajax({
	    	url: "../system/cmd.php",
	    	data:{
	    		command: "login",
	        	user: $("#userlogin").val(),
	        	pass: $("#passlogin").val(),
	      	},
	      	type: "POST",
	      	success:function(data){
	      		$('#loginSuccess').html('');
	      		data = JSON.parse(data);
	      		console.log(data.check);
	      		if(data.check == 1){
	        		document.location.href = 'dashboard.php';
	      		}else{
	        		$('#sendLoginForm').trigger("reset");
	        		$('#loginSuccess').html('<span style="color:red;">บัญชีผู้ใช้หรือรหัสผ่านไม่ถูกต้อง</span>');
	      		}
	      	},
	      	error:function (){
	      		$('#loginSuccess').html('<span style="text-align: center; color:red;"><i class="fas fa-times"></i>&nbsp;Cannot connect Database</span>');
	      	}
      	});
    });

//end of ready    
});
