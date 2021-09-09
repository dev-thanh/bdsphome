$(document).ready(function() {
    function addonTab() {
        $(".control-list__item").click(function() {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
            $($(this).attr("tab-show")).slideDown();
            $($(this).attr("tab-show")).siblings().slideUp();
            $(this).parent(".control-list").removeClass("active");
        });
    }
    addonTab();

    $("body").on("click", "[modal-show='show']", function(e) {
        $($(this).attr("modal-data")).addClass("show-modal");
        $($(this).attr("modal-data")).find(".content-modal").addClass("show-modal");
        $("body").addClass("active-modal");
    });
    $("body").on("click", "[modal-show='close']", function() {
        setTimeout(function() {
            $(".bs-modal").removeClass("show-modal");
            $("body").removeClass("active-modal");
        }, 500);
        $(this)
            .parents(".bs-modal")
            .find(".content-modal")
            .removeClass("show-modal");
    });

    appButton = () => {
        let has = $('.menu li:has("ul")');
        return has ?
            has.append('<button class="btn btn__toggle"></button>') :
            "";
    };

    appButton();

    onMenu = () => {
        let button = $(".btn__toggle");
        let hasMenu = $(".menu .menu__list  ul");
        button.on("click", function() {
            let __ = $(this).parent(".menu__list").children("ul");
            hasMenu.not(__).slideUp();
            button.not($(this)).removeClass("active");
            __.slideToggle();
            $(this).toggleClass("active");
        });
    };
    onMenu();

    openMenu = () => {
        $(".btn__menu").on("click", function() {
            $("body").addClass("body__hidden");
            $(".box__menu").toggleClass("active");
        });
    };
    openMenu();

    closeMenu = () => {
        let menusClass = $(".box__container");
        $(".box__menu").on("click", function(e) {
            if (
                !menusClass.is(e.target) &&
                menusClass.has(e.target).length === 0
            ) {
                $("body").removeClass("body__hidden");
                $(".box__menu").removeClass("active");
            }
        });
    };
    closeMenu();

    $(window).on("scroll", function() {
        var height = $("#header").height();
        if ($(this).scrollTop() > height) {
            $(".back-top").addClass("active");
            $(".header-body").addClass("active");
        } else {
            $(".back-top").removeClass("active");
            $(".header-body").removeClass("active");
        }
    });

    controlFilter = () => {
        let hasClass = $('.form__item.action').hasClass('active');
        if (hasClass) {
            $('.btn__click').text("Thu gọn")
        } else {
            $('.btn__click').text("Nâng cao")
        }
        $('.btn__click').on("click", function() {
            let hasClass = $('.form__item.action').hasClass('active');

            if (hasClass) {
                $('.form__item.action').removeClass('active')
                $(this).text("Nâng cao")
                $('.form__footer').addClass('active');

            } else {
                $('.form__item.action').addClass('active')
                $(this).text("Thu gọn")
                $('.form__footer').removeClass('active');
            }

        })
    }
    controlFilter();

    showPassword = () => {
        let isPass = false;
        let buttonShowPass = $('#btnShowPass');
        let inputPass = $('#inputPass');
        checkViewPass = () => {
            if (isPass) {
                inputPass.attr('type', 'password');
                isPass = false
            } else {
                inputPass.attr('type', 'text');
                isPass = true
            }
        }
        buttonShowPass.on("click", function() {
            checkViewPass();
        })
    }
    showPassword();

    authorModal = () => {
        let toggleAuthor = $('.toggleAuthor');
        toggleAuthor.on("click", function() {
            $('.content-modal').toggleClass('active');
        })
    }
    authorModal();

    $('#toggleAuthor').on("click", function(e) {
        $('#bodyAuthor').slideToggle();
        $(document).click(function(e) {
            var container = $(".author");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('#bodyAuthor').slideUp();
            }
        })

    })

});