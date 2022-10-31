jQuery(document).ready(function ($) {
    $('.post_item-title input[type="checkbox"].post-type-box').on(
        "click",
        function () {
            if ($(this).is(":checked")) {
                $(this)
                    .parent(".post_item-title")
                    .siblings(".position_item")
                    .addClass("active");
            } else {
                $(this)
                    .parent(".post_item-title")
                    .siblings(".position_item")
                    .removeClass("active");
            }
        }
    );

    // Add Active class on check social icons
    $(".social_icons .social_icon").each(function () {
        let checkbox = $(this).find('input[type="checkbox"]');
        checkbox.on("click", function () {
            var checked = $(this).is(":checked");
            if (checked) {
                $(this).closest(".social_icon").addClass("active");
            } else {
                $(this).closest(".social_icon").removeClass("active");
            }
        });
    });
});
