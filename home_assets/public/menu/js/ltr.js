(function ($) {

	"use strict";

	// Team 
	$('.team-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			460: {
				items: 2
			},
			576: {
				items: 2
			},
			768: {
				items: 3
			},
			991: {
				items: 3
			},
			1000: {
				items: 4
			}
		}
	});

	// Slider
	$('.slide-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 0,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		// dots: true,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1,
				// dots: false,
				// nav: true,
			},
			576: {
				items: 1
			},
			1000: {
				items: 1
			}
		}
	});

	// Testimonial
	$('.testimonial-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		dots: false,
		nav: true,
		navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"],
		responsive: {
			0: {
				items: 1,
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});

	// Blog
	$('.blog-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			}
		}
	});
	// product
	$('.product-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			},
			1200: {
				items: 4
			}
		}
	});
	
	// Brand
	$('.brand-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 30,
		nav: false,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 2
			},
			768: {
				items: 3
			},
			992: {
				items: 4
			},
			1200: {
				items: 5
			}
		}
	});

	// Event
	$('.event-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Single-Service
	$('.single-ser-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			576: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Portfolio
	$('.portfolio-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		animateIn: 'fadeIn',
		animateOut: 'fadeOut',
		margin: 0,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 1
			},
			992: {
				items: 1
			}
		}
	});

	// Project
	$('.project-carousel').owlCarousel({
		loop: true,
		autoplay: true,
		autoplayHoverPause: true,
		autoplaySpeed: 1500,
		smartSpeed: 1500,
		margin: 25,
		nav: true,
		navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
		responsive: {
			0: {
				items: 1
			},
			768: {
				items: 2
			},
			992: {
				items: 3
			},
			1200: {
				items: 3
			}
		}
	});

})(jQuery);

(function () {
	"use strict";

	// Vertical Slider object
	const vertical_slider = {

		// Slide class name
		slider_class: ".slider",

		// Show slide
		show_slide: function (slide_id, context_item) {
			const slide_container = context_item.closest(this.slider_class).querySelector(".slides");
			if (slide_container) {
				const slides = slide_container.querySelectorAll(".slide");
				if (slides && slides[slide_id]) {

					// Scroll to active slide
					slide_container.scrollTo({
						top: slides[slide_id].offsetTop,
						behavior: "smooth"
					});


					// Set active context item
					const active_context_item = context_item.closest(".slide_navigation").querySelector(".active");
					if (active_context_item) {
						active_context_item.classList.remove("active");
					}

					context_item.classList.add("active");
				}
			}
		},

		// Initialize slide
		init_slider: function (slider) {

			const navigation_items = slider.querySelectorAll(".slide_navigation a");

			if (navigation_items) {
				Object.keys(navigation_items).forEach(function (key) {
					navigation_items[key].onclick = function (e) {
						e.preventDefault();

						vertical_slider.show_slide(key, navigation_items[key]);
					};
				});
			}

		},

		// Initialize sliders
		init: function () {

			// Iterate over each slider
			document.querySelectorAll(this.slider_class).forEach((slider) => this.init_slider(slider));

		}
	};

	// Initialize sliders
	vertical_slider.init();
}());