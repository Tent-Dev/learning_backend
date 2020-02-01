$( document ).ready(function() {
	query_lessonlist();

	$(document).on('click', 'button[id^="edit_id-"]',function(event){
		var id = $(this).attr('data-id');
		$('#update_btn').attr('data-id', id);
		show_edit_modal(id);
	});

	$(document).on('click', '#add_btn',function(event){
		show_add_modal();
	});

	$(document).on('click','#send_add_btn',function(event){
		$.ajax({
			url: '../system/cmd.php',
			type: 'POST',
			data: {
				command: 'add_lesson',
				lesson_name: $('#lesson_name_add_field').val(),
				lesson_desc: $('#lesson_desc_add_field').val(),
				lesson_videoIntro: $('#lesson_videoIntro_add_field').val(),
				lesson_videoContent: $('#lesson_videoContent_add_field').val(),
				lesson_urlname: $('#lesson_urlname_add_field').val()
			},
		})
		.done(function() {
			query_lessonlist()
			console.log("success");
			$('#modal_add').modal('hide');
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("------Insert lesson function end------");
		});	
	});

	$(document).on('click','button[id^="delete_id-"]',function(event){
		var id = $(this).attr('data-id');
		console.log(id);
		show_delete_modal(id);
	});

	$(document).on('click', '#send_delete_btn',function(event){
		event.preventDefault();
		var id = $(this).attr('data-id');
		delete_lesson(id);
	});

	$(document).on('click', '#update_btn',function(event){
		event.preventDefault();
		var id = $(this).attr('data-id');
		var edit_name = $('#lesson_name_edit_field').val();
		var edit_desc = $('#lesson_desc_edit_field').val();
		var edit_videoIntro = $('#lesson_videoIntro_edit_field').val();
		var edit_videoContent = $('#lesson_videoContent_edit_field').val();
		var edit_urlname = $('#lesson_urlname_edit_field').val();
		edit_lesson(id, edit_name, edit_desc, edit_videoIntro, edit_videoContent, edit_urlname);
	});

	$(document).on('click', '.create_choice',function(event){
		console.log($(this).val());
		if($(this).val() == 0){
			$('#lesson_urlname_edit_field, #lesson_urlname_add_field').prop('disabled',true);
		}
		else if($(this).val() == 1){
			$('#lesson_urlname_edit_field, #lesson_urlname_add_field').prop('disabled',false);
		}
	});

});

function query_lessonlist(){
	$('#query_lessonlist').html('');
	$.ajax({
		url: "../system/cmd.php",
		data:{
			command: "query_lessonlist"
		},
		type: "POST",
		success:function(data){
			data = JSON.parse(data);
			json_html = '<div class="col-4 card_space">'+
							'<div class="card shadow-sm">'+
								'<div class="card-header blur">'+
									'Lesson - 1 Introduction'+
								'</div>'+
								'<div class="card-body" align="center">'+
									'<button class="btn btn-lg btn-outline-success" type="button" id="add_btn" data-toggle="modal" data-target="#modal_add"><i class="fas fa-plus-circle"></i>&nbsp;Add</button>'+
								'</div>'+
								'<div class="card-footer blur">'+
									'<div class="col-12 row" align="center" style="margin: 0px;">'+
										'<div class="col-6" align="left">'+
											'<button class="btn btn-sm btn-outline-primary" type="button" disabled><i class="fas fa-edit"></i>&nbsp;Edit</button>'+
										'</div>'+
										'<div class="col-6" align="right">'+
											'<button class="btn btn-sm btn-outline-danger" type="button" disabled><i class="far fa-trash-alt"></i>&nbsp;Delete</button>'+
										'</div>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</div>';
			$(json_html).appendTo('#query_lessonlist');

			$.each(data,function(index, el) {
				let json_html = '<div class="col-4 card_space">'+
									'<div class="card shadow-sm">'+
										'<div class="card-header"><span class="badge badge-info">'+'ID#'+el.lesson_id+'</span> '+el.lesson_name+'</div>'+
										'<div class="card-body">'+el.lesson_desc+'</div>'+
										'<div class="card-footer">'+
											'<div class="col-12 row" align="center" style="margin: 0px;">'+
												'<div class="col-6" align="left">'+
													'<button class="btn btn-sm btn-outline-primary" type="button" data-id="'+el.lesson_id+'" id="edit_id-'+el.lesson_id+'" data-toggle="modal" data-target="#modal_edit"><i class="fas fa-edit"></i>&nbsp;Edit</button>'+
												'</div>'+
												'<div class="col-6" align="right">'+
													'<button class="btn btn-sm btn-outline-danger" type="button" data-id="'+el.lesson_id+'" id="delete_id-'+el.lesson_id+'" data-toggle="modal" data-target="#modal_delete"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>'+
												'</div>'+
											'</div>'+
										'</div>'+
									'</div>'+
								'</div>';
				$(json_html).appendTo('#query_lessonlist');
			});
		},
		error:function(){}
	})
}

