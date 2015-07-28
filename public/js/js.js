$(function() {
    $('.navbar-nav li').each(function () {
        if (this.getElementsByTagName("a")[0].href == document.location.href) {
            $(this).addClass("active").siblings().removeClass("active");
            //$(this).removeClass("menu1-item");
            /*event.preventDefault();*/
        }
    });
})

$(function () {
    // Slideshow 4
    $("#slider4").responsiveSlides({
        auto: true,
        pager: false,
        nav: true,
        speed: 500,
        namespace: "callbacks",
        before: function () {
            $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
            $('.events').append("<li>after event fired.</li>");
        }
    });

});
