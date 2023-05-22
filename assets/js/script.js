(function () {
	$(document).ready(function () {
		$(".loader-frame").fadeOut(2500);
		$(".loader").fadeOut(2500);
	});

	var myAudio = document.getElementById("myAudio");

	function newsArchive() {
		if ($("#newsArchiveWidget").length !== 0) {
			$(document).on("click", ".btn-archive-collapse", function () {
				console.log("ok");
				$(".caret-icon", this).toggleClass("fa-caret-down fa-caret-right");
			});
		}
	}
	newsArchive();

	$("#songIcon").on("click", function () {
		if (myAudio.paused) {
			$("#songIcon i").removeClass("fas fa-play");
			$("#songIcon i").addClass("fas fa-pause");
			myAudio.play();
		} else {
			$("#songIcon i").removeClass("fas fa-pause");
			$("#songIcon i").addClass("fas fa-play");
			myAudio.pause();
		}
	});

	$("#btnSong").on("click", function () {
		$([document.documentElement, document.body]).animate(
			{
				scrollTop: $("#myAudio").offset().top - 100,
			},
			2000
		);
		if (myAudio.paused) {
			$("#songIcon i").removeClass("fas fa-play");
			$("#songIcon i").addClass("fas fa-pause");
			myAudio.play();
		} else {
			$("#songIcon i").removeClass("fas fa-pause");
			$("#songIcon i").addClass("fas fa-play");
			myAudio.pause();
		}
	});

	$(document).ready(function ($) {
		$("#lyricsBtn").popover({
			trigger: "focus",
		});
	});
})();

