<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 2/14/2015
 * Time: 9:08 PM
 */

//Add NextPage Button to TinyMCE
function ultimate_paged_post_tinymce($mce_buttons) {
    $pos = array_search('wp_more', $mce_buttons, true);
    if ($pos !== false) {
        $buttons = array_slice($mce_buttons, 0, $pos + 1);

        $buttons[] = 'wp_page';

        $mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos + 1));
    }
    return $mce_buttons;
}

add_filter('mce_buttons', 'ultimate_paged_post_tinymce');

//Set defaults to wp_link_pages
function ultimate_paged_post_link_pages($r) {
    global $icon_prv,$icon_next;
    if((get_option( 'upps_image_icon' ) == 'icon')){
        $icon_prv .='<img class="img-prv" src="'.plugins_url('ultimate-paged-post-splitter/assets/img/prv.png').'"/>';
        $icon_next .='<img class="img-next" src="'.plugins_url('ultimate-paged-post-splitter/assets/img/next.png').'"/>';
    }else{
        $icon_prv .='Previous';
        $icon_next .='Next';
    }
    if(get_option( 'upps_next_img' )){
        echo $img = wp_get_attachment_url( get_option( 'upps_next_img' ));
    }
    $args = array(
        'before'			=> '',
        'after'				=> '',
        'next_or_number'	=> 'next',
        'nextpagelink'		=> __('<span class="upps-next">'.$icon_next.'</span>'),
        'previouspagelink'	=> __('<span class="upps-prev">'.$icon_prv.'</span>'),
        'echo' => 0
    );
    return wp_parse_args($args, $r);

}
add_filter('wp_link_pages_args','ultimate_paged_post_link_pages');