function show_add_modal(){
	let json_html = '<div class="col-12" align="center">'+
						'<form class="form-group">'+
							'<div class="row">'+
								'<div class="col-4" align="right">'+
									'ชื่อบทเรียน :'+
								'</div>'+
								'<div class="col-6">'+
									'<input type="text" class="form-control" id="lesson_name_add_field">'+
								'</div>'+
								//---------------------------------
								'<div class="col-4" align="right">'+
									'รายละเอียด :'+
								'</div>'+
								'<div class="col-8">'+
									'<textarea class="form-control" id="lesson_desc_add_field" rows="3" ></textarea>'+
								'</div>'+
								//---------------------------------
								'<div class="col-4" align="right">'+
									'Video แนะนำ :'+
								'</div>'+
								'<div class="col-8">'+
									'<input type="text" class="form-control" id="lesson_videoIntro_add_field">'+
								'</div>'+
								//---------------------------------
								'<div class="col-4" align="right">'+
									'Video เนื้อหา :'+
								'</div>'+
								'<div class="col-8">'+
									'<input type="text" class="form-control" id="lesson_videoContent_add_field">'+
								'</div>'+
								//---------------------------------
								'<div class="col-4" align="right">'+
									'สร้างหน้าใหม่ :'+
								'</div>'+
								'<div class="col-8 row margin-10">'+
									'<div class="col-4">'+
										'<input class="form-check-input create_choice" type="radio" name="create_choice" id="add_create0" value="1">'+
									    '<label class="form-check-label" for="add_create0">'+
									    	'สร้าง'+
									    '</label>'+
									'</div>'+
									'<div class="col-4">'+
									    '<input class="form-check-input create_choice" type="radio" name="create_choice" id="add_create1" value="0" checked>'+
									    '<label class="form-check-label" for="add_create1">'+
									    	'ไม่สร้าง'+
									    '</label>'+
								    '</div>'+
								'</div>'+
								//---------------------------------
								'<div class="col-4" align="right">'+
									'ชื่อไฟล์บทเรียน :'+
								'</div>'+
								'<div class="col-8 input-group">'+
									'<input type="text" class="form-control"  id="lesson_urlname_add_field">'+
									'<div class="input-group-prepend">'+
							          '<span class="input-group-text">.html</span>'+
							        '</div>'+
								'</div>'+
							'</div>'+
						'</form>'+
					'</div>';
	$('#modal_add_content').html(json_html);
	if($('.create_choice:checked').val() == 0){
		$('#lesson_urlname_add_field').prop('disabled',true);
	}
	else if($('.create_choice:checked').val() == 1){
		$('#lesson_urlname_add_field').prop('disabled',false);
	}
}

