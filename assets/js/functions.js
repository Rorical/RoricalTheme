function show(){
	$('#loading').show()
	$("#main").addClass("blur")
	$("iframe").addClass("blur")
	$("header").addClass("blur")
	$('html,body').animate({ scrollTop: 0 }, 500)
}
function hide(){
	$('#loading').hide()
	$("#main").removeClass("blur")
	$("iframe").removeClass("blur")
	$("header").removeClass("blur")
}