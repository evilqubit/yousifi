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
		
		// var itemA = $('.services-con .trigger');
		// if( $(this).prev().is(':hidden') ) {
			// itemA.removeClass('active').prev().slideUp();
			// $(this).toggleClass('active').prev().slideDown();
		// } else {
			// $(this).toggleClass('active').prev().slideUp();
		// }
		
		var itemA = $('.services-con .trigger');
		if( $(this).prev().css('height') == '95px' ) {
			//$(this).prev().css('height','auto');
			$(".trigger").removeClass('active');
			$('.defaultContent').animate({height:'95px'});
			
			inner_height=$(this).prev().find('.inner').innerHeight();
			$(this).toggleClass('active').prev().animate({height: inner_height+'px'});
		} else {
			//$(this).prev().css('height','100px');
			$(this).toggleClass('active').prev().animate({height:'95px'});
		}
		return false;
	});

	$('.services-con .info section:first article').each(function(index){
		if ((index+1) % 2 == 0) {
			$(this).appendTo(".services-con .info section:last")
		};
	});

	$('.bxslider').bxSlider({
		autoStart:true,
		  auto:true,
		  captions: false,
		  speed:500,
		  pause:4000
		
	});
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
	
	
	$(window).scroll(function() {
		$("select").crfs("hide");
	});
	
	

	
	
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

