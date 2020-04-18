function show(){
	$('#loading').fadeIn()
	$("#main").addClass("blur")
	$("iframe").addClass("blur")
	$("header").addClass("blur")
	$("#main").removeClass("noblur")
	$("iframe").removeClass("noblur")
	$("header").removeClass("noblur")
	
	$('html,body').animate({ scrollTop: 0 }, 500)
}
function hide(){
	$('#loading').fadeOut()
	$("#main").addClass("noblur")
	$("iframe").addClass("noblur")
	$("header").addClass("noblur")
	$("#main").removeClass("blur")
	$("iframe").removeClass("blur")
	$("header").removeClass("blur")
}

