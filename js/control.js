$(document).ready(function() {
  var pageName = document.location.pathname.match(/[^\/]+$/)[0]
  pageName = pageName.replace('.html','');
  console.log(pageName);
  connectVideo(pageName);

});

function connectVideo(pageName){
	$.ajax({
		url: '../system/cmd.php',
		type: 'POST',
		data: {
			command: 'connectVideo',
			urlname: pageName
		},
	})
	.done(function(data) {
		data = JSON.parse(data);
		console.log(data.intro_mp4_url);
		$('#intro').attr('src', data.intro_mp4_url);
		$("#videoBox")[0].load();
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
	
}
function openSlideMenu(){
  document.getElementById('side-menu').style.width = '250px';
  document.getElementById('main').style.marginLeft = '250px';
}

function closeSlideMenu(){
  document.getElementById('side-menu').style.width = '0';
  document.getElementById('main').style.marginLeft = '0';
}