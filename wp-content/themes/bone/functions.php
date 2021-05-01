<?php
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset($content_width) )
	$content_width = 768;

/**
 * Theme set up
 */
if ( !function_exists('md_bone_theme_setup') ){

	function md_bone_theme_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'bone', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
	
		// Register navigation menu
		register_nav_menus(
			array(
				'main-menu' => esc_html__('Primary Menu', 'bone'),
				'footer-menu' => esc_html__('Footer Menu', 'bone'),
			)
		);
		
		/*
		 * Enable support for Post Formats.
		 */
		add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'quote', 'link', 'aside' ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'md_bone_cover', 2000, 1125, true );
		add_image_size( 'md_bone_xxxl', 1600, 900, false );
		add_image_size( 'md_bone_xxl', 1000, 800, false );
		add_image_size( 'md_bone_xl', 800, 800, false );
		add_image_size( 'md_bone_lg', 600, 600, false );
		add_image_size( 'md_bone_md', 400, 400, false );
		add_image_size( 'md_bone_sm', 200, 170, true );
		add_image_size( 'md_bone_xs', 100, 100, true );

		/*
		 * Add support for Gutenberg's wide and full alignment.
		 */
		add_theme_support( 'align-wide' );

		/*
		 * Add Gutenberg's default block styles.
		 */
		add_theme_support( 'wp-block-styles' );

		/*
		 * Add Gutenberg's responsive embed styles.
		 */
		add_theme_support( 'responsive-embeds' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'bone' ),
					'shortName' => __( 'S', 'bone' ),
					'size'      => 12.64,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'bone' ),
					'shortName' => __( 'M', 'bone' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'bone' ),
					'shortName' => __( 'L', 'bone' ),
					'size'      => 20.256,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'bone' ),
					'shortName' => __( 'XL', 'bone' ),
					'size'      => 25.632,
					'slug'      => 'huge',
				),
			)
		);
	}

}
add_action( 'after_setup_theme', 'md_bone_theme_setup' );

/**
 * Register and enqueue styles/scripts
 */
if ( !function_exists('md_bone_scripts') ){
	function md_bone_scripts(){

		// Enqueue styles

		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendors/bootstrap/bootstrap.css', array(), '3.3.4');

		wp_enqueue_style('fotorama', get_template_directory_uri() . '/vendors/fotorama/fotorama.css', array(), '4.6.4');

		wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.css', array(), '2.2.1');

		wp_enqueue_style('zoom-js', get_template_directory_uri() . '/vendors/zoom/zoom.css', array(), '0.0.2');

		$current_theme = wp_get_theme();
		$theme_version = $current_theme->get( 'Version' );
		wp_enqueue_style('md-bone-style', get_template_directory_uri() . '/style.css', array(), $theme_version);

		// Enqueue scripts

		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/vendors/bootstrap/bootstrap.min.js', array('jquery'), '3.3.7', true);

		wp_enqueue_script('fotorama', get_template_directory_uri() . '/vendors/fotorama/fotorama.js', array(), '4.6.4', true);

		wp_enqueue_script( 'masonry', '', array('jquery'), '', true );

		wp_enqueue_script('theia-sticky-sidebar', get_template_directory_uri() . '/vendors/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '1.7.0', true);

		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/vendors/owl-carousel/owl.carousel.min.js', array('jquery'), '2.2.1', true);

		wp_enqueue_script( 'webfontloader', get_template_directory_uri() . '/vendors/webfontloader/webfontloader.js', array(), '1.6.28', true );

		wp_enqueue_script('zoom-js', get_template_directory_uri() . '/vendors/zoom/zoom.min.js', array(), '0.0.2', true);

		wp_enqueue_script('md-bone-scripts', get_template_directory_uri() . '/js/md-scripts.js', array('jquery'), false, true);

		wp_enqueue_style('font-awesome', get_template_directory_uri(). '/vendors/font-awesome/css/font-awesome.min.css', array(), '4.7.0');

		//add the comments reply to script on single pages
		if (is_single()) {
			wp_enqueue_script('comment-reply');
		}
	}
}
add_action( 'wp_enqueue_scripts','md_bone_scripts' );

/**
 * Add Webfont config to head.
 */
if ( ! function_exists( 'md_bone_webfont' ) ) {
	function md_bone_webfont() {
		if ( ! class_exists( 'Redux' ) )
			return; // Redux Framework isn't activated!

		$webfont_array = array();
		$webfont_added = array();
		$heading_font = md_bone_get_option( 'title-typography', array() );
		$body_font = md_bone_get_option( 'body-typography', array() );
		$meta_font = md_bone_get_option( 'meta-typography', array() );

		$heading_font_string = $heading_font[ 'font-family' ] . ':300,400,700';
		if ( ( array_key_exists( 'subsets', $heading_font ) ) && ( $heading_font[ 'subsets' ] !== '' ) ) {
			$heading_font_string .= ':' . $heading_font[ 'subsets' ];
		}

		$webfont_array[] = $heading_font_string;
		$webfont_added[] = $heading_font[ 'font-family' ];

		if ( ! in_array( $body_font[ 'font-family' ], $webfont_added, true ) ) {
			$body_font_string = $body_font[ 'font-family' ] . ':300,400,700,300i,400i,700i';
			if ( ( array_key_exists( 'subsets', $body_font ) ) && ( $body_font[ 'subsets' ] !== '' ) ) {
				$body_font_string .= ':' . $body_font[ 'subsets' ];
			}

			$webfont_array[] = $body_font_string;
			$webfont_added[] = $body_font[ 'font-family' ];
		}

		if ( ! in_array( $meta_font[ 'font-family' ], $webfont_added, true ) ) {
			$meta_font_string = $meta_font[ 'font-family' ] . ':300,400,700';
			if ( ( array_key_exists( 'subsets', $meta_font ) ) && ( $meta_font[ 'subsets' ] !== '' ) )  {
				$meta_font_string .= ':' . $meta_font[ 'subsets' ];
			}

			$webfont_array[] = $meta_font_string;
			$webfont_added[] = $meta_font[ 'font-family' ];
		}

		wp_add_inline_script(
			'webfontloader',
			'WebFontConfig = {
				google: {
					families: ' . json_encode( $webfont_array ) . '
				},
			};',
			'before'
		);
	}
}
add_action( 'wp_enqueue_scripts', 'md_bone_webfont' );
add_action( 'admin_print_scripts', 'md_bone_webfont' );

/**
 * Add inline CSS for Google Fonts in backend.
 */
if ( ! function_exists( 'md_bone_webfont_css_backend' ) ) {
	function md_bone_webfont_css_backend() {
		if ( ! class_exists( 'Redux' ) )
			return; // Redux Framework isn't activated!

		$body_font_selectors = '.editor-styles-wrapper.editor-styles-wrapper';

		$heading_font_selectors = '.editor-post-title__block .editor-post-title__input, .editor-styles-wrapper.editor-styles-wrapper h1, .editor-styles-wrapper.editor-styles-wrapper h2, .editor-styles-wrapper.editor-styles-wrapper h3, .editor-styles-wrapper.editor-styles-wrapper h4, .editor-styles-wrapper.editor-styles-wrapper h5, .editor-styles-wrapper.editor-styles-wrapper h6';

		$meta_font_selectors = 'label,input[type=submit],.metaText,.metaFont,.metaBtn,.postMeta,.postCategory,.blockHeading,.comment-reply-title,.wp-caption,.gallery-caption,.widget-title,.btn,.navigation,.logged-in-as,.widget_calendar table,.tagcloud a,.widget_nav_menu .menu,.widget_categories li,.widget_meta li > a,.widget_pages li,.widget_archive a,.comment-reply-title small,.wpp-meta,.wpp-list-with-thumbnails > li > a:first-child:after,.wpp-list:not(.wpp-list-with-thumbnails) > li:before';

		$heading_font = md_bone_get_option( 'title-typography', array() );
		$body_font = md_bone_get_option( 'body-typography', array() );
		$meta_font = md_bone_get_option( 'meta-typography', array() );

		$output_css = '';
		$output_css .= $body_font_selectors . '{font-family:' . $body_font[ 'font-family' ] . ';}';
		$output_css .= $heading_font_selectors . '{font-family:' . $heading_font[ 'font-family' ] . ';}';
		$output_css .= $meta_font_selectors . '{font-family:' . $meta_font[ 'font-family' ] . ';}';

		// Other custom CSS styles
		$primary_color = md_bone_get_option('primary-color', '#4baea0');
		$primary_color_bg_selectors = '.block-editor-writing-flow .block-editor-block-list__block .wp-block-calendar table caption';
		$output_css .= $primary_color_bg_selectors . '{background-color:' . $primary_color . ';}';

		echo '<style id="md-bone-admin-inline-css" type="text/css">';
		echo esc_html( $output_css );
		echo '</style>';
	}
}
add_action( 'admin_print_scripts', 'md_bone_webfont_css_backend' );

/**
 * Add preconnect hint for Google Fonts to head
 */
if ( !function_exists('md_bone_add_preconnect_link') ){
	function md_bone_add_preconnect_link(){
		if ( ! class_exists( 'Redux' ) )
			return; // Redux Framework isn't activated!

		echo '<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>';
	}
}
add_filter('wp_head', 'md_bone_add_preconnect_link', 1);
add_filter('admin_head', 'md_bone_add_preconnect_link', 0);

/**
 * Register theme's frontend variable
 */
