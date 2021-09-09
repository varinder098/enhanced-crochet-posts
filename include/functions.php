<?php 

bb
/*make Shortcode for video*/
function make_video_shortcode($attr) 
{
    $args = shortcode_atts(array('videoid' => '','width'=>'','height'=>'','ignore'=>''),$attr);
    $id=$args['videoid'];
    $default_video = get_post_meta(get_the_ID(),"default_video",true);
    $left_handed_video = get_post_meta(get_the_ID(),"left_handed_video",true);

    if($args['ignore']=="ignore")
    {
        $output = '<video class="as_it_is" width="'.$args['width'].'" height="'.$args['height'].'" controls><source src="'.$default_video[$id].'" type="video/mp4"></video>';
    }
    else
    {
        $output = '<video class="original_videos" width="'.$args['width'].'" height="'.$args['height'].'" controls><source src="'.$default_video[$id].'" type="video/mp4"></video>';
    
        $output .= '<video class="flipped_videos" width="'.$args['width'].'" height="'.$args['height'].'" controls><source src="'.$left_handed_video[$id].'" type="video/mp4"></video>';
    }
    return $output;
}

add_shortcode( 'default' , 'make_video_shortcode' );

function ignore_function( $atts, $content = null ) {
    return '<span class="ignore">' . $content . '</span>';
}

add_shortcode('ignore', 'ignore_function');


/*custom form for file upload*/
function update_edit_form() {
    echo 'enctype="multipart/form-data"';
}

add_action('post_edit_form_tag', 'update_edit_form');


/*check post page*/

if(!function_exists('is_post_edit_page')){
    function is_post_edit_page() {
        static $result = null;
        if ( $result === null ) {
            $result = false;
            if ( is_admin() ) {
                if (
                    empty( $_POST )
                    &&
                    isset( $_GET['action'] )
                    &&
                    $_GET['action'] === 'edit'
                    &&
                    isset( $_GET['post'] )
                ) {
                    // Display Edit Post page
                    $result = true;
                } elseif (
                    isset( $_POST['action'] )
                    &&
                    $_POST['action'] === 'editpost'
                    &&
                    isset( $_POST['post_type'] )
                    &&
                    isset( $_POST['post_ID'] )
                    &&
                    strpos( wp_get_referer(), 'action=edit' ) !== false
                ) {
                    // Submit Edit Post page
                    $result = true;
                }
            }
        }
        return $result;
    }
}

/*
* Update upload media size
*/
function filter_site_upload_size_limit( $size ) { 
   return 1024 * 1024 * 300; 
} 
add_filter( 'upload_size_limit', 'filter_site_upload_size_limit', 120 );