$(document).ready(function() {
    $('select').select2({
        language: "vn"
    });

    sidebar = () => {
        $('.menu__link').on("click", function() {
            $('.menu__sub').slideToggle()
        })
    }
    sidebar();

    $('.btn__menu').click(function(e) {
        $('.sidebars').toggleClass('active')

    })

});