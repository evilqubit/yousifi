$(document).ready(function() {

        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");

        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {

        	$("body").addClass("ie")}

	$('.accordion-content .accordion-item>.trigger').click(function(){
		var itemA = $('.accordion-content .accordion-item>.trigger');
		if( $(this).next().is(':hidden') ) {
			itemA.removeClass('active').next().slideUp();
			$(this).toggleClass('active').next().slideDown();
		} else {
			$(this).toggleClass('active').next().slideUp();
		}
		return false;
	});
	
	$(".contacts-con form, .info form").validate();

	$('.services-con .trigger').click(function(){
		var itemA = $('.services-con .trigger');
		if( $(this).prev().is(':hidden') ) {
			itemA.removeClass('active').prev().slideUp();
			$(this).toggleClass('active').prev().slideDown();
		} else {
			$(this).toggleClass('active').prev().slideUp();
		}
		return false;
	});

	$('.services-con .info section:first article').each(function(index){
		if ((index+1) % 2 == 0) {
			$(this).appendTo(".services-con .info section:last")
		};
	});

	$('.bxslider').bxSlider();
 	$('.bxslider-carousel').bxSlider({
		minSlides: 6,
		maxSlides: 6,
		slideWidth: 108,
		slideMargin: 14,
		moveSlides: 1
	});
  	$('.brand-carousel').bxSlider({
		minSlides: 2,
		maxSlides: 5,
		slideWidth: 174,
		slideMargin: 0,
		moveSlides: 1
	});

	$(".leasing input[type=file]").change(function() {
		if (!$(this).val()=="") {
			$(this).parent().find("label.file").text($(this).val().replace(/C:\\fakepath\\/i, ''));
		} else {
			$(this).parent().find("label.file").text("");
		}
	});

  	$(".menu-trigger").click(function() {
		$("#menu").fadeToggle(300);
		$(this).toggleClass("active")
	});
	
	$(".sub-menu-trigger").click(function() {
		$(".filter-trigger").removeClass("active");
		$(".filter").hide();
		$(".sub-menu").fadeToggle(300);
		$(this).toggleClass("active")
		$("#header .sub-menu").css({ maxHeight: $(window).height()-$("#header").height() })
	});
	
	$(".filter-trigger").click(function() {
		$(".sub-menu-trigger").removeClass("active");
		$(".sub-menu").hide();
		$(".filter").fadeToggle(300);
		$(this).toggleClass("active");
		$(".filter").css({ maxHeight: $(window).height()-$("#header").height() })
	});
	
	$(".available-lot").click(function() {
		$(".tool-tip").fadeToggle(300);
		$(this).toggleClass("active")
	});
	
	$(".drop-search").on('mouseleave', function() {
		if ($("#menu li .opened").length) {
			$("#menu li").addClass("hover");
		} else {
			$("#menu li").removeClass("hover");
		};
	});

	$(".home-con .right-con .close-con").click(function() {
		if ($(this).hasClass("active")) {
			$(this).removeClass("active");
			$(".home-con .menu-item, .home-con .con-holder").removeClass("active disable");
		} else {
			$(this).addClass("active");
			$(this).next().trigger("click");
		};
		return false;
	});

	$("select").crfs();
	$("input[type=radio], input[type=checkbox]").crfi();

	$('[placeholder]').each(function() {  
		var input = $(this);
		
		$(input).focus(function(){
			if (input.val() == input.attr('placeholder')) {
				input.val('').removeClass("placeholder");
			}
		});
		
		$(input).blur(function(){
			if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.val(input.attr('placeholder')).addClass("placeholder");
			}
		});
	}).blur();


	if ($("#map_canvas").length) {

		var ib = new InfoBox();
		var map;
		function initialize() {
			if ($("#map_canvas").length) {

				var mapOptions = {
				  zoom: 18,
				  center: new google.maps.LatLng(52.204872,0.120163),
				  mapTypeId: google.maps.MapTypeId.ROADMAP,
				  scrollwheel: false,
				  disableDefaultUI: true
				};
				map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);

			    google.maps.event.addListener(map, "click", function() { ib.close() });

				setMarkers(map, sites);
				infowindow = new google.maps.InfoWindow({
				    content: "loading..."
				});
	    google.maps.event.trigger(markersArray[0], 'click');

			}
		}
		var markersArray = [];

		var sites = [
			['we’re here', 52.204872,0.120163, 1, '<div class="map-box"><h2>we’re here </h2><div class="holder"><p><strong>address:</strong> lorem ipsum dolore sit amet nunc mass dolore</p><p><strong>Phone:</strong> +961 04 456 994<br><strong>mobile:</strong> +961 04 456 994<br><strong>fax:</strong> +961 21 014 240</p><p><strong>e-mail:</strong> <a href="#">info@lemall.com</a></p></div></div>'],
			['we’re here', 51.004872,0.120163, 1, '<div class="map-box"><h2>we’re here </h2><div class="holder"><p><strong>address:</strong> lorem ipsum dolore sit amet nunc mass dolore</p><p><strong>Phone:</strong> +961 04 456 994<br><strong>mobile:</strong> +961 04 456 994<br><strong>fax:</strong> +961 21 014 240</p><p><strong>e-mail:</strong> <a href="#">info@lemall.com</a></p></div></div>'],
			['we’re here', 51.204872,0.120163, 1, '<div class="map-box"><h2>we’re here </h2><div class="holder"><p><strong>address:</strong> lorem ipsum dolore sit amet nunc mass dolore</p><p><strong>Phone:</strong> +961 04 456 994<br><strong>mobile:</strong> +961 04 456 994<br><strong>fax:</strong> +961 21 014 240</p><p><strong>e-mail:</strong> <a href="#">info@lemall.com</a></p></div></div>'],
		];

		$("#map-select").change(function() {
			var curIN = $(this).val()-1;
		    var siteLatLng = new google.maps.LatLng(sites[curIN][1], sites[curIN][2]);
			map.setCenter(siteLatLng);
		    google.maps.event.trigger(markersArray[curIN], 'click');
			return false;
		});


		function createMarker(site, map){
		    var siteLatLng = new google.maps.LatLng(site[1], site[2]);
		    var marker = new google.maps.Marker({
		        position: siteLatLng,
		        map: map,
		        title: site[0],
		        zIndex: site[3],
		        html: site[4]
		    });
		    markersArray.push(marker);
		    // Begin example code to get custom infobox
		    var boxText = document.createElement("div");
		    boxText.style.cssText = "border: 0; margin-top: 0; background: none; padding: 0;";
		    boxText.innerHTML = marker.html;
		    var myOptions = {
	             content: boxText
	            ,disableAutoPan: false
	            ,maxWidth: 0
	            ,pixelOffset: new google.maps.Size(-170, 0)
	            ,zIndex: null
	            ,boxStyle: { 
	              background: ""
	              ,opacity: 1
	              ,width: "340px"
	             }
	            ,closeBoxMargin: "0 0"
	            ,closeBoxURL: "images/space.png"
	            ,infoBoxClearance: new google.maps.Size(1, 1)
	            ,isHidden: false
	            ,pane: "floatPane"
	            ,enableEventPropagation: false
		    };
		    // end example code for custom infobox

		    google.maps.event.addListener(marker, "click", function (e) {
		     ib.close();
		     ib.setOptions(myOptions);
		     ib.open(map, this);
		    });
		    return marker;
		}


		function setMarkers(map, markers) {

		 for (var i = 0; i < markers.length; i++) {
		   createMarker(markers[i], map);
		 }
		};

		initialize();


	};
	
	$(".home-con .menu-item").click(function() {
		if ($(this).hasClass("active")) {
			$(this).removeClass("active");
			$(".home-con .menu-item, .home-con .con-holder").removeClass("active disable");
			$(".home-con .right-con .close-con").removeClass("active");
		} else {;
			
			$(".home-con .right-con .close-con").addClass("active");
			$(".home-con .menu-item, .home-con .con-holder").removeClass("active disable").addClass("disable");
			$(this).removeClass("disable").addClass("active").next().addClass("active");
		};
		return false;
	});
});

function equalHeight(group) {
	var tallest = 0;
	group.each(function() {
		$(this).height("auto");
		var thisHeight = $(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}

$(window).load(function() {
	equalHeight($(".split>div"));
	equalHeight($(".split-2>div"));
	equalHeight($(".split-3>div"));
});
$(window).resize(function() {
	equalHeight($(".split>div"));
	equalHeight($(".split-2>div"));
	equalHeight($(".split-3>div"));
	if ($(".filter-trigger").hasClass("active")) {
		$(".filter").css({ maxHeight: $(window).height()-$("#header").height() })
	}
	if ($("#header .sub-menu-trigger").hasClass("active")) {
		$("#header .sub-menu").css({ maxHeight: $(window).height()-$("#header").height() })
	}
});

