jQuery(document).ready(function($){    
    $(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.mos-sticky-header').addClass('tiny');
		} else {
			$('.mos-sticky-header').removeClass('tiny');
		}
	});    
    $('.jarallax').jarallax({
        speed: 0.2
    });
    $('.slick-slider').slick();
    $('.counter').counterUp();
    
    /*Tab*/
    const tabItem = $(".tab-item");
    const tabInner = $(".tab-inner");

    tabItem.on("click", function () {
        tabItem.removeClass("active");
        $(this).addClass("active");

        tabInner.removeClass("active");

        $("#" + $(this).data("id")).addClass("active");
        $('.slick-slider').slick("setPosition", 0);
    });
});