$( document ).ready(function() {
	$("#sendEditAccount").submit(function(event){
		event.preventDefault();
		if($('#new_password').val() == $('#confirm_new_password').val()){
			$.ajax({
				url: '../system/cmd.php',
				type: 'POST',
				data: {
					command: 'EditAccount',
					member_id: $('#username').attr('data-member_id'),
					old_password: $('#old_password').val(),
					new_password: $('#new_password').val(),
					confirm_new_password: $('#confirm_new_password').val()
				},
			})
			.done(function(data) {
				data = JSON.parse(data);
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}	
	});
});