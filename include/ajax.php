


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
//add_action('wp_ajax_nopriv_get_data', 'get_data');
add_action('wp_ajax_get_data', 'get_data');



/**
 * get translation post data by js
 */
function delete_data() {

    echo"<pre>";
    print_r($_POST);


    wp_die();
}
//add_action('wp_ajax_nopriv_delete_data', 'delete_data');
add_action('wp_ajax_delete_data', 'delete_data');




function delete_row() {
    $id = explode('_', sanitize_text($_POST['element_id']));
    if (wp_verify_nonce($id[2], $id[0] . '_' . $id[1])) {
                $table = 'yourtable';
        $wpdb->delete( $table, array( 'post_id' => $id[1] ) );

        echo 'Deleted post';
        die;
    } else {
        echo 'Nonce not verified';
        die;
    }

}

add_action('wp_ajax_your_delete_action', 'delete_row');
add_action( 'wp_ajax_nopriv_your_delete_action', 'delete_row');