jQuery.noConflict()(function($) {
    "use strict";
	if(!$("body").hasClass("error404")){
		$('body').css('min-height',$(window).outerHeight()+1);
	}
	
	if ($("div").is(".oi_port_container")) {
		var $container = $('.oi_port_container');
		if ($container.length) {
			$container.waitForImages(function() {
	
				// initialize isotope
				$container.isotope({
					itemSelector: '.oi_strange_portfolio_item',
					layoutMode: 'masonry'
				});
	
				$('#filters a:first-child').addClass('filter_current');
				// filter items when filter link is clicked
				$("a", "#filters").on("click", function(e) {
					var selector = $(this).attr('data-filter');
					$container.isotope({
						filter: selector
					});
					$(this).removeClass('filter_button').addClass('filter_button filter_current').siblings().removeClass('filter_button filter_current').addClass('filter_button');
	
					return false;
				});
	
			}, null, true);
		}
	}


	if ($("div").is("#oi_blog_cont")) {
		var $container = $('#oi_blog_cont');
	
		if ($container.length) {
			$container.waitForImages(function() {
	
				// initialize isotope
				$container.isotope({
					itemSelector: '.oi_post',
					layoutMode: 'masonry'
				});
	
	
			}, null, true);
		}
	}

	if ($("div").is("#cbox")) {
		$('#cbox').jflickrfeed({
			limit: 10,
			qstrings: {
				id: "75034991@N05"
			},
			itemTemplate: '<div class="oi_flickr_item">' +
				'<a data-lightbox="roadtrip" href="{{image_b}}" title="{{title}}">' +
				'<img src="{{image_s}}"/>' +
				'</a>' +
				'</div>'
		});
	}



	if ($("div").is("#port_slider")) {
		$('#port_slider').flexslider({
			prevText: "", //String: Set the text for the "previous" directionNav item
			nextText: "",
			animation: "fade",
			useCSS: false,
			controlNav: false,
			animationLoop: true,
			slideshow: true,
			slideshowSpeed: 3000,
			pauseOnHover: true,
			start: function(slider) {
				slider.removeClass('oi_flex_loading');
			}
		});
	}

    if (($("body").height() - $(window).height()) > 600) {
        var stickyNavTop = $('#oi_page_head').offset().top;
        var stickyNavTopp = stickyNavTop + $('#oi_page_head').outerHeight();
        $(window).scroll(function() {
            if ($(this).scrollTop() > stickyNavTopp) {
                $(' div:not(.head_business) > .head_standard_st').fadeIn('fast');
            } else {
                $('div:not(.head_business) > .head_standard_st').css('display', 'none');
                $('div:not(.head_business) > .head_standard_st').fadeOut('fast');
            }
        });
    };
	if ($("div").is("#akceptor")) {
		var result = document.getElementById("donor").offsetHeight;
		$("#akceptor").css({"height":result+30} );
	}
	$(".oi_xs_menu", "#oi_page_head").on("click", function(e) {
         $('.header_menu').toggle();
    });

    $('.oi_blog_item_main_content a').addClass('colored');
    $('.alignnone img').addClass('img-responsive');
	
	$("#ajax-contact-form").submit(function() {
		// this points to our form
		var str = $(this).serialize(); // Serialize the data for the POST-request
		var result = '';
		$.ajax({
	
			type: "POST",
			url: 'contact.php',
			data: str,
			success: function(msg) {
				if (msg == 'OK') {
					result = '<div class="alert alert-info">Message was sent to website administrator, thank you!</div>';
					$("#fields").hide();
				} else {
					result = msg;
				}
				$("#note").html(result);
	
			}
		});
		return false;
	});

});
