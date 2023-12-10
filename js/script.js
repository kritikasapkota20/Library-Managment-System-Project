$(document).ready(function() {
	// Set the first slide as active
	$(".slide:first-child").addClass("active");

	// Auto slide every 5 seconds
	setInterval(function() {
		var currentSlide = $(".active");
		var nextSlide = currentSlide.next();

		if (nextSlide.length === 0) {
			nextSlide = $(".slide:first-child");
		}

		currentSlide.removeClass("active");
		nextSlide.addClass("active");
	}, 5000);
});
