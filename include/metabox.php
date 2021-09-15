<?php 

/**
 * add metabox
 */
function custom_meta_box_markup($post_id) {
    $id = $post_id->ID;
    $uk = get_post_meta($id, "uk", true);
    $us = get_post_meta($id, "us", true);

    $default_video = get_post_meta($id, "default_video", true);
    $left_handed_video = get_post_meta($id, "left_handed_video", true);


   //echo"<pre>";print_r($left_handed_video);exit;

    $vcheck = array();
    if (empty($default_video)) {
        $vcheck = 0;
    } else {
        $vcheck = count($default_video);
    }
    /**/
    $check = array();
    if (empty($uk)) {
        $check = 0;
    } else {
        $check = count($uk[0]);
    }

    if (!is_post_edit_page()) {
        $page = "add";
    } else {
        $page = "edit";
    }
    
    include (WPBAW_DIR . '/include/admin.php');
    wp_nonce_field('uk[]', 'uk_nonce');
    wp_nonce_field('us[]', 'us_nonce');
}


function wpse_add_custom_meta_box() {
    add_meta_box('my-meta-box', __('Post Settings'), 'custom_meta_box_markup', 'post', 'normal' );
}
add_action('add_meta_boxes', 'wpse_add_custom_meta_box');

/**
 * save post
 */
function save_function_post_meta($post_id) {
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (!empty($_POST['uk'][0])) {
        update_post_meta($post_id, 'uk', [$_POST['uk']]);
        update_post_meta($post_id, 'us', [$_POST['us']]);

    }

    $default_video = get_post_meta(get_the_ID(), "default_video", true);

    $left_handed_video = get_post_meta(get_the_ID(), "left_handed_video", true);//get existing data from db

    if(!empty($_POST['deleted_video'])) {
        foreach ($_POST['deleted_video'] as $key => $values) {
            array_splice($default_video, $values-$key, 1);
            array_splice($left_handed_video, $values-$key, 1);
         



         
        
            update_post_meta($post_id, 'default_video',$default_video);
            update_post_meta($post_id, 'left_handed_video',$left_handed_video);
    }
}
/*bbbb*/

    if(!empty($_FILES['default_video']['name'][0])) {
       if($default_video)
        {
            $url = $default_video;
            for($i = 0; $i < count($_FILES['default_video']['name']);$i++) 
            {
                $upload = wp_upload_bits($_FILES['default_video']['name'][$i], null, file_get_contents($_FILES['default_video']['tmp_name'][$i]));
                $url[] = $upload['url'];
            }
        }
        else
        {
            $url = [];
            for($i = 0; $i < count($_FILES['default_video']['name']);$i++) 
            {
                $upload = wp_upload_bits($_FILES['default_video']['name'][$i], null, file_get_contents($_FILES['default_video']['tmp_name'][$i]));
                $url[] = $upload['url'];
            }
        }

        update_post_meta($post_id, 'default_video',$url);
    }
    
    if(!empty($_FILES['left_handed_video']['name'][0]))//if user upload some video
    {
        if($left_handed_video)
        {
            $url=$left_handed_video;
            for($i = 0; $i < count($_FILES['left_handed_video']['name']);$i++) 
            {
                $upload = wp_upload_bits($_FILES['left_handed_video']['name'][$i], null, file_get_contents($_FILES['left_handed_video']['tmp_name'][$i]));
                $url[] = $upload['url'];
            }
        }
        /**/
        else
        {
            $url=[];
            for($i = 0; $i < count($_FILES['left_handed_video']['name']);$i++) 
            {
                $upload = wp_upload_bits($_FILES['left_handed_video']['name'][$i], null, file_get_contents($_FILES['left_handed_video']['tmp_name'][$i]));
                $url[] = $upload['url'];
            };
        }
        update_post_meta($post_id, 'left_handed_video',$url);
    }


}
add_action('save_post', 'save_function_post_meta', 20, 3);

/**/