// Add wrapper and nav to the_content
function ultimate_paged_post_the_content_filter( $content ) {

    global $multipage, $numpages, $page;
    $btn_txt_color = get_option('upps_btn_txt_color') ;
    $btn_bg_color = get_option('upps_btn_bg_color') ;
    $btn_bg_hover = get_option('upps_btn_bg_hover') ;
    //Show Full Post If Full Post Option
    if($_GET['upps'] == 'full_post'){
        global $post;
        $uppsContent .= wpautop($post->post_content);

        if(get_option( 'upps_show_all_link')){
            $makeSPBtnTxt = get_option('upps_view_sp_btn_txt');
            if(get_option( 'upps_view_full_post_button')){
                $viewSubArticleBtn .='<span class="upps-btn">'.$makeSPBtnTxt.'</span>';
            }else{
                $viewSubArticleBtn .= $makeSPBtnTxt;
            }
            if(get_option( 'upps_show_all_link')=='left'){

                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: left"><a href="'.get_permalink().'" title="View as Sub-Article">'.$viewSubArticleBtn.'</a></p>';
            }elseif(get_option( 'upps_show_all_link')=='right'){
                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: right"><a href="'.get_permalink().'" title="View as Sub-Article">'.$viewSubArticleBtn.'</a></p>';
            }elseif(get_option( 'upps_show_all_link')=='center'){
                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: center"><a href="'.get_permalink().'" title="View as Sub-Article">'.$viewSubArticleBtn.'</a></p>';
            }elseif(get_option( 'upps_show_all_link')=='none'){
                $uppsContent .=  '<p class="upps-fullpost-link" style="display: none"><a href="'.get_permalink().'" title="View as Sub-Article">'.$viewSubArticleBtn.'</a></p>';
            }else{
                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: left"><a href="'.get_permalink().'" title="View as Sub-Article">'.$viewSubArticleBtn.'</a></p>';
            }
        }

        //Else Show Slideshow
    } else {

        //If is Paginated, Work Slideshow Magic
        if ( (is_single() && $multipage) || (is_page() && $multipage) ){

            $sliderClass = 'pagination-slider';
            $slideCount = '<span class="upps-slide-count">'.$page.' of '.$numpages.'</span>';
            if($page == $numpages){
                $slideClass = 'upps-last-slide';
            } elseif ($page == 1){
                $slideClass = 'upps-first-slide';
            } else{
                $slideClass = 'upps-middle-slide';
            }

            //What to Display For Content
            $uppsContent = '<div class="upps-wrap-content"><div class="upps-the-content '.$slideClass.'">';

            //Top Slider Navigation
            if((get_option( 'upps_nav_position' ) == 'top')||(get_option( 'upps_nav_position' ) == 'both')){
                $uppsContent .= '<nav class="upps-slider-nav upps-clearfix">';

                $uppsContent .= wp_link_pages();

                // Top Slide Counter
                if((get_option( 'upps_count_position' ) == 'top')||(get_option( 'upps_count_position' ) == 'both')){
                    $uppsContent .= $slideCount;
                }

                $uppsContent .= '</nav>';
            }

            //Top Slide Counter Without Top Nav
            if(((get_option( 'upps_count_position' ) == 'top')||(get_option( 'upps_count_position' ) == 'both')) && ((get_option( 'upps_nav_position' ) != 'top')&&(get_option( 'upps_nav_position' ) != 'both'))){
                $uppsContent .= $slideCount;
            }

            // Slide Content
            $uppsContent .= '<div class="upps-content upps-clearfix">'.$content.'</div>';

            // Bottom Slider Navigation
            if((get_option( 'upps_nav_position' ) == 'bottom')||(get_option( 'upps_nav_position' ) == 'both')){
                $uppsContent .= '<nav class="upps-slider-nav upps-bottom-nav upps-clearfix">';
                $uppsContent .= wp_link_pages();


                // Bottom Slide Counter
                if((get_option( 'upps_count_position' ) == 'bottom')||(get_option( 'upps_count_position' ) == 'both')){
                    $uppsContent .= $slideCount;
                }

                $uppsContent .= '</nav>';
            }

            // Bottom Slide Counter Without Bottom Nav
            if(((get_option( 'upps_count_position' ) == 'bottom')||(get_option( 'upps_count_position' ) == 'both')) && ((get_option( 'upps_nav_position' ) != 'bottom')&&(get_option( 'upps_nav_position' ) != 'both'))){
                $uppsContent .= $slideCount;
            }

            // End Slider Div
            $uppsContent .= '</div></div>';

            // Show Full Post Link
            $fullBtnTxt = get_option('upps_view_ful_btn_txt');
            if(get_option( 'upps_view_full_post_button')){
                $viewFullPostBtn .='<span class="upps-btn">'.$fullBtnTxt.'</span>';
            }else{
                $viewFullPostBtn .= $fullBtnTxt;
            }
            if(get_option( 'upps_show_all_link')=='left'){

                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: left"><a href="'.add_query_arg( 'upps', 'full_post', get_permalink() ).'" title="View Full Post">'.$viewFullPostBtn.'</a></p>';
            }elseif(get_option( 'upps_show_all_link')=='right'){
                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: right"><a href="'.add_query_arg( 'upps', 'full_post', get_permalink() ).'" title="View Full Post">'.$viewFullPostBtn.'</a></p>';
            }elseif(get_option( 'upps_show_all_link')=='center'){
                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: center"><a href="'.add_query_arg( 'upps', 'full_post', get_permalink() ).'" title="View Full Post">'.$viewFullPostBtn.'</a></p>';
            }elseif(get_option( 'upps_show_all_link')=='none'){
                $uppsContent .=  '<p class="upps-fullpost-link" style="display: none"><a href="'.add_query_arg( 'upps', 'full_post', get_permalink() ).'" title="View Full Post">'.$viewFullPostBtn.'</a></p>';
            }else{
                $uppsContent .=  '<p class="upps-fullpost-link" style="text-align: left"><a href="'.add_query_arg( 'upps', 'full_post', get_permalink() ).'" title="View Full Post">'.$viewFullPostBtn.'</a></p>';
            }

            // Else It Isn't Pagintated, Don't Show Slider
        } else {
            $uppsContent .= $content;
        }
    }
    // Returns the content.
    $uppsContent .='<style text="text/css">.upps-btn{color: '.$btn_txt_color.'; background:'.$btn_bg_color.';} .upps-btn:hover{background:'.$btn_bg_hover.';}</style>';
    return $uppsContent;
}

add_filter( 'the_content', 'ultimate_paged_post_the_content_filter' );