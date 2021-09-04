$(document).ready(function () {
    let closHTML = '<button class="btn btn__clos"></button>';
let menuClass = $(".menu");
let addonMenu = $(".addon-menu");
function openMenu() {
  let menuList = $(".menu__list");
  for (let index = 6; index <= menuList.length; index++) {
    menuList.eq(index).addClass("menu__list--right");
  }

  $(".btn__menu").on("click", function () {
    addonMenu.toggleClass("active");
    $("body").toggleClass("open__body");
    menuClass.prepend(closHTML);
    closMenu();
  });
}
function closMenu() {
  function removeMenu() {
    addonMenu.removeClass("active");
    $(".btn").removeClass("btn__clos");
    $("body").removeClass("open__body");
  }
  $(".addon-menu__container").on("click", function (e) {
    if (!menuClass.is(e.target) && menuClass.has(e.target).length === 0) {
      removeMenu();
    }
  });
  $(".btn__clos").on("click", function () {
    removeMenu();
  });
}
function dowMenu() {
  $(".btn__toggle").on("click", function () {
    let _ = $(this).parent("li").children("ul");
    let _sub = $(this).parents(".menu__list").children("ul ");
    let _togleSub = $(this).parents(".menu__list").children(".btn__toggle");
    $(".menu .menu__list ul").not(_).not(_sub).slideUp();

    $(".btn__toggle").not(this).not(_togleSub).removeClass("active");
    _.slideToggle();
    $(this).toggleClass("active");
  });
}
function menu() {
  var has = $('.menu li:has("ul")');
  var hasSub = $('.menu li ul li:has("ul")');
  if (has) {
    has.addClass("menu__list--sub");
    has.append('<button class="btn btn__toggle"></button>');
  }
  if (hasSub) {
    hasSub.addClass("menu__list--sub");
    hasSub.append('<button class="btn btn__toggle"></button>');
  }
  $('.menu .menu__list ul li:has("ul")').addClass("menu__list--sub");
  dowMenu();
  openMenu();
}
menu();

$(window).on("scroll", function () {
  var height = $("#header").height();

  if ($(this).scrollTop() > height) {
    $(".header__scroll").addClass("scroll");
    $(".btn__backtop-home").addClass("active");
  } else {
    $(".header__scroll").removeClass("scroll");
    $(".btn__backtop-home").removeClass("active");
  }
});
$(".btn__backtop-home").on("click", function () {
  $(".btn__backtop-home").removeClass("active");
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    1000
  );
});
;
    $(".banner__slide").slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  dots: false,
  autoplay: false,
});
;
    AOS.init({
        once: true,
        offset: 0,
        easing: 'ease-in-out-cubic',
        duration: "300",
    });
    $('.control__select2').select2({
        language: {
            noResults: function (params) {
                return "Không có kết quả nào được tìm thấy";
            }
        }
    });
    /**
     * @view desc detail product
     */

    function viewDesc() {
        let height = $("#view__desc .desc").height();

        if (height > 55) {
            $("#view__desc .desc").css("height", "54.86px")
            $("#view__desc").append('<button class="btn btn__view">Xem thêm</button>');
            $('.btn__view').on("click", function () {

                $("#view__desc .desc").toggleClass('height__auto');

                let text = $(this).text();

                if (text == "Xem thêm") {
                    $(this).text('Thu gọn')
                } else {
                    $(this).text('Xem thêm')
                }
            })
        }
    }


    viewDesc();
    /**
   * @ slide detail
   */
    function slideProductDetail() {
        $('.product__slide').slick(
            {
                dots: false,
                infinite: true,
                speed: 500,
                arrow: true,
            }
        );
    }
    slideProductDetail();
    function date() {
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4'
        });
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4'
        });
    }
    date();
    function question() {
        $('.question__header').on("click", function () {
            let qeBody = $(this).next('.question__body');
            $('.question__header').not(this).removeClass('active');
            $('.question__body').not(qeBody).slideUp();
            $(this).toggleClass('active');
            $(this).next('.question__body').slideToggle();
        })
    }
    question();

    function showAuth() {
        $('.btn__show').on("click", function () {
            $('.page__account  .tab-control .control-list').slideToggle();
        })
    }
    showAuth();


})