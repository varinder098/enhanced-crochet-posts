


<?php

/**
 * get translation post data by js
 */
function get_data() {
    if($_POST['func']=="language")
    {
        $uk = get_post_meta($_POST['post_id'], "uk", true);
        $us = get_post_meta($_POST['post_id'], "us", true);
        
        if ($_POST['lang'] == "uk") {
            echo json_encode([$us[0], $uk[0]]);
        } else {
            echo json_encode([$uk[0], $us[0]]);
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





