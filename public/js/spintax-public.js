document.addEventListener("DOMContentLoaded", function () {
	if (typeof jQuery === "undefined") {
		return;
	}
	(function ($) {
		"use strict";

		var fadeSpeed = 350;
		$(".spintax").each(function () {
			var spintaxElement = $(this);
			var fullSpintax = spintaxElement.find("noscript").text();
			var spintaxArr = fullSpintax.split("|");
			if (spintaxArr.length <= 1) return;
			var i = 0;

			spintaxElement.html(spintaxArr[i]).fadeIn(fadeSpeed);

			setInterval(function () {
				i = (i + 1) % spintaxArr.length;
				spintaxElement.fadeOut(fadeSpeed, function () {
					spintaxElement.html(spintaxArr[i]).fadeIn(fadeSpeed);
				});
			}, 2500);
		});
	})(jQuery);
});
