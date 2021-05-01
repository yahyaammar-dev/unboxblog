<?php
// For more information, visit: https://codex.wordpress.org/Child_Themes
function bone_child_theme_enqueue_scripts() {
	$current_theme = wp_get_theme();
    wp_enqueue_style( 'md-bone-child-style', get_stylesheet_directory_uri() . '/style.css', '', $current_theme->get( 'Version' ));
    wp_enqueue_script('md-bone-child-scripts', get_stylesheet_directory_uri() . '/js/bone-child-scripts.js', array('jquery'), $current_theme->get( 'Version' ), true);
    //sass styles
    wp_enqueue_style( 'md-bone-child-sass-style', get_stylesheet_directory_uri() . '/styles.css', '', $current_theme->get( 'Version' ));
}
add_action( 'wp_enqueue_scripts', 'bone_child_theme_enqueue_scripts', 999 );

/**
 * Setup My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function bone_child_theme_setup() {
    load_child_theme_textdomain( 'bone-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'bone_child_theme_setup' );



// start sessions for limit user upload functionality

add_action('init', 'unbox_bone_init');
function unbox_bone_init() {
    if (!session_id()) {
        session_start();
    }
}


// check how many time user upload the files

function unbox_bone_counter() {
    if (empty($_SESSION["myCounter"])) {
        $_SESSION["myCounter"] = 1;
    }
    else{
        $_SESSION["myCounter"]++;
    }
    return $_SESSION["myCounter"];
}


// just a small test


add_filter( 'wp_handle_upload', 'wpse47580_update_upload_stats' );
function wpse47580_update_upload_stats( $file ) {


    global $wpdb;
    $user = wp_get_current_user();

    // Count user's uploads
    $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type = 'attachment' AND post_author = " . $user->ID );
    if ( 200<= $count ) {
        $file['error'] = 'Upload limit has been reached for this account!';
    }
    $count2 = unbox_bone_counter();
    if($count2>25){
        $file['error'] = 'You can\'t upload more than 25 images!';
    }

    return $file;
}



/**
 * Get template base on layout
 */
