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

    $(".post_item").each(function () {
        if ($(".post-type-box").is(":checked")) {
            $isChecked = $(".position-box:checked").length;
            console.log($isChecked);
        }
    });
});
