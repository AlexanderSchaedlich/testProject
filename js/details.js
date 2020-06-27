$(document).ready(function() {
	function calculateHeight() {
		let height = (1.2 * $(".detailsImage").width()).toString() + "px";
		$(".detailsImage").css("height", height);
	}
	calculateHeight();
	$(window).on("resize", function() {
		calculateHeight();
	});
});