$( document ).ready(function() {
	query_lessonlist();

	$(document).on('click', 'button[id^="edit_id-"]',function(event){
		var id = $(this).attr('data-id');
		$('#update_btn').attr('data-id', id);
		show_modal(id);
	});

	// $(document).on('click', '#update_btn',function(event){
	// 	var id = $(this).attr('data-id');
	// 	console.log('save--> ID: '+id);
	// 	edit_lesson(id);
	// });

	// $(".modal").on("hidden.bs.modal", function(){
	//     $("#update_btn").remove();
	// });
});

function query_lessonlist(){
	$.ajax({
		url: "../system/cmd.php",
		data:{
			command: "query_lessonlist"
		},
		type: "POST",
		success:function(data){
			data = JSON.parse(data);
			$.each(data,function(index, el) {
				let json_html = '<div class="col-4">'+
									'<div class="card shadow-sm">'+
										'<div class="card-header">'+el.lesson_name+'</div>'+
										'<div class="card-body">'+el.lesson_desc+'</div>'+
										'<div class="card-footer">'+
											'<div class="col-12 row" align="center" style="margin: 0px;">'+
												'<div class="col-6" align="left">'+
													'<button class="btn btn-sm btn-outline-primary" type="button" data-id="'+el.lesson_id+'" id="edit_id-'+el.lesson_id+'" data-toggle="modal" data-target="#modal_edit"><i class="fas fa-edit"></i>&nbsp;Edit</button>'+
												'</div>'+
												'<div class="col-6" align="right">'+
													'<button class="btn btn-sm btn-outline-danger" type="button" data-id="'+el.lesson_id+'" id="delete_id-'+el.lesson_id+'" data-toggle="modal" data-target="#modal_delet"><i class="far fa-trash-alt"></i>&nbsp;Delete</button>'+
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

function show_modal(id){
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
								'<form class="form-group">'+
									'<div class="row">'+
										'<div class="col-4" align="right">'+
											'ชื่อบทเรียน'+
										'</div>'+
										'<div class="col-6">'+
											'<input type="text" class="form-control" id="lesson_name_edit_field" value="'+data.lesson_name+'">'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'รายละเอียด'+
										'</div>'+
										'<div class="col-8">'+
											'<textarea class="form-control" id="lesson_desc_edit_field" rows="3" >'+data.lesson_desc+'</textarea>'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'Video แนะนำ'+
										'</div>'+
										'<div class="col-8">'+
											'<input type="text" class="form-control" id="lesson_videoIntro_edit_field" value="'+data.lesson_intro_mp4+'">'+
										'</div>'+
										//---------------------------------
										'<div class="col-4" align="right">'+
											'Video เนื้อหา'+
										'</div>'+
										'<div class="col-8">'+
											'<input type="text" class="form-control" id="lesson_videoContent_edit_field" value="'+data.lesson_intro_mp4+'">'+
										'</div>'+
									'</div>'+
								'</form>'+
							'</div>';
			$('#modal_edit_content').html(json_html);
			$(document).on('click', '#update_btn[data-id="'+id+'"]',function(event){
				event.preventDefault();
				var edit_name = $('#lesson_name_edit_field').val();
				var edit_desc = $('#lesson_desc_edit_field').val();
				var edit_videoIntro = $('#lesson_videoIntro_edit_field').val();
				var edit_videoContent = $('#lesson_videoContent_edit_field').val();
				edit_lesson(id, edit_name, edit_desc, edit_videoIntro, edit_videoContent);
			});
		},
		error:function(){

		}
	})
	// .done(function(data) {
	// 	data = JSON.parse(data);
	// 	console.log(data);
	// 	let json_html = '<div class="col-12" align="center">'+
	// 						'<form class="form-group">'+
	// 							'<div class="row">'+
	// 								'<div class="col-4" align="right">'+
	// 									'ชื่อบทเรียน'+
	// 								'</div>'+
	// 								'<div class="col-6">'+
	// 									'<input type="text" class="form-control" id="lesson_name_edit_field" value="'+data.lesson_name+'">'+
	// 								'</div>'+
	// 								//---------------------------------
	// 								'<div class="col-4" align="right">'+
	// 									'รายละเอียด'+
	// 								'</div>'+
	// 								'<div class="col-8">'+
	// 									'<textarea class="form-control" id="lesson_desc_edit_field" rows="3" >'+data.lesson_desc+'</textarea>'+
	// 								'</div>'+
	// 								//---------------------------------
	// 								'<div class="col-4" align="right">'+
	// 									'Video แนะนำ'+
	// 								'</div>'+
	// 								'<div class="col-8">'+
	// 									'<input type="text" class="form-control" id="lesson_videoIntro_edit_field" value="'+data.lesson_intro_mp4+'">'+
	// 								'</div>'+
	// 								//---------------------------------
	// 								'<div class="col-4" align="right">'+
	// 									'Video เนื้อหา'+
	// 								'</div>'+
	// 								'<div class="col-8">'+
	// 									'<input type="text" class="form-control" id="lesson_videoContent_edit_field" value="'+data.lesson_intro_mp4+'">'+
	// 								'</div>'+
	// 							'</div>'+
	// 						'</form>'+
	// 					'</div>';
	// 	$('#modal_edit_content').html(json_html);

	// 	$(document).on('click', '#update_btn[data-id="'+id+'"]',function(event){
	// 		var edit_name = $('#lesson_name_edit_field').val();
	// 		var edit_desc = $('#lesson_desc_edit_field').val();
	// 		var edit_videoIntro = $('#lesson_videoIntro_edit_field').val();
	// 		var edit_videoContent = $('#lesson_videoContent_edit_field').val();
	// 		edit_lesson(id, edit_name, edit_desc, edit_videoIntro, edit_videoContent);
	// 	});
	// })
	// .fail(function() {
	// 	console.log("error");
	// })
	// .always(function() {
	// 	console.log("------Show modal function end------");
	// });
}

function edit_lesson(id, edit_name, edit_desc, edit_videoIntro, edit_videoContent){
	$.ajax({
		url: '../system/cmd.php',
		type: 'POST',
		data: {
			command: 'update_lesson',
			lesson_id:id,
			lesson_name_edit_field: edit_name,
			lesson_desc_edit_field: edit_desc,
			lesson_videoIntro_edit_field: edit_videoIntro,
			lesson_videoContent_edit_field: edit_videoContent
		}
	})
	.done(function() {
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("------Edit function end------");
	});
	
}