function show_edit_modal(id){
	$('#update_btn').attr('data-id',id);
	$.ajax({
		url: '../system/cmd.php',
		type: 'POST',
		data: {
			command: 'select_lesson',
			lesson_id:id
		},
		success:function(data){
			data = JSON.parse(data);
			console.log(data);
			let json_html = '<div class="col-12" align="center">'+
								'<form class="form-group" action="/file-upload" method="post" enctype="multipart/form-data">'+
									'<div class="row">'+
										'<div class="col-4" align="right">'+
											'ชื่อบทเรียน :'+
										'</div>'+
										'<div class="col-6">'+
											'<input type="text" class="form-control" id="lesson_name_edit_field" value="'+data.lesson_name+'">'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'รายละเอียด :'+
										'</div>'+
										'<div class="col-8">'+
											'<textarea class="form-control" id="lesson_desc_edit_field" rows="3" >'+data.lesson_desc+'</textarea>'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'Video แนะนำ :'+
										'</div>'+
										'<div class="col-8">'+
											'<input type="file" name="file" class="margin-10"/>'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'Video เนื้อหา :'+
										'</div>'+
										'<div class="col-8">'+
											'<input type="text" class="form-control" id="lesson_videoContent_edit_field" value="'+data.lesson_intro_mp4+'">'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'สร้างหน้าใหม่ :'+
										'</div>'+
										'<div class="col-8 row margin-10">'+
											'<div class="col-4">'+
												'<input class="form-check-input create_choice" type="radio" name="create_choice" id="create0" value="1">'+
											    '<label class="form-check-label" for="create0">'+
											    	'สร้าง'+
											    '</label>'+
											'</div>'+
											'<div class="col-4">'+
											    '<input class="form-check-input create_choice" type="radio" name="create_choice" id="create1" value="0" checked>'+
											    '<label class="form-check-label" for="create1">'+
											    	'ไม่สร้าง'+
											    '</label>'+
										    '</div>'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'ชื่อไฟล์บทเรียน :'+
										'</div>'+
										'<div class="col-8 input-group">'+
											'<input type="text" class="form-control"  id="lesson_urlname_edit_field" value="'+data.lesson_urlname+'">'+
											'<div class="input-group-prepend">'+
									          '<span class="input-group-text">.html</span>'+
									        '</div>'+
										'</div>'+
									'</div>'+
								'</form>'+
							'</div>';
			$('#modal_edit_content').html(json_html);

			if($('.create_choice:checked').val() == 0){
				$('#lesson_urlname_edit_field').prop('disabled',true);
				$('#lesson_urlname_edit_field').val(data.lesson_urlname);
			}
			else if($('.create_choice:checked').val() == 1){
				$('#lesson_urlname_edit_field').prop('disabled',false);
			}
		},
		error:function(){

		}
	})
}

function show_delete_modal(id){
	let json_html = '<div class="col-12" align="center">'+
						'<form class="form-group">'+
							'<div class="row">'+
								'<div class="col-12 margin-10" align="center">'+
									'ต้องการลบบทเรียน <span class="badge badge-info">ID#'+id+'</span> ?'+
								'</div>'+
								'<div class="col-12 margin-10" align="center">'+
									'<input class="form-check-input" type="checkbox" id="deleteall_choice" value="1">'+
								    '<label class="form-check-label" for="deleteall_choice" style="font-size: 0.8em;">'+
								    	'ลบไฟล์ที่เกี่ยวข้องทั้งหมด เช่น Video, Html file'+
								    '</label>'+
								'</div>'+
								'<div class="col-12" align="center">'+
									'<button type="button" class="btn btn-danger" data-id="'+id+'" id="send_delete_btn">Delete</button>'+
								'</div>'+
							'</div>'+
						'</form>'+
					'</div>';
	$('#modal_delete_content').html(json_html);
}

function edit_lesson(id, edit_name, edit_desc, edit_videoIntro, edit_videoContent, edit_urlname){
	$('#update_btn').html('<i class="fas fa-spinner fa-spin"></i>&nbsp;Saving');
	$.ajax({
		url: '../system/cmd.php',
		type: 'POST',
		data: {
			command: 'update_lesson',
			lesson_id:id,
			lesson_name_edit_field: edit_name,
			lesson_desc_edit_field: edit_desc,
			lesson_videoIntro_edit_field: edit_videoIntro,
			lesson_videoContent_edit_field: edit_videoContent,
			lesson_urlname_edit_field: edit_urlname
		}
	})
	.done(function() {
		console.log("success");
		query_lessonlist();
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		$('#update_btn').html('Save changes');
		console.log("------Edit function end------");
	});
}

function delete_lesson(id){
	var deleteall = 0
	if($('#deleteall_choice').is(':checked')){
		deleteall = 1
		console.log('deleteall Open');
	}
	$.ajax({
		url: '../system/cmd.php',
		type: 'POST',
		data: {
			command: 'delete_lesson',
			lesson_id:id,
			deleteall: deleteall
		},
		success:function(data){
			console.log("success");
			console.log(deleteall);
			$('#modal_delete').modal('hide');
			query_lessonlist();

		},
		error:function(){

		}
	})
}