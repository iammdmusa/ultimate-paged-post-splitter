<?php
/**
 * Created by PhpStorm.
 * User: Md.Musa
 * Date: 2/14/2015
 * Time: 9:08 PM
 */

//Plugin Settings Page
//First use the add_action to add onto the WordPress menu.
add_action('admin_menu', 'upps_add_options');
//Make our function to call the WordPress function to add to the correct menu.
function upps_add_options() {
    add_options_page('Ultimate Paged Post Splitter Options', 'Ultimate Paged Post Splitter', 'manage_options', 'uppsoptions', 'upps_options_page');
}

function upps_options_page() {
    // variables for the field and option names
    $opt_name = array('nav_position' =>'upps_nav_position',
        'count_position' => 'upps_count_position',
        'style_sheet' => 'upps_style_sheet',
        'show_all_link' => 'upps_show_all_link',
        'image_icon' => 'upps_image_icon' ,
        'scroll_up' => 'upps_scroll_up',
        'view_full_post_button' => 'upps_view_full_post_button',
        'view_ful_btn_txt' =>'upps_view_ful_btn_txt',
        'btn_txt_color' =>'upps_btn_txt_color',
        'btn_bg_color' =>'upps_btn_bg_color',
        'view_sp_btn_txt' => 'upps_view_sp_btn_txt',
        'btn_bg_hover' => 'upps_btn_bg_hover'
    );
    $hidden_field_name = 'upps_submit_hidden';

    // Read in existing option value from database
    $opt_val = array(
        'nav_position' => get_option( $opt_name['nav_position'] ),
        'count_position' => get_option( $opt_name['count_position'] ),
        'style_sheet' => get_option( $opt_name['style_sheet'] ),
        'show_all_link' => get_option( $opt_name['show_all_link'] ),
        'image_icon' => get_option( $opt_name['image_icon'] ),
        'scroll_up' => get_option( $opt_name['scroll_up'] ),
        'view_full_post_button' => get_option( $opt_name['view_full_post_button'] ),
        'view_ful_btn_txt' => get_option( $opt_name['view_ful_btn_txt'] ),
        'btn_txt_color' => get_option($opt_name['btn_txt_color']),
        'btn_bg_color' => get_option($opt_name['btn_bg_color']),
        'view_sp_btn_txt' => get_option($opt_name['view_sp_btn_txt']),
        'btn_bg_hover' => get_option($opt_name['btn_bg_hover'])
    );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if(isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
        $opt_val = array(
            'nav_position' => $_POST[ $opt_name['nav_position'] ],
            'count_position' => $_POST[ $opt_name['count_position'] ],
            'style_sheet' => $_POST[ $opt_name['style_sheet'] ],
            'show_all_link' => $_POST[ $opt_name['show_all_link'] ],
            'image_icon' => $_POST[ $opt_name['image_icon'] ],
            'scroll_up' => $_POST[ $opt_name['scroll_up'] ],
            'view_full_post_button' => $_POST[ $opt_name['view_full_post_button'] ],
            'view_ful_btn_txt' => $_POST[ $opt_name['view_ful_btn_txt'] ],
            'btn_txt_color' => $_POST[ $opt_name['btn_txt_color'] ],
            'btn_bg_color' => $_POST[ $opt_name['btn_bg_color'] ],
            'view_sp_btn_txt' => $_POST[ $opt_name['view_sp_btn_txt'] ],
            'btn_bg_hover' => $_POST[ $opt_name['btn_bg_hover'] ]
        );

        // Save the posted value in the database
        update_option( $opt_name['nav_position'], $opt_val['nav_position'] );
        update_option( $opt_name['count_position'], $opt_val['count_position'] );
        update_option( $opt_name['style_sheet'], $opt_val['style_sheet'] );
        update_option( $opt_name['show_all_link'], $opt_val['show_all_link'] );
        update_option( $opt_name['image_icon'], $opt_val['image_icon'] );
        update_option( $opt_name['scroll_up'], $opt_val['scroll_up'] );
        update_option( $opt_name['view_full_post_button'], $opt_val['view_full_post_button'] );
        update_option( $opt_name['view_ful_btn_txt'], $opt_val['view_ful_btn_txt'] );
        update_option( $opt_name['btn_txt_color'], $opt_val['btn_txt_color'] );
        update_option( $opt_name['btn_bg_color'], $opt_val['btn_bg_color'] );
        update_option( $opt_name['view_sp_btn_txt'], $opt_val['view_sp_btn_txt'] );
        update_option( $opt_name['btn_bg_hover'], $opt_val['btn_bg_hover'] );

        // Put an options updated message on the screen
        ?>
        <div id="message" class="updated fade">
            <p><strong>
                    <?php _e('Options saved.', 'upps_trans_domain' ); ?>
                </strong></p>
        </div>
    <?php
    }

    //Options Form
    ?>
    <div id="upps-body">
        <section id="uppps-head">
            <h1 class="title"><?php _e( 'Ultimate Paged Post Splitter Options', 'upps_trans_domain' ); ?></h1>
        </section>
        <section id="upps-main">
            <div id="upps-content">
                <form name="upps_img_options" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
                    <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">

                    <fieldset>
                        <legend><span>General Options:</span></legend>

                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['nav_position']; ?>">Next-Previous Position</label>
                            </div>
                            <div class="txt-title">
                                <select name="<?php echo $opt_name['nav_position']; ?>">
                                    <option value="top" <?php echo ($opt_val['nav_position'] == "top") ? 'selected="selected"' : ''; ?> >Top</option>
                                    <option value="bottom" <?php echo ($opt_val['nav_position'] == "bottom") ? 'selected="selected"' : ''; ?> >Bottom</option>
                                </select>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['count_position']?>">Post/Paged sub-article Number </label>
                            </div>
                            <div class="txt-title">
                                <select name="<?php echo $opt_name['count_position']; ?>">
                                    <option value="top" <?php echo ($opt_val['count_position'] == "top") ? 'selected="selected"' : ''; ?> >Top</option>
                                    <option value="bottom" <?php echo ($opt_val['count_position'] == "bottom") ? 'selected="selected"' : ''; ?> >Bottom</option>
                                    <option value="both" <?php echo ($opt_val['count_position'] == "both") ? 'selected="selected"' : ''; ?> >Both</option>
                                    <option value="none" <?php echo ($opt_val['count_position'] == "none") ? 'selected="selected"' : ''; ?> >Do Not Display</option>
                                </select>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['style_sheet']?>">Plugin Style use ?</label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['style_sheet']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['style_sheet'] ); ?> />
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['image_icon']?>">Next-Previous as !</label>
                            </div>
                            <div class="txt-title">
                                <select name="<?php echo $opt_name['image_icon']; ?>">
                                    <option value="icon" <?php echo ($opt_val['image_icon'] == "icon") ? 'selected="selected"' : ''; ?> >Image</option>
                                    <option value="text" <?php echo ($opt_val['image_icon'] == "text") ? 'selected="selected"' : ''; ?> >Text</option>
                                </select>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['show_all_link']?>">Display<b>View Full Post</b> in Where ?</label>
                            </div>
                            <div class="txt-title">
                                <select name="<?php echo $opt_name['show_all_link']; ?>">
                                    <option value="left" <?php echo ($opt_val['show_all_link'] == "left") ? 'selected="selected"' : ''; ?> >Left</option>
                                    <option value="right" <?php echo ($opt_val['show_all_link'] == "right") ? 'selected="selected"' : ''; ?> >Right</option>
                                    <option value="center" <?php echo ($opt_val['show_all_link'] == "center") ? 'selected="selected"' : ''; ?> >Center</option>
                                    <option value="none" <?php echo ($opt_val['show_all_link'] == "none") ? 'selected="selected"' : ''; ?> >None</option>
                                </select>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['view_full_post_button']?>"><b>View Full Post</b> Display as a  Button ?</label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['view_full_post_button']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['view_full_post_button'] ); ?> />
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['scroll_up']?>">Scroll to top of page after Next-Previous load ?</label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['scroll_up']; ?>" type="checkbox" value="1" <?php checked( '1', $opt_val['scroll_up'] ); ?> /> Scrolls up to the top of the page after each slide loads.
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend><span>Advance Options:</span></legend>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['btn_txt_color']?>">Button Text Color</label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['btn_txt_color']; ?>" type="text" value="<?php echo  $opt_val['btn_txt_color'] ; ?>" /></br>Please put color code like <b>#ffffff</b>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['btn_bg_color']?>">Button Background Color</label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['btn_bg_color']; ?>" type="text" value="<?php echo  $opt_val['btn_bg_color'] ; ?>" /></br>Please put color code like <b>#ffffff</b>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['btn_bg_hover']?>">Button Background Hover</label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['btn_bg_hover']; ?>" type="text" value="<?php echo  $opt_val['btn_bg_hover'] ; ?>" /></br>Please put color code like <b>#ffffff</b>
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['view_ful_btn_txt']?>">View Full Article: Text </label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['view_ful_btn_txt']; ?>" type="text" value="<?php echo  $opt_val['view_ful_btn_txt'] ; ?>" />
                            </div>
                        </div>
                        <div id="row">
                            <div class="txt-title">
                                <label for="<?php echo $opt_name['view_sp_btn_txt']?>">View As Splitter Article: Text </label>
                            </div>
                            <div class="txt-title">
                                <input name="<?php echo $opt_name['view_sp_btn_txt']; ?>" type="text" value="<?php echo  $opt_val['view_sp_btn_txt'] ; ?>" />
                            </div>
                        </div>
                    </fieldset>
                    <div id="row">
                        <input type="submit" class="button button-primary" value="Save Settings">
                    </div>
                </form>
            </div>
            <div id="upps-sidebar">
                <div id="me">
                    <div class="profile">
                        <?php echo get_avatar( 'musa01717@gmail.com', 100 ); ?>
                        <a target="_blank" href="http://www.shuvomusa.me/">website</a>
                        <a target="_blank" href="https://www.linkedin.com/profile/view?id=92927109">linkedin</a>
                    </div>
                    <div class="myInfo">
                        <div class="name">Md Musa</div>
                        <p class="bio">My official name is Md Musa. Frankenstein Shuvo Musa is my self-given name. I am from somewhere in Bangladesh.I am specialized in WordPress.I hardly believe "Code is poetry"</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php }

//Add Settings Link To Plugins Page
function upps_plugin_meta($links, $file) {
    $plugin = plugin_basename(__FILE__);
    // create link
    if ($file == $plugin) {
        return array_merge(
            $links,
            array( sprintf( '<a href="options-general.php?page=uppsoptions">Settings</a>', $plugin, __('Settings') ) )
        );
    }
    return $links;
}

add_filter( 'plugin_row_meta', 'upps_plugin_meta', 10, 2 );