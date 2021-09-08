jQuery(document).ready(function($) {

    function check(data) {
        if (localStorage.getItem(data.item) == data.option) {
            $("#" + data.item + "").prop('checked', true);
            ajax({ func: data.item, option: data.option });
        } else {
            $("#" + data.item + "").prop('checked', false);
            ajax({ func: data.item, option: data.other });
        }
    }

    check({ item: "language", option: "uk", other: "us" });
    check({ item: "flip_images", option: "yes", other: "no" });
    check({ item: "flip_videos", option: "left_handed_video", other: "default_video" });

    function setlocal(data) {
        var isChecked = $("#" + data.item + "").is(':checked');
        if (isChecked) {
            localStorage.setItem(data.item, data.option);
            ajax({ func: data.item, option: data.option });
        } else {
            localStorage.setItem(data.item, data.other);
            ajax({ func: data.item, option: data.other });
        }
    }

    $('.pro-plugin .popup  .apply ').on('click', function(event) {
        setlocal({ item: "language", option: "uk", other: "us" });
        setlocal({ item: "flip_images", option: "yes", other: "no" });
        setlocal({ item: "flip_videos", option: "left_handed_video", other: "default_video" });
    });

    function ajax(data) {
        if (data.func == "language") {
            $.ajax({
                type: "post",
                url: $(".admin_url").attr("value"),
                dataType: 'json',
                data: {
                    action: 'get_data',
                    post_id: $(".post_id").attr("value"),
                    lang: data.option,
                    func: "language"
                },
                success: function(msg) {
                    $('#data_content').html(function(i, val) {
                        var f = msg[0];
                        var r = msg[1];
                        $.each(f, function(i, v) {
                            val = val.replace(new RegExp('\\b' + v + '\\b', 'g'), r[i]);
                        });
                        return val;
                    });
                }
            });
        } else if (data.func == "flip_images") {
            if (data.option == "yes") {
                $("#data_content").find("img").addClass("flip");
                $("#data_content").find(".ignore img").removeClass("flip");
            } else {
                $("#data_content").find("img").removeClass("flip");
            }
        } else {
            if (data.option == "default_video") {
                $(".original_videos").each(function() {
                    $(this).show();
                });
                $(".flipped_videos").each(function() {
                    $(this).hide();
                });
            } else {
                $(".original_videos").each(function() {
                    $(this).hide();
                });
                $(".flipped_videos").each(function() {
                    $(this).show();
                });
            }
        }
    }

});