if ( !function_exists('md_bone_frontend_variable') ){
	function md_bone_frontend_variable(){

		// Ajax load posts vars
		global $wp_query;
		// What page are we on? And what is the pages limit?
		$posts_per_page = (int)get_option( 'posts_per_page' );
		$max = $wp_query->max_num_pages;
		$query_vars = $wp_query->query;
		$no_duplicate_switch = md_bone_get_option('no-duplicate-posts-switch', '0');

		if (($no_duplicate_switch !== '1') && (!is_home())) {
			$featured_posts = array();
		} else {
			$featured_posts = MDBONE_avoidDuplicatePosts::$featured_posts;	
		}

		if (current_user_can('read_private_posts')) {
			$post_status = array("publish", "private");
		} else {
			$post_status = "publish";
		}
		
		if (empty($query_vars)) {
			$query_vars = array(
				"post_status" => $post_status,
				"posts_per_page" => $posts_per_page,
				"post__not_in" => $featured_posts,
			);
		}

		$paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
		$ajaxloadpost = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'failText' => esc_html__('Error loading posts', 'bone'),
			'loadingText' => esc_html__('Loading posts', 'bone'),
			'noMoreText' => esc_html__('No more posts', 'bone'),
			'query_vars' => $query_vars,
			'startPage' => $paged,
			'maxPages' => $max,
		);

		if (is_admin_bar_showing()) {
			$fixed_offset = 32;
			$has_adminbar = true;
		} else {
			$fixed_offset = 0;
			$has_adminbar = false;
		}

		// Sticky header
		$sticky_header_switch = md_bone_get_option('sticky-header', '');
		$sticky_header = array('toggle' => $sticky_header_switch, 'hasAdminBar' => $has_adminbar);

		// Sticky sidebar
		$sticky_sidebar_switch = md_bone_get_option('sticky-sidebar', '');
		$sb_offset_top = ($sticky_header_switch === '1'? (104 + $fixed_offset): $fixed_offset);
		$sticky_sidebar = array('toggle' => $sticky_sidebar_switch, 'offsetTop' => $sb_offset_top );

		// Parallax effect on single billboard
		$parallax_toggle = md_bone_get_option('parallax-switch', true);

		// Get curent page uri
		$current_rel_uri = add_query_arg( NULL, NULL );

		// High resolution compatible
		$high_resolution = md_bone_get_option('high-resolution-switch', '0');

		// Featured slider options
		$slider_autoplay = (boolean)md_bone_get_option('slider-autoplay', '0');
		$slider_autoplay_timeout = (int)md_bone_get_option('slider-autoplay-timeout', '5000');
		$slider_opts = array(
			'autoplay' => $slider_autoplay,
			'timeout'  => $slider_autoplay_timeout,
		);
		
		$md_bone_var = array(
			'ajaxloadpost' => $ajaxloadpost,
			'stickySidebar' => $sticky_sidebar,
			'stickyHeader' => $sticky_header,
			'currentRelURI' => $current_rel_uri,
			'parallaxToggle' => $parallax_toggle,
			'highResolution' => $high_resolution,
			'sliderOpts' => $slider_opts,
		);
		wp_localize_script( 'md-bone-scripts', 'mdBoneVar', $md_bone_var );
	}
}
add_action( 'wp_enqueue_scripts','md_bone_frontend_variable' );

/**
 * Register and enqueue admin styles/scripts
 */
if ( !function_exists('md_bone_admin_scripts') ){
	function md_bone_admin_scripts( $hook ) {
		$current_theme = wp_get_theme();
		$theme_version = $current_theme->get( 'Version' );
		if ( $hook === 'post-new.php' || $hook === 'post.php' ) {
			wp_enqueue_script( 'md-bone-admin-scripts', get_template_directory_uri().'/js/md-admin-scripts.js', array('jquery'), $theme_version, true );

			wp_enqueue_script( 'webfontloader', get_template_directory_uri() . '/vendors/webfontloader/webfontloader.js', array(), '1.6.28', true );
		}

		wp_enqueue_style('md-bone-admin-styles', get_template_directory_uri().'/css/admin.css', array(), $theme_version);
	}
}
add_action( 'admin_enqueue_scripts','md_bone_admin_scripts', 50 );

/**
 * Extend Image block
 */

