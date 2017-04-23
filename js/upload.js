$(document).ready(function(){
	$('#images').click(function(){
		window.open('../templates/uploadfile.html','upload','width=400,height=400,top='+$(window).height() / 2+',left='+$(window).width() / 2 - 50+'');
	});
});