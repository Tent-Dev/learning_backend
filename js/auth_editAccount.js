$( document ).ready(function() {
	$("#sendEditAccount").submit(function(event){
		event.preventDefault();
		$('#save_edit').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;Saving');
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
				console.log("Status: "+data.status);
				if(data.status == 1){
					$('#sendEditAccount')[0].reset();
					$('#editSuccess').html('<span style="color:green;">บันทึกเรียบร้อย</span>');
				}
				else if(data.status == 2) {
					$('#editSuccess').html('<span style="color:red;">ยืนยันรหัสผ่านไม่ตรงกัน</span>');
				}
				else if(data.status == 3){
					$('#editSuccess').html('<span style="color:red;">รหัสผ่านเก่าไม่ถูกต้อง</span>');
				}
				
			})
			.fail(function() {
				console.log("error");
				$('#editSuccess').html('<span style="color:red;">Error</span>');
			})
			.always(function() {
				$('#save_edit').html('Save');
			});
		}	
	});
});