function md_bone_extend_image_block() {
	wp_enqueue_script(
		'md-bone-extend-image-block',
		get_template_directory_uri() . '/js/md-extend-image-block.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}

add_action( 'enqueue_block_editor_assets', 'md_bone_extend_image_block' );

/**
 * Include theme function files
 */

// Redux framework
if ( !isset( $md_bone_opt ) && file_exists( get_template_directory() . '/inc/minimaldog-theme-option.php' ) ) {
	get_template_part( 'inc/minimaldog-theme-option' );
}

// Metabox config
get_template_part( 'inc/minimaldog-metabox-config' );

// TGM plugin activation config
get_template_part( 'inc/tgmplugin-config' );

// Theme utilities
get_template_part( 'inc/minimaldog-utilities' );

/**
 * Register sidebars
 */
if ( !function_exists('md_bone_widgets_init') ){
	function md_bone_widgets_init(){
		register_sidebar(array(
			'id' => 'home-sidebar',
			'name' => esc_html__('Home Sidebar', 'bone'),
			'description'   => esc_html__('Appears on Front Page', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'single-sidebar',
			'name' => esc_html__('Single Sidebar', 'bone'),
			'description'   => esc_html__('Appears on single posts', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'default-sidebar',
			'name' => esc_html__('Default Sidebar', 'bone'),
			'description'   => esc_html__('Appears on other pages', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'header-sidebar',
			'name' => esc_html__('Header Widget Area', 'bone'),
			'description'   => esc_html__('Appears in site header', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'adsidebar-1',
			'name' => esc_html__('Ad Area 1', 'bone'),
			'description'   => esc_html__('Appears above home content', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'adsidebar-2',
			'name' => esc_html__('Ad Area 2', 'bone'),
			'description'   => esc_html__('Appears at bottom of page', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'adsidebar-3',
			'name' => esc_html__('Ad Area 3', 'bone'),
			'description'   => esc_html__('Appears under post content', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'footer-sidebar-1',
			'name' => esc_html__('Footer Sidebar 1', 'bone'),
			'description'   => esc_html__('Appears under featured section of home page', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'footer-sidebar-2',
			'name' => esc_html__('Footer Sidebar 2', 'bone'),
			'description'   => esc_html__('Appears at top of posts and pages', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
		register_sidebar(array(
			'id' => 'footer-sidebar-3',
			'name' => esc_html__('Footer Sidebar 3', 'bone'),
			'description'   => esc_html__('Appears at the bottom of posts and pages', 'bone'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widget-title">',
			'after_title' => '</h4>',
		));
	}
}
add_action( 'widgets_init', 'md_bone_widgets_init' );

/**
 * Enqueue supplemental block editor styles.
 */
function md_bone_block_editor_styles() {

	$css_dependencies = array();

	// Enqueue the editor styles.
	wp_enqueue_style( 'md-bone-block-editor-styles', get_template_directory_uri() . '/css/editor-style-block.css', $css_dependencies, wp_get_theme()->get( 'Version' ), 'all' );
}

add_action( 'enqueue_block_editor_assets', 'md_bone_block_editor_styles', 1, 1 );

/**
 * Enqueue classic editor styles.
 */
function md_bone_classic_editor_styles() {
	add_theme_support( 'editor-styles' );
	add_editor_style( get_template_directory_uri() . '/css/editor-style-classic.css' );
}

add_action( 'init', 'md_bone_classic_editor_styles' );

/**
 * Add theme's inline CSS to site's head tag
 */
if ( !function_exists('md_bone_custom_css') ){
	function md_bone_custom_css() {
		if (!is_admin()) {
			$inline_css = '';
			$primary_color = md_bone_get_option('primary-color', '#4baea0');
			$border_color_selectors = '.fotorama__thumb-border,.tagcloud a:hover,.tagcloud a:focus,.tagcloud a:active,.wp-block-tag-cloud a:hover,.wp-block-tag-cloud a:focus,.wp-block-tag-cloud a:active,.postTags-list > a:hover,.postVia-list > a:hover,.postSource-list > a:hover,.tabs-nav li.active a:after,.navigation--standard > ul > li > a:before,.articleTags-list > a:hover,input[type="submit"],input[type="submit"]:hover';
			$inline_css .= $border_color_selectors.'{border-color:'.$primary_color.';}';
			$inline_css .= '.reviewMeter-item-score:after,.commentCountBox:after{border-top-color:'.$primary_color.';}';
			
			if (strlen(trim($inline_css)) !== 0) {
				wp_add_inline_style( 'md-bone-style', $inline_css );
			}
		}
	}
}
add_action('wp_enqueue_scripts','md_bone_custom_css');

/**
 * Safe way to get option value
 */
if ( ! function_exists( 'md_bone_get_option' ) ){
	function md_bone_get_option($opt, $default){
		global $md_bone_opt;
		if (!isset($md_bone_opt) || empty($md_bone_opt)) {
			return $default;
		}

		if (array_key_exists($opt, $md_bone_opt)) {
			return $md_bone_opt[$opt];
		} else {
			return $default;
		}
	}
}

/**
 * Safe way to get meta box value of single post/page
 */
if ( ! function_exists( 'md_bone_get_metabox' ) ){
	function md_bone_get_metabox($opt, $default = '',  $args = '', $post_id = null){
		$prefix ='md_bone_';
		if ( !function_exists('rwmb_meta') ) {
			return $default;
		} else {
			$metabox_opt = rwmb_meta( $prefix.$opt, $args, $post_id );
			if (is_array($metabox_opt)) {
				if (empty($metabox_opt)) {
					return $default;
				}
			} else {
				if ($metabox_opt == '') {
					return $default;
				}
			}

			return $metabox_opt;
		}
	}
}

/**
 * Get page layout-related options
 */
if ( ! function_exists( 'md_bone_get_layout_opt' ) ){
	function md_bone_get_layout_opt(){
		// Featured block
		$feat_layout = md_bone_get_option('feat-layout','slider');
		$template = ( strpos($feat_layout, '-') ) ? substr($feat_layout, 0, strpos($feat_layout, '-')) : $feat_layout;
		$fw_feat = ( ($feat_layout == 'slider-cover') || ($feat_layout == 'slider-fw') || ($feat_layout == 'carousel') ) ? true : false;

		// Main
		$sidebar_position = md_bone_get_option('sidebar-position','right-sidebar');
		$content_layout = md_bone_get_option('content-layout','list');
		$content_layout_type = ( strpos($content_layout, '-') ) ? substr($content_layout, 0, strpos($content_layout, '-')) : $content_layout;
		if ($content_layout_type == 'alt') {
			$mixed_cycle = md_bone_get_option('mixed-cycle', 4);
		} else {
			$mixed_cycle = 0;
		}
		if (is_attachment()) {
			$sidebar_position = md_bone_get_option('sidebar-position', $sidebar_position);
		} elseif (is_author()) {
			$sidebar_position = md_bone_get_option('author-sidebar-position', $sidebar_position);
			$content_layout = md_bone_get_option('author-content-layout', $content_layout);
			$content_layout_type = ( strpos($content_layout, '-') ) ? substr($content_layout, 0, strpos($content_layout, '-')) : $content_layout;
			if ($content_layout_type == 'alt') {
				$mixed_cycle = md_bone_get_option('author-mixed-cycle', 4);
			}
		} elseif (is_category()) {
			$sidebar_position = md_bone_get_option('category-sidebar-position', $sidebar_position);
			$content_layout = md_bone_get_option('category-content-layout', $content_layout);
			$content_layout_type = ( strpos($content_layout, '-') ) ? substr($content_layout, 0, strpos($content_layout, '-')) : $content_layout;
			if ($content_layout_type == 'alt') {
				$mixed_cycle = md_bone_get_option('category-mixed-cycle', 4);
			}
		} elseif (is_search()) {
			$sidebar_position = md_bone_get_option('search-sidebar-position', $sidebar_position);
			$content_layout = md_bone_get_option('search-content-layout', $content_layout);
			$content_layout_type = ( strpos($content_layout, '-') ) ? substr($content_layout, 0, strpos($content_layout, '-')) : $content_layout;
			if ($content_layout_type == 'alt') {
				$mixed_cycle = md_bone_get_option('search-mixed-cycle', 4);
			}
		} elseif (is_archive()) {
			$sidebar_position = md_bone_get_option('archive-sidebar-position', $sidebar_position);
			$content_layout = md_bone_get_option('archive-content-layout', $content_layout);
			$content_layout_type = ( strpos($content_layout, '-') ) ? substr($content_layout, 0, strpos($content_layout, '-')) : $content_layout;
			if ($content_layout_type == 'alt') {
				$mixed_cycle = md_bone_get_option('archive-mixed-cycle', 4);
			}
		} elseif (is_singular()) {
			$content_layout = '';
			$single_layout = md_bone_get_single_layout();
			if (($single_layout == 'billboard-fw') || ($single_layout == 'top-wide-fw')) {
				$sidebar_position = 'none';
			} else {
				$sidebar_position = md_bone_get_metabox('post-sidebar-position', '');
				if ($sidebar_position == '') {
					$sidebar_position = md_bone_get_option('single-sidebar-position', 'none');
				}
			}
		}

		$content_class = 'block--'.$content_layout;
		if ($content_layout == 'alt--4') {
			$content_class .= ' block--tiles';
		}
		if ($content_layout == 'masonry') {
			$content_class .= ' js-masonry-grid';
		}

		$sticky_sidebar = md_bone_get_option('sticky-sidebar', '1');
		$main_class = '';
		$sidebar_class = '';
		if ($sidebar_position == 'right') {
			$main_class .= ' hasRightSidebar';
			$sidebar_class .= ' sidebar--right';
		} elseif ($sidebar_position == 'left') {
			$main_class .= ' hasLeftSidebar';
			$sidebar_class .= ' sidebar--left';
		} else {
			$main_class .= ' layoutContent--fullwidth';
			if (($content_layout != 'tiles') && ($content_layout != 'masonry')) {
				$main_class .= " contentWrap";
			}
		}
		if($sticky_sidebar == '1') {
			$sidebar_class .= ' js-sticky-sidebar';
		}

		// Pagination
		$pagination_type = md_bone_get_option('pagination-type','1');
		if (is_archive() || is_search()) {
			$pagination_type = '1';
		}

		$layout_opt = array(
			'main-class' => $main_class,
			'content-layout' => $content_layout,
			'content-class' => $content_class,
			'sidebar-position' => $sidebar_position,
			'sticky-sidebar' => $sticky_sidebar,
			'sidebar-class' => $sidebar_class,
			'pagination-type' => $pagination_type,
			'mixed-cycle' => $mixed_cycle,
		);
		return $layout_opt;
	}
}

/**
 * Create args query for featured block
 */
if ( ! function_exists( 'md_bone_create_ft_args' ) ){
	function md_bone_create_ft_args(){
		$args = array();
		$posts_per_page = 4;
		if (current_user_can('read_private_posts')) {
			$post_status = array('publish', 'private');
		} else {
			$post_status = 'publish';
		}

		// post quantity
		$feat_layout = md_bone_get_option('feat-layout', 'alt');
		switch ($feat_layout) {
			case 'tiles':
				$posts_per_page = 3;
				break;

			case 'alt':
				$posts_per_page = 5;
				break;

			default:
				$posts_per_page = md_bone_get_option('feat-post-quantity', 5);
				break;
		}

		// create args base on method
		$feat_get_post_method = md_bone_get_option('feat-get-post-method', '');
		switch ($feat_get_post_method) {
			case 'by-manual':
				$post_in = md_bone_get_option('feat-post-select', '');
				if ($post_in !== '') {
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'post__in'   => $post_in,
						'orderby'=>'post__in',
						'md_bone_duplicate_disable' => true,
					);
				} else {
					$args = false;
				}
				break;

			case 'by-marked':
				$prefix = 'md_bone_';
				$args = array(
					'post_status' => $post_status,
					'posts_per_page'      => $posts_per_page,
					'ignore_sticky_posts' => 1,
					'meta_key'   => $prefix.'post_featured',
					'meta_value' => '1',
					'md_bone_duplicate_disable' => true,
				);
				break;

			case 'by-tag':
				$tag_in = md_bone_get_option('feat-tag-select', '');
				if ($tag_in !== '') {
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'tag__in'   => $tag_in,
						'md_bone_duplicate_disable' => true,
					);
				} else {
					$args = false;
				}
				break;

			case 'by-category':
				$category_in = md_bone_get_option('feat-cat-select', '');
				if ($category_in !== '') {
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'category__in'   => $category_in,
						'md_bone_duplicate_disable' => true,
					);
				} else {
					$args = false;
				}
				break;

			default:
			case 'by-latest':
				$args = array(
					'post_status' => $post_status,
					'posts_per_page'      => $posts_per_page,
					'ignore_sticky_posts' => 1,
					'orderby'   => 'date',
					'md_bone_duplicate_disable' => true,
				);
				break;
		}

		return $args;
	}
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

/**
 * Check post format
 */
if ( !function_exists('md_bone_get_post_format') ){
	function md_bone_get_post_format( $post_id = '' ) {
		$format = get_post_format($post_id);
		switch ($format) {

			case 'video':
				$format_media = md_bone_get_metabox('format_video_url');
				if ($format_media === '') {
					return '';
				} else {
					return $format;
				}
				break;

			case 'audio':
				$embed = md_bone_get_metabox( 'format_audio_url' );
				$audio_files = md_bone_get_metabox( 'format_audio_file', '', 'type=file_advanced' );
				if (($embed == '') && ($audio_files == '')) {
					return '';
				} else {
					return $format;
				}
				break;

			case 'image':
				$format_media = md_bone_get_metabox( 'format_image_file', '', 'type=image&size=full' );
				if ($format_media == '') {
					return '';
				} else {
					return $format;
				}
				break;

			case 'gallery':
				$format_media = md_bone_get_metabox( 'format_gallery_files', '', 'type=image&size=full' );
				if ($format_media == '') {
					return '';
				} else {
					return $format;
				}
				break;

			case 'link':
				$format_media = md_bone_get_metabox( 'format_link_url' );
				if ($format_media === '') {
					return '';
				} else {
					return $format;
				}
				break;

			case 'quote':
				$format_media = md_bone_get_metabox( 'format_quote_content' );
				if ($format_media === '') {
					return '';
				} else {
					return $format;
				}
				break;

			default:
				return $format;
				break;
		}
	}
}

/**
 * Display post format media
 */
if ( !function_exists('md_bone_post_format') ){
	function md_bone_post_format( $thumb_size = 'md_bone_md' ) {
		$format = md_bone_get_post_format();
		switch ($format) {

			case 'video':
				get_template_part( 'templates/format-video' );
				break;

			case 'audio':
				get_template_part( 'templates/format-audio' );
				break;

			case 'image':
				get_template_part( 'templates/format-image' );
				break;

			case 'gallery':
				get_template_part( 'templates/format-gallery' );
				break;

			case 'link':
				get_template_part( 'templates/format-link' );
				break;

			case 'quote':
				get_template_part( 'templates/format-quote' );
				break;

			case 'aside':
				return;
				break;

			default:
				md_bone_featured_img( $thumb_size );
				break;
		}
	}
}

/**
 * Display post featured image
 */
if ( !function_exists('md_bone_featured_img') ){
	function md_bone_featured_img( $size = 'md_bone_md', $class = '', $icon = false ) {
		if ( !has_post_thumbnail() )
			return;

		if ( is_single() ) {
			$hide_featured_img = md_bone_get_metabox('hide_featured_img', '0');
			if ($hide_featured_img === '1')
				return;
		}
		
		$article_link = get_permalink(); ?>
		<div class="postFeaturedImg<?php if ( is_single() ) echo ' postFeaturedImg--single'; ?><?php if ($class != '') echo ' '.esc_attr($class); ?>">
			<?php if ( !is_single() ) { ?>
			<a href="<?php echo esc_url($article_link); ?>" class="o-blockLink">
				<?php if ($icon) { md_bone_format_icon(); } ?>
				<?php the_post_thumbnail($size); ?>
			</a>
			<?php } else {
				the_post_thumbnail($size);
				$featured_img_caption = md_bone_get_metabox('featured_img_caption', '');
				if ($featured_img_caption !== '') {
					echo '<div class="postFeaturedImg-caption">'.$featured_img_caption.'</div>';
				}
			} ?>
		</div>
		<?php
	}
}

/**
 * Display post review badge in post title
 */
if ( ! function_exists( 'md_bone_review_score_badge' ) ) {  
	function md_bone_review_score_badge() {
		if ( !function_exists('rwmb_meta') )
			return;
		
		$post_id = get_the_id();
		$review_switch = rwmb_meta( 'md_bone_review_switch', $post_id );
		if ( $review_switch != '1' ) return;
		$review_totalscore = rwmb_meta( 'md_bone_review_totalscore', $post_id );
		$max_score = 10; ?>
		<span class="reviewScoreBadge">
			<i class="fa fa-star"></i>&nbsp;<!--
			--><span><?php echo esc_html($review_totalscore); ?></span><!--
			--><span>/<?php echo esc_html($max_score); ?></span>
		</span>
	<?php
	}
}

/**
 * Display article meta buttons
 */
if ( !function_exists('md_bone_post_meta_btn') ){
	function md_bone_post_meta_btn( $style = '1' ) {
		switch ($style) {
			case '1':
			default:
				?>
				<div class="postMeta--btn postMeta--btn--1">
					<a href="<?php comments_link(); ?>" class="metaFont metaLink">
						<i class="fa fa-comment-o"></i>
						<?php if ( get_comments_number() != '0' ) { comments_number('0','1','%'); echo '<span class="hidden-xs"> '.esc_html__('comments', 'bone').'</span>'; }
						else { echo '<span class="hidden-xs"> '.esc_html__('Comment', 'bone').'</span>'; } ?>
					</a>
				</div>
				<?php
				break;

			case '2':
				$article_link = get_permalink();
				?>
				<div class="postMeta--btn postMeta--btn--2 clearfix">
					<div class="u-floatLeft">
						<a href="<?php echo esc_url($article_link); ?>" class="readMoreLink metaLink metaFont"><?php esc_html_e('Read more', 'bone'); ?><i class="fa fa-angle-right"></i></a>
					</div>
					<div class="u-floatRight">
						<a href="<?php comments_link(); ?>" class="metaFont metaLink">
							<i class="fa fa-comment-o"></i>
							<?php
							if ( get_comments_number() != '0' ) {
								printf( _nx( '<span class="hidden-xs">%1$s comment</span>', '<span class="hidden-xs">%1$s comments</span>', get_comments_number(), 'comments title', 'bone' ), number_format_i18n( get_comments_number() ) );
							} else {
								echo '<span class="hidden-xs"> '.esc_html__('Comment', 'bone').'</span>';
							} ?>
						</a>
					</div>
				</div>
				<?php
				break;

			case '3':
				$article_link = get_permalink();
				?>
				<div class="postMeta--btn postMeta--btn--3 clearfix">
					<div class="u-floatLeft">
						<a href="<?php echo esc_url($article_link); ?>" class="readMoreLink metaLink metaFont"><?php esc_html_e('Read more', 'bone'); ?><i class="fa fa-angle-right"></i></a>
					</div>
					<div class="u-floatRight">
						<a href="<?php comments_link(); ?>" class="metaFont metaLink">
							<i class="fa fa-comment-o"></i>
							<?php if ( get_comments_number() != '0' ) { comments_number('0','1','%'); } ?>
						</a>
					</div>
				</div>
				<?php
				break;

			case '4':
				$article_link = get_permalink();
				?>
				<div class="postMeta--btn postMeta--btn--2 clearfix">
					<div class="u-floatLeft">
						<a href="<?php echo esc_url($article_link); ?>" class="readMoreLink metaLink metaFont"><?php esc_html_e('Read more', 'bone'); ?><i class="fa fa-angle-right"></i></a>
					</div>
					<div class="u-floatRight">
						<a href="<?php comments_link(); ?>" class="metaFont metaLink">
							<i class="fa fa-comment-o"></i>
							<?php
							if ( get_comments_number() != '0' ) {
								printf( _nx( '<span class="hidden-xs">%1$s comment</span>', '<span class="hidden-xs">%1$s comments</span>', get_comments_number(), 'comments title', 'bone' ), number_format_i18n( get_comments_number() ) );
							} else {
								echo '<span class="hidden-xs"> '.esc_html__('Comment', 'bone').'</span>';
							} ?>
						</a>
					</div>
				</div>
				<?php
				break;
		}
	}
}

/**
 * Display post author and date meta
 */
if ( !function_exists('md_bone_post_meta_author') ){
	function md_bone_post_meta_author( $type = '2', $size = 36 ) {
		if ( $type == '1') {
		?>
		<div class="postMeta--author postMeta--author--1 o-media vcard author">
			<div class="postMeta--author-avatar o-media-left o-media--middle photo"><?php echo get_avatar( get_the_author_meta( 'ID' ), $size, '', esc_html__( 'avatar', 'bone' ) ); ?></div>
			<div class="postMeta--author-text o-media-body o-media--middle">
				<span class="postMeta--author-author metaFont fn"><?php the_author_posts_link(); ?></span><span class="middot">&middot;</span><span class="metaText metaDate"><abbr class="published updated" title="<?php the_time(get_option( 'date_format' )); ?>"><?php md_bone_human_datetime(); ?></abbr></span>	
			</div>
		</div>
		<?php
		} elseif ( $type == '2') {
		?>
		<div class="postMeta--author postMeta--author--2 o-media vcard author">
			<div class="postMeta--author-avatar o-media-left o-media--middle photo"><?php echo get_avatar( get_the_author_meta( 'ID' ), $size, '', esc_html__( 'avatar', 'bone' ) ); ?></div>
			<div class="postMeta--author-text o-media-body o-media--middle">
				<div class="postMeta--author-author metaFont fn"><?php the_author_posts_link(); ?></div>
				<span class="metaText metaDate"><abbr class="published updated" title="<?php the_time(get_option( 'date_format' )); ?>"><?php md_bone_human_datetime(); ?></abbr></span>	
			</div>
		</div>
		<?php
		} elseif ( $type == '3') {
		?>
		<div class="postMeta--author postMeta--author--3 o-media vcard author">
			<div class="postMeta--author-avatar o-media-left o-media--middle photo"><?php echo get_avatar( get_the_author_meta( 'ID' ), $size, '', esc_html__( 'avatar', 'bone' ) ); ?></div>
			<div class="postMeta--author-text o-media-body o-media--middle">
				<div class="postMeta--author-author metaFont fn"><?php the_author_posts_link(); ?></div>
			</div>
		</div>
		<?php
		} else {
		?>
		<div class="postMeta--author postMeta--author--4 o-media vcard author">
			<div class="postMeta--author-avatar o-media-left o-media--middle photo"><?php echo get_avatar( get_the_author_meta( 'ID' ), $size, '', esc_html__( 'avatar', 'bone' ) ); ?></div>
			<div class="postMeta--author-text o-media-body o-media--middle">
				<span class="metaText--sub"><?php esc_html_e('by', 'bone'); ?></span>
				<div class="postMeta--author-author metaFont fn">
					<?php the_author_posts_link(); ?>
				</div>
			</div>
		</div>
		<?php
		}
	}
}

/**
 * Display post info
 */
if ( !function_exists('md_bone_post_meta') ){
	function md_bone_post_meta( $type = '1' ) {
		switch ( $type ) {
			case '1':
			?>
				<div class="postMeta postMeta--1 clearfix">
					<div class="u-floatLeft">
						<?php md_bone_post_meta_author('2', 32); ?>
					</div>
					
					<div class="u-floatRight">
						<?php echo md_bone_post_meta_btn('1'); ?>
					</div>
				</div>
			<?php
				break;

			case '2':
				if ( !function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) )
					break;
			?>
				<div class="postMeta postMeta--2 clearfix">
					<div class="flexbox">
						<div class="flexbox-item">
							<?php
							if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) )
								ADDTOANY_SHARE_SAVE_KIT(); ?>
						</div>
						<div class="flexbox-item">
							<?php
							$link_title = '';
							if ( get_comments_number() != '0' ) {
								$link_title = sprintf( _nx( '%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'bone' ),	number_format_i18n( get_comments_number() ) );
							} else {
								$link_title = esc_html__('Comment', 'bone');
							} ?>
							<a href="<?php comments_link(); ?>" title="<?php echo esc_attr($link_title); ?>" class="metaFont commentCountBox">
								<?php echo get_comments_number(); ?>
							</a>
						</div>
					</div>
				</div>
			<?php
				break;

			case '3':
			?>
				<div class="postMeta postMeta--3 flexbox">
					<div class="flexbox-item">
						<?php md_bone_post_meta_author('4', 32); ?>
					</div>
					<div class="flexbox-item">
						<div>
							<span class="metaText--sub"><?php esc_html_e('posted on', 'bone'); ?></span>
							<div class="metaFont metaDate"><abbr class="published updated" title="<?php the_time(get_option( 'date_format' )); ?>"><?php echo get_the_date(); ?></abbr></div>	
						</div>
					</div>
					<div class="flexbox-item">
						<?php
						$link_title = '';
						if ( get_comments_number() != '0' ) {
							$link_title = sprintf( _nx( '%1$s comment', '%1$s comments', get_comments_number(), 'comments title', 'bone' ),	number_format_i18n( get_comments_number() ) );
						} else {
							$link_title = esc_html__('Comment', 'bone');
						} ?>
						<a href="<?php comments_link(); ?>" title="<?php echo esc_attr($link_title); ?>" class="metaFont commentCountBox">
							<?php echo get_comments_number(); ?>
						</a>
					</div>
				</div>
			<?php
				break;

			case '4':
			default:
			?>
				<div class="postMeta postMeta--4 clearfix">
					<?php md_bone_post_meta_author('1', 24); ?>
					&middot;
					<a href="<?php comments_link(); ?>" class="metaFont">
						<i class="fa fa-comment"></i>
						<?php
						if ( get_comments_number() != '0' ) {
							printf( _nx( ' %1$s<span class="hidden-xs"> comment</span>', ' %1$s<span class="hidden-xs"> comments</span>', get_comments_number(), 'comments title', 'bone' ), number_format_i18n( get_comments_number() ) );
						} else {
							echo '<span class="hidden-xs"> '.__('Comment', 'bone').'</span>';
						} ?>
					</a>
				</div>
			<?php
				break;
		}
	}
}

/**
 * Display post format icon
 */
if ( !function_exists('md_bone_format_icon') ){
	function md_bone_format_icon(){
		$format = get_post_format();
		switch ($format) {
			case 'video':
				echo '<div class="postFormatIcon formatVideoIcon"><i class="fa fa-play"></i></div>';
				break;

			case 'image':
				echo '<div class="postFormatIcon formatImageIcon"><i class="fa fa-camera"></i></div>';
				break;

			case 'gallery':
				echo '<div class="postFormatIcon formatGalleryIcon"><i class="fa fa-picture-o"></i></div>';
				break;

			case 'audio':
				echo '<div class="postFormatIcon formatAudioIcon"><i class="fa fa-music"></i></div>';
				break;

			case 'quote':
				echo '<div class="postFormatIcon formatQuoteIcon"><i class="fa fa-quote-right"></i></div>';
				break;

			case 'link':
				echo '<div class="postFormatIcon formatLinkIcon"><i class="fa fa-link"></i></div>';
				break;
			
			default:
				break;
		}
	}
}

/**
 * Display post format badge
 */
if ( !function_exists('md_bone_format_badge') ){
	function md_bone_format_badge(){
		$format = get_post_format();
		switch ($format) {
			case 'video':
				echo '<div class="postFormatBadge formatVideoIcon"><i class="fa fa-play-circle"></i></div>';
				break;

			case 'image':
				echo '<div class="postFormatBadge formatImageIcon"><i class="fa fa-camera"></i></div>';
				break;

			case 'gallery':
				echo '<div class="postFormatBadge formatGalleryIcon"><i class="fa fa-picture-o"></i></div>';
				break;

			case 'audio':
				echo '<div class="postFormatBadge formatAudioIcon"><i class="fa fa-music"></i></div>';
				break;

			case 'quote':
				echo '<div class="postFormatBadge formatQuoteIcon"><i class="fa fa-quote-right"></i></div>';
				break;

			case 'link':
				echo '<div class="postFormatBadge formatLinkIcon"><i class="fa fa-link"></i></div>';
				break;
			
			default:
				break;
		}
	}
}

/**
 * Display post categories
 */
if ( !function_exists('md_bone_post_categories') ){
	function md_bone_post_categories($post_id = NULL) {
		$categories = get_the_category( $post_id );
		
		if ( $categories ) {
			$categories = array_slice($categories, 0, 4);
			echo '<ul class="postCategories list-inline">';
			foreach ( $categories as $category ) {
				echo '<li>';
					echo '<a class="postCategory" href="'.get_category_link( $category->term_id ).'" title="'.esc_attr( sprintf( esc_html__( "View all posts in %s", 'bone' ), $category->name ) ) . '" rel="tag">'.$category->cat_name.'</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}
}

/**
 * Display first post category
 */
if ( !function_exists('md_bone_post_category') ){
	function md_bone_post_category($post_id = NULL) {
		$category_array = get_the_category($post_id);
		$category_link = NULL;
		if ( $category_array ) {
			$category_id = $category_array[0]->term_id;
			$category_name = esc_attr( $category_array[0]->name );
			$category_link = esc_url( get_category_link( $category_id ) );
		}
		
		if ( $category_link ) {
			echo '<a href="'.$category_link.'" title="'.esc_html__('View all posts in', 'bone').' '.$category_name.'" rel="tag" class="postCategory">'.$category_name.'</a>';
		}
	}
}

/**
 * Display post tags
 */
if ( !function_exists('md_bone_post_tags') ){
	function md_bone_post_tags($post_id = NULL) {
		$tags = get_the_tags( $post_id );
		if ( $tags ) {
			$tags = array_slice($tags, 0, 8);
			$output = '<div class="postTags postMeta">';
			$output .= '<div class="postTags-list">';
			foreach ( $tags as $tag ) {
					$output .= '<a class="postTag metaFont" href="'.get_tag_link( $tag->term_id ).'" title="'.esc_attr( sprintf( esc_html__( "View all posts in %s", 'bone' ), $tag->name ) ) . '" rel="tag">'.$tag->name.'</a>';
			}
			$output .= '</div>';
			$output .= '</div>';
		} else {
			$output = false;
		}

		return $output;
	}
}

/**
 * Post pagination
 */
if ( !function_exists('md_bone_post_pagination') ){
	function md_bone_post_pagination() {
		wp_link_pages( array(
			'before'      => '<div class="postPagination metaFont"><span class="postPagination-title">' . esc_html__( 'Pages:', 'bone' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="sr-only">' . esc_html__( 'Page', 'bone' ) . ' </span>%',
			'separator'   => '<span class="sr-only">, </span>',
		) );
	}
}

/**
 * Get pagination base on type
 */
if ( !function_exists('md_bone_get_pagination') ){
	function md_bone_get_pagination( $pagination_type = '1' ) {
		global $wp_query;
		switch ( $pagination_type ) {
			case '1':
			default:
				md_bone_pagination( $wp_query );
				break;
			case '2':
				md_bone_pagination_compact();
				break;
			case '3':
				echo '<div class="loadMoreBtn clearfix metaFont js-ajax-loadmore is-active"><span>'.esc_html__('Load more', 'bone').'</span><i class="fa fa-refresh"></i></div>';
				break;
			case '4':
				echo '<div class="loadMoreBtn clearfix metaFont js-ajax-infinity-scroll is-active"><span>'.esc_html__('Load more', 'bone').'</span><i class="fa fa-refresh"></i></div>';
				break;
		}
	}
}

/**
 * Site pagination: compact type
 */
if ( !function_exists('md_bone_pagination_compact') ){
	function md_bone_pagination_compact() {
		?>
		<div class="pagePagination pagePagination--compact metaFont clearfix">
			<div class="newerPosts"><?php previous_posts_link( '&laquo;&nbsp;'.esc_html__('Newer Posts', 'bone') ); ?></div>
			<div class="olderPosts"><?php next_posts_link( esc_html__('Older Posts', 'bone').'&nbsp;&raquo;' ); ?></div>
		</div>
		<?php
	}
}

/**
 * Site pagination: standard type
 */
if ( !function_exists('md_bone_pagination') ){
	function md_bone_pagination( $query ){  
		if ( $query->max_num_pages > 1 ) {
			echo '<div class="pagePagination metaFont">';
			echo '<div class="pagePagination-wrap">';
			$query->query_vars['paged'] > 1 ? $current = $query->query_vars['paged'] : $current = 1;
			$big = 999999999;
			$pagination = array(
				'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format' => '?paged=%#%',
				'total' => $query->max_num_pages,
				'current' => $current,
				'prev_text' => esc_html__( 'Previous', 'bone' ),
				'next_text' => esc_html__( 'Next', 'bone' ),
				'type' => 'plain'
			);
			echo paginate_links( $pagination );
			echo '</div>';
			echo '</div>';
		}
	}
}

/**
 * Get post single layout
 */
if ( !function_exists('md_bone_get_single_layout') ){
	function md_bone_get_single_layout() {
		$single_layout = md_bone_get_metabox( 'post-layout', 'default' );
		if ($single_layout == 'default') {
			$single_layout = md_bone_get_option('single-layout', 'standard');
		}
		$format = get_post_format();
		if ( (($format != '') && ($single_layout == 'billboard')) || ( (!has_post_thumbnail()) && ($single_layout == 'billboard') )) {
			$single_layout = 'standard';
		}

		if ( (($format != '') && ($single_layout == 'cover')) || ( (!has_post_thumbnail()) && ($single_layout == 'cover') )) {
			$single_layout = 'standard';
		}

		if ( (($format != '') && ($single_layout == 'billboard-fw')) || ( (!has_post_thumbnail()) && ($single_layout == 'billboard-fw') )) {
			$single_layout = 'top-wide-fw';
		}

		if (($format == '') && has_post_thumbnail()) {
			$thumb_id = get_post_thumbnail_id();
			$thumb_data = wp_get_attachment_image_src( $thumb_id, 'full' );
			$thumb_width = $thumb_data[1];
			$thumb_height = $thumb_data[2];
			if ($thumb_width > 0) {
				if (($thumb_width < 350) && (($thumb_height / $thumb_width) > 1.5)) {
					$single_layout = 'standard';
				}
			}
		}

		return $single_layout;
	}
}

/**
 * Post single schema meta
 */
if ( !function_exists('md_bone_single_schema_meta') ){
	function md_bone_single_schema_meta($post_id = '') {
		$review_switch = md_bone_get_metabox('review_switch', '0');
		if ($review_switch === '1') {
			if (function_exists('rwmb_meta')) {
				$review_scores = rwmb_meta( 'md_bone_review_score', $post_id );
				$review_totalscore = rwmb_meta( 'md_bone_review_totalscore', $post_id );
				$review_summary = md_bone_truncate(rwmb_meta( 'md_bone_review_summary', $post_id ), 180);
				$review_pros = rwmb_meta( 'md_bone_review_pros', $post_id );
				$review_cons = rwmb_meta( 'md_bone_review_cons', $post_id );
				$max_score = 10;
			} else {
				$review_switch = '0';
			}
		}
		
		$thumbnail_src = wp_get_attachment_image_src(get_post_thumbnail_id(), 'md_bone_md');
		$site_logo = md_bone_get_option('logo', NULL);
		$site_logo_url = '';
		if ( $site_logo !== NULL ) {
			if ( ( array_key_exists( 'url', $site_logo ) ) && ( $site_logo['url'] !== '' ) ) {
				$site_logo_url = $site_logo['url'];
			}
		}
		$author_name = get_the_author();
		$publisher_name = get_bloginfo('name');
		if (empty($publisher_name)){
			$publisher_name = $author_name;
		}
		$description = get_the_excerpt();

		if ($review_switch !== '1') { ?>
			<script type="application/ld+json">
				{
					"@context": "http://schema.org/",
					"@type": "BlogPosting",
					"mainEntityOfPage": {
						"@type": "WebPage",
						"@id": "<?php echo esc_url(get_permalink()); ?>"
					},
					"headline": "<?php echo esc_attr(get_the_title()); ?>",
					"image": [
						"<?php echo esc_url($thumbnail_src[0]); ?>"
					],
					"datePublished": "<?php echo get_the_time('c'); ?>",
					"dateModified": "<?php echo get_the_modified_time('c'); ?>",
					"author": {
						"@type": "Person",
						"name": "<?php echo esc_attr($author_name); ?>"
					},
					"publisher": {
						"@type": "Organization",
						"name": "<?php echo esc_attr($publisher_name); ?>",
						"logo": {
							"@type": "ImageObject",
							"url": "<?php echo esc_url($site_logo_url); ?>"
						}
					},
					"description": "<?php echo esc_html($description); ?>"
				}
			</script>
			<?php
			} else { ?>
			<script type="application/ld+json">
				{
					"@context": "http://schema.org/",
					"@type": "Review",
					"name": "<?php echo esc_attr(get_the_title()); ?>",
					"itemReviewed": {
						"@type": "Thing",
						"name": "<?php echo esc_attr(get_the_title()); ?>"
					},
					"datePublished": "<?php echo get_the_time('c'); ?>",
					"author": {
						"@type": "Person",
						"name": "<?php echo esc_attr($author_name); ?>"
					},
					"publisher": {
						"@type": "Organization",
						"name": "<?php echo esc_attr($publisher_name); ?>",
						"logo": {
							"@type": "ImageObject",
							"url": "<?php echo esc_url($site_logo_url); ?>"
						}
					},
					"description": "<?php echo esc_html($review_summary); ?>",
					"reviewBody": "<?php echo esc_html($review_summary); ?>",
					"reviewRating": {
						"@type": "Rating",
						"worstRating": "1",
						"bestRating": "<?php echo esc_attr($max_score); ?>",
						"ratingValue": "<?php echo esc_attr($review_totalscore); ?>"
					}
				}
			</script>
		<?php
		}
	}
}

/**
 * Display post single header
 */
if ( !function_exists('md_bone_single_header') ){
	function md_bone_single_header( $style = '' ) {
		switch ($style) {
			case 'wide': ?>
				<header class="postSingle-header postSingle-header--wide postSingle-header--big">
					<div class="container">
						<?php md_bone_post_categories(); ?>
						<h1 class="postTitle entry-title"><?php the_title(); ?></h1>
						<?php md_bone_post_meta('3'); ?>
					</div>
				</header>
				<?php
				break;

			case 'fullwidth': ?>
				<header class="postSingle-header postSingle-header--fullwidth postSingle-header--big">
					<h1 class="postTitle entry-title"><?php the_title(); ?></h1>
					<?php md_bone_post_meta('3'); ?>
                    <?php md_bone_post_categories(); ?>
				</header>
				<?php
				break;
			
			default: ?>
				<header class="postSingle-header">
					<h1 class="postTitle entry-title"><?php the_title(); ?></h1>
					<?php md_bone_post_meta('3'); ?>
                    <?php md_bone_post_categories(); ?>
				</header>
				<?php
				break;
		}
	}
}

/**
 * Display post single billboard
 */
if ( !function_exists('md_bone_single_billboard') ){
	function md_bone_single_billboard( $fw = false) {
		if ( !has_post_thumbnail() )
			return;

		$parallax = md_bone_get_option('parallax-switch', '1');
		$thumb_size = 'md_bone_cover'; ?>
		<div class="postSingle--billboard-cover<?php if ($parallax !== '1') echo ' is-parallaxDisabled'; ?>">
			<div id="md-single-cover" class="postSingle--billboard-cover-bgImg" <?php md_bone_inline_css_background_img($thumb_size); ?>></div>
			
			<div class="container">
				<div class="postInfo overlayInfo">
					<div id="md-billboard-info" class="postSingle-header postSingle-header--billboard postSingle-header--big">
						<?php md_bone_post_categories(); ?>
						<h1 class="postTitle entry-title"><?php the_title(); ?></h1>
						<?php md_bone_post_meta('3'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}

/**
 * Display post single cover
 */
if ( !function_exists('md_bone_single_cover') ){
	function md_bone_single_cover() {
		if ( !has_post_thumbnail() )
			return;

		$thumb_size = 'md_bone_xxl';
		?>
		<div class="postSingle-cover">
			<div class="o-backgroundImg o-backgroundImg--dimmed" <?php md_bone_inline_css_background_img($thumb_size); ?>></div>
			<div class="postInfo overlayInfo">
				<div class="postSingle-header">
					<?php md_bone_post_categories(); ?>
					<h1 class="postTitle entry-title"><?php the_title(); ?></h1>
					<?php md_bone_post_meta('3'); ?>
				</div>
			</div>
		</div>
	<?php
	}
}

/**
 * Display post single footer
 */
if ( !function_exists('md_bone_single_footer') ){
	function md_bone_single_footer( $post_id = '' ) { 
		$sharingargs = array('title' => get_the_title(), 'description' => get_the_excerpt(), 'url' => get_permalink(), 'showmore' => true, 'style' => 'visible'); ?>
		
		<footer class="postFooter postFooter--single">
			<?php
			if (md_bone_post_tags($post_id)) { ?>
<!--				<div class="postFooter-tags">-->
<!--				--><?php //echo md_bone_post_tags($post_id); ?>
<!--				</div>-->
			<?php
			} ?>

			<?php
			if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ?>
				<div class="postFooter-share">
					<?php ADDTOANY_SHARE_SAVE_KIT(); ?>
				</div>
			<?php
			} ?>
		</footer>
	<?php }
}

/**
 * Display post review box
 */
if ( ! function_exists( 'md_bone_review_score' ) ) {  
	 function md_bone_review_score() {
		if ( !function_exists('rwmb_meta') )
			return;
		
		$post_id = get_the_id();
		$review_switch = rwmb_meta( 'md_bone_review_switch', $post_id );
		if ( $review_switch != '1' ) return;
		$review_scores = rwmb_meta( 'md_bone_review_score', $post_id );
		$review_totalscore = rwmb_meta( 'md_bone_review_totalscore', $post_id );
		$review_summary = rwmb_meta( 'md_bone_review_summary', $post_id );
		$review_pros = rwmb_meta( 'md_bone_review_pros', $post_id );
		$review_cons = rwmb_meta( 'md_bone_review_cons', $post_id );
		$max_score = 10;?>
		<div class="reviewBox">
			<div class="reviewBox-breakdown">
				<h5><?php esc_html_e('The breakdown', 'bone'); ?></h5>
				<?php if ( ($review_summary != '') && ((!empty($review_pros)) || (!empty($review_cons))) ) { ?>
				<p class="blurb"><?php echo esc_html($review_summary); ?></p>
				<?php } ?>
				<div class="reviewMeter">
		<?php 
		foreach ($review_scores as $review_score) {
			if ( isset( $review_score['criteria_name'] ) && isset( $review_score['criteria_score'] ) ) { ?>
 					<div class="reviewMeter-item clearfix">
						<h5 class="reviewMeter-item-name titleFont"><?php echo esc_html($review_score['criteria_name']); ?></h5>
						<div class="reviewMeter-item-score metaFont"><?php echo esc_html($review_score['criteria_score']).'/'.$max_score; ?></div>
						<div class="progressContainer">
							<div class="progressContainer-bar" style="width:<?php echo (intval($review_score['criteria_score'])*100/$max_score); ?>%"></div>
						</div>
					</div>
				<?php
			}
		} ?>
				</div>
			</div>
			<div class="reviewBox-summary clearfix">
				<div class="reviewBox-summary-totalScore metaFont">
					<div class="reviewBox-summary-totalScore-wrap">
						<div><?php echo esc_html($review_totalscore); ?></div>
						<span><?php esc_html_e('Total score', 'bone'); ?></span>
					</div>
				</div>

				<?php if ( (!empty($review_pros)) || (!empty($review_cons)) ) { ?>
				<div class="reviewBox-summary-prosNCons clearfix">
					
					<?php if ( !empty($review_pros) ) { ?>
					<div class="reviewBox-summary-proList">
						<h5 class="titleFont"><?php esc_html_e('Good', 'bone'); ?></h5>
						<ul>
							<?php foreach ($review_pros as $value) { ?>
							<li><i class="fa fa-plus-square"></i><?php echo esc_html($value); ?></li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
					
					<?php if ( !empty($review_cons) ) { ?>
					<div class="reviewBox-summary-conList">
						<h5 class="titleFont"><?php esc_html_e('Bad', 'bone'); ?></h5>
						<ul>
							<?php foreach ($review_cons as $value) { ?>
							<li><i class="fa fa-minus-square"></i><?php echo esc_html($value); ?></li>
							<?php } ?>
						</ul>
					</div>
					<?php } ?>
					
				</div>
				
				<?php } elseif ( $review_summary != '' ) { ?>
				<div class="reviewBox-summary-blurb">
					<p class="blurb"><?php echo esc_html($review_summary); ?></p>	
				</div>
				<?php } ?>
				
			</div>
		</div>
		<?php
	}
}

/**
 * Get related posts
 */
function md_bone_get_related_posts( $post_id, $related_count, $args = array() ) {
	$orderby = md_bone_get_option('related-post-order', 'rand');
	$args = wp_parse_args( (array) $args, array(
		'orderby' => $orderby,
		'return'  => 'query', // Valid values are: 'query' (WP_Query object), 'array' (the arguments array)
	) );

	$post_navigation = md_bone_get_option('postnav-switch', '1');
	if ((is_single()) && ($post_navigation === '1')) {
		$next_post = get_next_post();
		$next_post_ID = (property_exists($next_post, 'ID')) ? $next_post->ID : 0;
		$prev_post = get_previous_post();
		$prev_post_ID = (property_exists($prev_post, 'ID')) ? $prev_post->ID : 0;
	} else {
		$next_post_ID = 0;
		$prev_post_ID = 0;
	}
 
	$related_args = array(
		'post_type'      => get_post_type( $post_id ),
		'posts_per_page' => $related_count,
		'post_status'    => 'publish',
		'post__not_in'   => array( $post_id, $next_post_ID, $prev_post_ID ),
		'orderby'        => $args['orderby'],
		'tax_query'      => array(),
	);
 
	$post       = get_post( $post_id );
	$taxonomies = get_object_taxonomies( $post, 'names' );
 
	foreach( $taxonomies as $taxonomy ) {
		if (($taxonomy === 'tag') || ($taxonomy === 'category')) {
			$terms = get_the_terms( $post_id, $taxonomy );
			if ( empty( $terms ) ) continue;
			$term_list = wp_list_pluck( $terms, 'slug' );
			$related_args['tax_query'][] = array(
				'taxonomy' => $taxonomy,
				'field'    => 'slug',
				'terms'    => $term_list
			);
		}
	}
 
	if( count( $related_args['tax_query'] ) > 1 ) {
		$related_args['tax_query']['relation'] = 'OR';
	}

	if( $args['return'] == 'query' ) {
		return new WP_Query( $related_args );
	} else {
		return $related_args;
	}
}

/**
 * Comment layout
 */
if ( ! function_exists( 'md_bone_comment' ) ) {
	function md_bone_comment($comment, $args, $depth){
		$post = get_post(get_the_ID());
		
		switch ($comment->comment_type):
			case 'pingback':
			case 'trackback':
			?>
			
			<li class="post pingback">
				<p><?php esc_html_e('Pingback:', 'bone'); ?> <?php comment_author_link(); ?><?php if (current_user_can('edit_comment', $comment->comment_ID)) {edit_comment_link(esc_html__('Edit', 'bone'), '<span class="edit-link">', '</span>'); } ?></p>
			<?php
				break;

			default:
			?>
		
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
				<article id="comment-<?php comment_ID(); ?>" class="comment">
				
					<div class="comment-header flexbox">

						<div class="comment-avatar flexbox-item">
						<?php
							echo get_avatar($comment, 40);
						?>
						</div>

						<div class="comment-meta flexbox-item">					
							<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>" class="comment-author titleFont">
								<?php comment_author(); ?>
								<?php if ( $comment->user_id === $post->post_author ) { ?>
								<span class="comment-bypostauthor-badge"><i class="fa fa-user"></i><?php esc_html_e('Author', 'bone'); ?></span>
								<?php } ?>
							</a>
							<a href="<?php comment_link(); ?>" class="comment-time metaText" title="<?php comment_date(); esc_html_e(' at ', 'bone'); comment_time(); ?>">
								<time datetime="<?php comment_time( 'c' ); ?>">
									<?php
										/* translators: 1: comment date, 2: comment time */
										printf( esc_html__( '%1$s at %2$s', 'bone' ), get_comment_date( '', $comment ), get_comment_time() );
									?>
								</time>
							</a>
						</div> <!-- .comment-meta -->

					</div>
		
					<div class="comment-content bodyCopy">
						<?php comment_text(); ?>
						
						<?php if ($comment->comment_approved == '0'): ?>
							<em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'bone'); ?></em>
						<?php endif; ?>
					</div>

					<div class="comment-actions">
						<?php
						comment_reply_link(array_merge($args, array(
							'reply_text' => '<span class="metaBtn"><i class="fa fa-reply"></i>'.esc_html__( 'Reply', 'bone').'</span>',
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						))); 
						?>

						<?php if (current_user_can('edit_comment', $comment->comment_ID)): ?>
							<a href="<?php echo get_edit_comment_link(); ?>" class="comment-edit-link metaBtn"><i class="fa fa-pencil"></i><?php esc_html_e( 'Edit', 'bone' ); ?></a>
						<?php endif; ?>
					</div><!-- .reply -->

				</article><!-- #comment-N -->
	
				<?php
				break;
		endswitch;
		
	}
}

/**
 * Display navigation to next/previous comments when applicable.
 */
if ( ! function_exists( 'md_bone_comment_nav' ) ){
	function md_bone_comment_nav() {
		// Are there comments to navigate through?
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav class="navigation comment-navigation">
			<h4 class="sr-only"><?php esc_html_e( 'Comment navigation', 'bone' ); ?></h4>
			<div class="nav-links clearfix">
				<?php
					if ( $prev_link = get_previous_comments_link( esc_html__( 'Older Comments', 'bone' ) ) ) :
						printf( '<div class="nav-previous"><i class="fa fa-chevron-left"></i>&nbsp;%s</div>', $prev_link );
					endif;

					if ( $next_link = get_next_comments_link( esc_html__( 'Newer Comments', 'bone' ) ) ) :
						printf( '<div class="nav-next">%s&nbsp;<i class="fa fa-chevron-right"></i></div>', $next_link );
					endif;
				?>
			</div><!-- .nav-links -->
		</nav><!-- .comment-navigation -->
		<?php
		endif;
	}
}

/**
 * AJAX function to load more post
 */
if ( !function_exists('md_bone_ajax_load_post') ){
	function md_bone_ajax_load_post() {
		$pagination_type = md_bone_get_option('pagination-type', '1');
		if ( ($pagination_type !== '3') && ($pagination_type !== '4')) {
			return;
		}

		$layout_opt = md_bone_get_layout_opt();
		$loaded_post_count = $_POST['loadedPostsCount'];
		$post_pos = $loaded_post_count + 1;

		$query_vars = $_POST['query_vars'];
		$query_vars['paged'] = $_POST['page'];
		$posts = new WP_Query( $query_vars );

		if( $posts->have_posts() ) { 
			while ( $posts->have_posts() ) { 
				$posts->the_post();
				md_bone_get_template( $layout_opt['content-layout'], $post_pos );
				if (isset($loaded_post_count)) {
					$loaded_post_count++;
					$post_pos = $loaded_post_count + 1;
				}
			}
		}

		die();
	}
}
add_action( 'wp_ajax_nopriv_ajax_load_post', 'md_bone_ajax_load_post' );
add_action( 'wp_ajax_ajax_load_post', 'md_bone_ajax_load_post' );

/**
 * Auto set video thumbnail as featured image
 */
if ( ! function_exists( 'md_bone_auto_set_featured_image') ) {
	function md_bone_auto_set_featured_image($post_id) {
		$format = get_post_format( $post_id );

		if ($format == 'video') { 			// Format video
			$url = md_bone_get_metabox( 'format_video_url', '', $post_id );
			if(!has_post_thumbnail($post_id) && ( $url != '')) { 
				require_once ABSPATH . 'wp-includes/class-oembed.php';
				$oembed = new WP_oEmbed();
				$url_parse = parse_url($url);
				$provider = $oembed->discover($url);
				$video = $oembed->fetch($provider, $url, array('width' => 820, 'height' => 460));
				$thumb = $video->thumbnail_url;

				if ($thumb) {
					media_sideload_image($thumb, $post_id, 'thumbnail image.');
				
					// find the most recent attachment for the given post
					$attachments = get_posts(
						array(
							'post_type' => 'attachment',
							'numberposts' => 1,
							'order' => 'DESC',
							'post_parent' => $post_id
						)
					);
					$attachment = $attachments[0];    
					// and set it as the post thumbnail
					set_post_thumbnail( $post_id, $attachment->ID );
				} else {
					return;
				}
			}
		} elseif ($format == 'audio') { 			// Format audio
			$url = md_bone_get_metabox( 'format_audio_url', '', $post_id );
			if (!has_post_thumbnail($post_id) && ( $url != '')) {
				require_once ABSPATH . 'wp-includes/class-oembed.php';
				$oembed= new WP_oEmbed();
				$provider = $oembed->discover($url);
				$data = $oembed->fetch($provider, $url, array('width' => 820, 'height' => 460));
				$thumb = $data->thumbnail_url;

				if($thumb) {
					media_sideload_image($thumb, $post_id, 'thumbnail image.');
				
					// find the most recent attachment for the given post
					$attachments = get_posts(
						array(
							'post_type' => 'attachment',
							'numberposts' => 1,
							'order' => 'DESC',
							'post_parent' => $post_id
						)
					);
					$attachment = $attachments[0];    
					// and set it as the post thumbnail
					set_post_thumbnail( $post_id, $attachment->ID );
				}else{
					return;
				}
			}
		} elseif ($format == 'image') {		// Format image
			if(!has_post_thumbnail($post_id)) {
				$image_url = '';
				if ( function_exists('rwmb_meta') ) {
					$prefix = 'md_bone_';
					$images = rwmb_meta( $prefix.'format_image_file', 'type=image&size=full' );
					if (!empty($images)) {
						$image = reset($images);
						$image_url = $image['full_url'];
					}
				}
				if($image_url) {
					media_sideload_image($image_url, $post_id, 'thumbnail image.');
				
					// find the most recent attachment for the given post
					$attachments = get_posts(
						array(
							'post_type' => 'attachment',
							'numberposts' => 1,
							'order' => 'DESC',
							'post_parent' => $post_id
						)
					);
					$attachment = $attachments[0];    
					// and set it as the post thumbnail
					set_post_thumbnail( $post_id, $attachment->ID );
				}else{
					return;
				}
			}
		} elseif($format == 'gallery'){		// Format gallery
			if(!has_post_thumbnail($post_id)) {
				$image_url = '';
				if ( function_exists('rwmb_meta') ) {
					$prefix = 'md_bone_';
					$gallery_files = rwmb_meta( $prefix.'format_gallery_files', 'type=image&size=full' );
					if (!empty($gallery_files)) {
						$image = reset($gallery_files);
						$image_url = $image['url'];
					}
				}
				if($image_url) {
					media_sideload_image($image_url, $post_id, 'thumbnail image.');
				
					// find the most recent attachment for the given post
					$attachments = get_posts(
						array(
							'post_type' => 'attachment',
							'numberposts' => 1,
							'order' => 'DESC',
							'post_parent' => $post_id
						)
					);
					$attachment = $attachments[0];    
					// and set it as the post thumbnail
					set_post_thumbnail( $post_id, $attachment->ID );
				}else{
					return;
				}
			}
		}
	}
}
add_action('save_post', 'md_bone_auto_set_featured_image', 100);


/**
 * Avoid duplicate posts on homepage
 */

if ( ! class_exists( 'MDBONE_avoidDuplicatePosts') ) {
	class MDBONE_avoidDuplicatePosts {
		public static $featured_posts = array();
		protected static $md_bone_no_duplicate_posts = array();

		function __construct() {		
			self::md_bone_get_featured_posts();
			add_action('parse_query', array( $this, 'md_bone_exclude_duplicates' ));
			add_filter('the_posts', array( $this, 'md_bone_log_posts'), 10, 2 );
			add_action('pre_get_posts', array( $this, 'md_bone_exclude_featured'));
		}

		
		function md_bone_exclude_duplicates( &$query ) {
			if (!is_home()) return;
			$disable_now = $query->get('md_bone_duplicate_disable'); // use 'md_bone_duplicate_disable' to prevent exclusion
			if (empty($query->post__not_in) && empty($disable_now)) {
				$query->set('post__not_in', self::$md_bone_no_duplicate_posts);
			}
		}

		function md_bone_log_posts( $posts, $query ) {
			if (!is_home()) return $posts;
			foreach ($posts as $i => $post) {
				self::$md_bone_no_duplicate_posts[] = $post->ID;
			}
			return $posts;
		}

		function md_bone_get_featured_posts() {
			if (current_user_can('read_private_posts')) {
				$post_status = array('publish', 'private');
			} else {
				$post_status = 'publish';
			}

			$featured_method = md_bone_get_option('feat-get-post-method', '');
			$posts_per_page = 4;
			$feat_layout = md_bone_get_option('feat-layout', 'alt');
			switch ($feat_layout) {
				case 'tiles':
					$posts_per_page = 6;
					break;

				case 'alt':
					$posts_per_page = 5;
					break;
				
				default:
					$posts_per_page = md_bone_get_option('feat-post-quantity', 5);
					break;
			}

			switch ($featured_method) {
				case 'by-tag':
					$tag_in = md_bone_get_option('feat-tag-select', array());
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'tag__in'   => $tag_in,
						'md_bone_duplicate_disable' => true,
					);
					$featured_posts_object = get_posts($args);
					self::$featured_posts = wp_list_pluck( $featured_posts_object, 'ID' );
					break;

				case 'by-category':
					$category_in = md_bone_get_option('feat-cat-select', array());
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'category__in'   => $category_in,
						'md_bone_duplicate_disable' => true,
					);
					$featured_posts_object = get_posts($args);
					self::$featured_posts = wp_list_pluck( $featured_posts_object, 'ID' );
					break;

				case 'by-marked':
					$prefix = 'md_bone_';
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'meta_key'   => $prefix.'post_featured',
						'meta_value' => '1',
						'md_bone_duplicate_disable' => true,
					);
					$featured_posts_object = get_posts($args);
					self::$featured_posts = wp_list_pluck( $featured_posts_object, 'ID' );
					break;

				case 'by-latest':
					$args = array(
						'post_status' => $post_status,
						'posts_per_page'      => $posts_per_page,
						'ignore_sticky_posts' => 1,
						'orderby'   => 'date',
						'md_bone_duplicate_disable' => true,
					);
					$featured_posts_object = get_posts($args);
					self::$featured_posts = wp_list_pluck( $featured_posts_object, 'ID' );
					break;
				
				default:
					self::$featured_posts = md_bone_get_option('feat-post-select', array());
					break;
			}
		}
		
		function md_bone_exclude_featured( $query ) {
			if ( $query->is_home() && $query->is_main_query() ) {
				$query->set( 'post__not_in', self::$featured_posts );
			}
		}
	}
}

if ( ! function_exists( 'md_bone_avoid_duplicate_posts_init') ) {
	function md_bone_avoid_duplicate_posts_init() {
		$no_duplicate_switch = md_bone_get_option('no-duplicate-posts-switch', '0');
		if (($no_duplicate_switch !== '1') && (!is_home()))
			return;
		$md_bone_avoid_duplicate_posts = new MDBONE_avoidDuplicatePosts();
	}
}

add_action( 'after_setup_theme', 'md_bone_avoid_duplicate_posts_init' );

/**
 * Add js class for zoom on image blocks that has zoom switch set to on.
 */

function md_bone_image_block_add_zoom_props( $block_content, $block ) {
	if ( $block['blockName'] === 'core/image' ) {
		// Build DOM for class manipulation.
		$dom = new DOMDocument;
		libxml_use_internal_errors( true );
		$dom->loadHTML( $block_content );
		libxml_use_internal_errors( false );
		$dom->preserveWhiteSpace = false;
		$finder = new DomXPath( $dom );
		$nodeList = $finder->query("//*[contains(@class, 'wp-block-image')]"); // Find element with wp-block-image class.

		if ( !empty( $nodeList ) ) {
			$block_dom = $nodeList->item(0);
		} else {
			$block_dom = null;
		}

	    if ( ( array_key_exists( 'mdZoom', $block['attrs'] ) ) && $block_dom ) {
	    	if ( $block['attrs']['mdZoom'] ) {
	    		// Add js-imageZoom class to block.
	    		$block_dom->setAttribute( 'class', $block_dom->getAttribute( 'class' ) . ' js-imageZoom' );
	    	} else {
	    		// Remove js-imageZoom class from block.
	    		if ( $block_dom->hasAttribute('class') && strstr( $block_dom->getAttribute('class'), 'js-imageZoom') ) {
	    			$block_dom->setAttribute( 'class', str_replace( 'js-imageZoom', '', $block_dom->getAttribute( 'class' ) ) );
	    		}
	    	}
	    }

		return $dom->saveHTML();
	}

	return $block_content;
}

// add_filter( 'render_block', 'md_bone_image_block_add_zoom_props', 10, 2 );