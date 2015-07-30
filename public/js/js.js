// текущий пункт меню
$(function() {
    $('.navbar-nav li').each(function () {
        if (this.getElementsByTagName("a")[0].href == document.location.href) {
            $(this).addClass("active").siblings().removeClass("active");
            //$(this).removeClass("menu1-item");
            /*event.preventDefault();*/
        }
    });
});

// отображение блока в зависимости от выбранного option
$(function() {
    $("#is_final").change(function() {
        if ($("#is_final_true").is(":selected")) {
            $("#num_cols").show();
            $('#submit').val('Далее');
        } else {
            $("#num_cols").hide();
            $("#columns_number").val(0);
            $('#submit').val('Добавить');
        }
    }).trigger('change');
});

// слайдер
$(function () {
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
