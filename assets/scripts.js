jQuery(document).ready(function ($) {
    $(".float-left-share .nav_icon").on("click", function () {
        $(this).siblings(".css_social_items").toggleClass("hide");
        $(this).toggleClass("hide");
    });
});