if ( !function_exists('md_bone_get_template') ){
    function md_bone_get_template( $layout = 'list', $post_pos = null, $post_id = null ) {
        global $md_bone_opt;
        $sidebar_position = md_bone_get_option('sidebar-position', 'left');
        if (is_attachment()) {
            $sidebar_position = md_bone_get_option('sidebar-position', $sidebar_position);
        } elseif (is_author()) {
            $sidebar_position = md_bone_get_option('author-sidebar-position', $sidebar_position);
        } elseif (is_category()) {
            $sidebar_position = md_bone_get_option('category-sidebar-position', $sidebar_position);
        } elseif (is_search()) {
            $sidebar_position = md_bone_get_option('search-sidebar-position', $sidebar_position);
        } elseif (is_archive()) {
            $sidebar_position = md_bone_get_option('archive-sidebar-position', $sidebar_position);
        }

        switch ( $layout ) {

            case 'tiles':
                $thumb_size = 'md_bone_lg';
                if ($sidebar_position == 'none') {
                    echo '<div class="tile-item col-xs-12 col-sm-6 col-md-4">';
                } else {
                    echo '<div class="tile-item col-xs-12 col-sm-6">';
                }
                set_query_var('thumb_size', $thumb_size);
                get_template_part( 'templates/post-tile' );
                echo '</div>';
                break;

            case 'masonry':
                $thumb_size = 'md_bone_md';
                if ($sidebar_position == 'none') {
                    echo '<div class="grid-item col-xs-12 col-sm-6 col-md-4">';
                } else {
                    echo '<div class="grid-item col-xs-12 col-sm-6">';
                }
                set_query_var('thumb_size', $thumb_size);
                get_template_part( 'templates/post-card-paper' );
                echo '</div>';
                break;

            default:
            case 'list':
                echo '<div class="list-item">';
                get_template_part( 'templates/post-list' );
                echo '</div>';
                break;

            case 'split':
                echo '<div class="list-item">';
                get_template_part( 'templates/post-split' );
                echo '</div>';
                break;

            case 'alt--1':
                $mixed_cycle = md_bone_get_option('mixed-cycle', 5);
                $big_post_first = md_bone_get_option('big-post-first', '0');
                $format = md_bone_get_post_format();
                $format_allowed = in_array($format, array( 'audio', 'video', 'gallery', 'image', '' ));
                global $wp_query;
                if (!$post_pos) {
                    $post_pos = $wp_query->current_post + 1;
                }
                echo '<div class="list-item">';
                if ($big_post_first === '1') {
                    if (($post_pos - 1) % $mixed_cycle) {
                        get_template_part( 'templates/post-list' );
                    } else {
                        if (has_post_thumbnail() && $format_allowed) {
                            get_template_part( 'templates/post-split' );
                        } else {
                            get_template_part( 'templates/post-list' );
                        }
                    }
                } else {
                    if (($post_pos % $mixed_cycle) === 0) {
                        if (has_post_thumbnail() && $format_allowed) {
                            get_template_part( 'templates/post-split' );
                        } else {
                            get_template_part( 'templates/post-list' );
                        }
                    } else {
                        get_template_part( 'templates/post-list' );
                    }
                }

                echo '</div>';
                break;

            case 'alt--2':
                $mixed_cycle = md_bone_get_option('mixed-cycle', 5);
                $big_post_first = md_bone_get_option('big-post-first', '0');
                $format = md_bone_get_post_format();
                $format_allowed = in_array($format, array( 'audio', 'video', 'gallery', 'image', '' ));
                global $wp_query;
                if (!$post_pos) {
                    $post_pos = $wp_query->current_post + 1;
                }
                echo '<div class="list-item">';
                if ($big_post_first === '1') {
                    if (($post_pos - 1) % $mixed_cycle) {
                        get_template_part( 'templates/post-list' );
                    } else {
                        if (has_post_thumbnail() && $format_allowed) {
                            get_template_part( 'templates/post-tile-large' );
                        } else {
                            get_template_part( 'templates/post-list' );
                        }
                    }
                } else {
                    if (($post_pos % $mixed_cycle) === 0) {
                        if (has_post_thumbnail() && $format_allowed) {
                            get_template_part( 'templates/post-tile-large' );
                        } else {
                            get_template_part( 'templates/post-list' );
                        }
                    } else {
                        get_template_part( 'templates/post-list' );
                    }
                }
                echo '</div>';
                break;

            case 'alt--3':
                $mixed_cycle = md_bone_get_option('mixed-cycle', 5);
                $big_post_first = md_bone_get_option('big-post-first', '0');
                $format = md_bone_get_post_format();
                $format_allowed = in_array($format, array( 'audio', 'video', 'gallery', 'image', '' ));
                global $wp_query;
                if (!$post_pos) {
                    $post_pos = $wp_query->current_post + 1;
                }
                echo '<div class="list-item">';
                if ($big_post_first === '1') {
                    if (($post_pos - 1) % $mixed_cycle) {
                        get_template_part( 'templates/post-list' );
                    } else {
                        if (has_post_thumbnail() && $format_allowed) {
                            get_template_part( 'templates/post-cutout' );
                        } else {
                            get_template_part( 'templates/post-list' );
                        }
                    }
                } else {
                    if (($post_pos % $mixed_cycle) === 0) {
                        if (has_post_thumbnail() && $format_allowed) {
                            get_template_part( 'templates/post-cutout' );
                        } else {
                            get_template_part( 'templates/post-list' );
                        }
                    } else {
                        get_template_part( 'templates/post-list' );
                    }
                }
                echo '</div>';
                break;
        }
    }
}
















function hstngr_register_widget() {
    register_widget( 'hstngr_widget' );
}
add_action( 'widgets_init', 'hstngr_register_widget' );


class hstngr_widget extends WP_Widget {



    function __construct() {
        parent::__construct(
// widget ID
            'hstngr_widget',
// widget name
            __('Hostinger Sample Widget', ' hstngr_widget_domain'),
// widget description
            array( 'description' => __( 'Hostinger Widget Tutorial', 'hstngr_widget_domain' ), )
        );
    }



    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
//if title is present
        if ( ! empty( $title ) )
            echo $args['before_title'] . $title . $args['after_title'];
//output
        echo __( 'Greetings from Hostinger.com!', 'hstngr_widget_domain' );
        echo $args['after_widget'];
    }



    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) )
            $title = $instance[ 'title' ];
        else
            $title = __( 'Default Title', 'hstngr_widget_domain' );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <?php
    }



    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}