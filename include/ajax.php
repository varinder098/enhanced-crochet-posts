


<?php

/**
 * get translation post data by js
 */
function get_data() {
    if($_POST['func']=="language")
    {
        $uk = get_post_meta($_POST['post_id'], "uk", true);
        $us = get_post_meta($_POST['post_id'], "us", true);
        $default_video = get_post_meta($_POST['post_id'], "default_video", true);
        $left_handed_video = get_post_meta($_POST['post_id'], "left_handed_video", true);

        if ($_POST['lang'] == "default_video") {
            echo json_encode([$default_video[0], $default_video[0]]);
        } else {
            echo json_encode([$left_handed_video[0], $left_handed_video[0]]);
        }
        wp_die();
    }
    else
    {
        $data = get_post_meta($_POST['post_id'], $_POST['field'], true);
        echo json_encode($data);
        wp_die();
    }
}
add_action('wp_ajax_nopriv_get_data', 'get_data');
add_action('wp_ajax_get_data', 'get_data');