jQuery(function ($) {
	"use strict";

	/* ----------------------------------------------------------- */
	/*  Fixed header
	/* ----------------------------------------------------------- */
	$(window).on("scroll", function () {
		var scrollTop = $(this).scrollTop();

		if (
			scrollTop >= $("#header").offset().top + 750 &&
			scrollTop <= $("#footer").offset().top - 200 &&
			$(window).width() >= 992
		) {
			$(".icon-bar").fadeIn();
		} else {
			$(".icon-bar").fadeOut();
		}

		function productLogo() {
			let productLogoTop;
			if ($("#product-logo-section").length !== 0) {
				productLogoTop = $("#product-logo-section").offset().top - 500;
			}
			if (scrollTop > productLogoTop) {
				$(".product-logo").each(function (i) {
					setTimeout(function () {
						$(".product-logo").eq(i).addClass("product-logo-show");
					}, 300 * i);
				});
			}
		}
		productLogo();

		// if (scrollTop > $(".btn-product-home").offset().top - 700) {
		// 	$(".btn-product-home").addClass("btn-product-home-show");
		// }

		// fixedHeader on scroll
		function fixedHeader() {
			var headerTopBar = $(".top-bar").outerHeight();
			var headerOneTopSpace = $(".header-one .logo-area").outerHeight();

			var headerOneELement = $(".header-one .site-navigation");
			var headerTwoELement = $(".header-two .site-navigation");

			if ($(window).scrollTop() > headerTopBar + headerOneTopSpace) {
				$(headerOneELement).addClass("navbar-fixed");
				$(".header-one").css("margin-bottom", headerOneELement.outerHeight());
			} else {
				$(headerOneELement).removeClass("navbar-fixed");
				$(".header-one").css("margin-bottom", 0);
			}
			if ($(window).scrollTop() > headerTopBar) {
				$(headerTwoELement).addClass("navbar-fixed");
				$(".header-two").css("margin-bottom", headerTwoELement.outerHeight());
			} else {
				$(headerTwoELement).removeClass("navbar-fixed");
				$(".header-two").css("margin-bottom", 0);
			}
		}
		fixedHeader();

		// Count Up
		function counter() {
			var oTop;
			if ($(".counterUp").length !== 0) {
				oTop = $(".counterUp").offset().top - window.innerHeight;
			}
			if ($(window).scrollTop() > oTop) {
				$(".counterUp").each(function () {
					var $this = $(this),
						countTo = $this.attr("data-count");
					$({
						countNum: $this.text(),
					}).animate(
						{
							countNum: countTo,
						},
						{
							duration: 1000,
							easing: "swing",
							step: function () {
								$this.text(Math.floor(this.countNum));
							},
							complete: function () {
								$this.text(this.countNum);
							},
						}
					);
				});
			}
		}
		counter();

		// scroll to top btn show/hide
		function scrollTopBtn() {
			var scrollToTop = $("#back-to-top"),
				scroll = $(window).scrollTop();
			if (scroll >= 150) {
				scrollToTop.fadeIn();
			} else {
				scrollToTop.fadeOut();
			}
		}
		scrollTopBtn();
	});

	$(document).ready(function () {
		// navSearch show/hide
		function navSearch() {
			$(".nav-search").on("click", function () {
				$(".search-block").fadeIn(350);
			});
			$(".search-close").on("click", function () {
				$(".search-block").fadeOut(350);
			});
		}
		navSearch();

		// navbarDropdown
		function navbarDropdown() {
			if ($(window).width() < 992) {
				$(".site-navigation .dropdown-toggle").on("click", function () {
					$(this).siblings(".dropdown-menu").animate(
						{
							height: "toggle",
						},
						300
					);
				});

				var navbarHeight = $(".site-navigation").outerHeight();
				$(".site-navigation .navbar-collapse").css(
					"max-height",
					"calc(100vh - " + navbarHeight + "px)"
				);
			}
		}
		navbarDropdown();

		// back to top
		function backToTop() {
			$("#back-to-top").on("click", function () {
				$("#back-to-top").tooltip("hide");
				$("body,html").animate(
					{
						scrollTop: 0,
					},
					800
				);
				return false;
			});
		}
		backToTop();

		// banner-carousel
		function bannerCarouselOne() {
			$(".banner-carousel.banner-carousel-1").slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				dots: true,
				speed: 600,
				arrows: true,
				prevArrow:
					'<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow:
					'<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>',
			});
			$(".banner-carousel.banner-carousel-1").slickAnimation();
		}
		bannerCarouselOne();

		// banner Carousel Two
		function bannerCarouselTwo() {
			$(".banner-carousel.banner-carousel-2").slick({
				fade: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				dots: false,
				speed: 600,
				arrows: true,
				prevArrow:
					'<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow:
					'<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>',
			});
		}
		bannerCarouselTwo();

		// pageSlider
		function pageSlider() {
			$(".page-slider").slick({
				fade: true,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				dots: false,
				speed: 600,
				arrows: true,
				prevArrow:
					'<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow:
					'<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>',
			});
		}
		pageSlider();

		// Shuffle js filter and masonry
		function projectShuffle() {
			if ($(".shuffle-wrapper").length !== 0) {
				var Shuffle = window.Shuffle;
				var myShuffle = new Shuffle(
					document.querySelector(".shuffle-wrapper"),
					{
						itemSelector: ".shuffle-item",
						sizer: ".shuffle-sizer",
						buffer: 1,
					}
				);
				$('input[name="shuffle-filter"]').on("change", function (evt) {
					var input = evt.currentTarget;
					if (input.checked) {
						myShuffle.filter(input.value);
					}
				});
				$(".shuffle-btn-group label").on("click", function () {
					$(".shuffle-btn-group label").removeClass("active");
					$(this).addClass("active");
				});
			}
		}
		projectShuffle();

		// testimonial carousel
		function testimonialCarousel() {
			$(".testimonial-slide").slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				dots: true,
				speed: 600,
				arrows: false,
			});
		}
		testimonialCarousel();

		// team carousel
		function teamCarousel() {
			$(".team-slide").slick({
				dots: false,
				infinite: false,
				speed: 300,
				slidesToShow: 4,
				slidesToScroll: 2,
				arrows: true,
				prevArrow:
					'<button type="button" class="carousel-control left" aria-label="carousel-control"><i class="fas fa-chevron-left"></i></button>',
				nextArrow:
					'<button type="button" class="carousel-control right" aria-label="carousel-control"><i class="fas fa-chevron-right"></i></button>',
				responsive: [
					{
						breakpoint: 992,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 3,
						},
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 2,
						},
					},
					{
						breakpoint: 481,
						settings: {
							slidesToShow: 1,
							slidesToScroll: 1,
						},
					},
				],
			});
		}
		teamCarousel();

		// media popup
		function mediaPopup() {
			$(".gallery-popup").colorbox({
				rel: "gallery-popup",
				transition: "slideshow",
				innerHeight: "500",
			});
			$(".popup").colorbox({
				iframe: true,
				innerWidth: 600,
				innerHeight: 400,
			});
		}
		mediaPopup();
	});

	$(".projectSlider").slick({
		autoplay: true,
		autoplaySpeed: 1000,
		dots: true,
		centerMode: true,
		centerPadding: "50px",
		slidesToShow: 1,
		slidesToScroll: 1,
		mobileFirst: true,
		responsive: [
			{
				breakpoint: 1024,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3,
					infinite: true,
					dots: true,
				},
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
				},
			},
			{
				breakpoint: 480,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
				},
			},
		],
	});

	$(document).on("click", ".btn-contact-collapse", function () {
		$(".caret-icon", this).toggleClass("fa-caret-down fa-caret-right");
	});
});
