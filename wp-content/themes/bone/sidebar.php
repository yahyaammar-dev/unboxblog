<?php
$sticky_sidebar = md_bone_get_option('sticky-sidebar', '1');
if ($sticky_sidebar == '1') {
	echo '<div class="theiaStickySidebar">';
}

if (is_front_page()) {
	if (is_active_sidebar('home-sidebar')) {
		dynamic_sidebar('home-sidebar');
	} elseif (is_active_sidebar('default-sidebar')) {
		dynamic_sidebar('default-sidebar');
	} elseif ( current_user_can('administrator') ) {
		echo '<p style="padding: 20px;background-color:#f5f5f5;">'.esc_html__('Place widgets on Home Sidebar to make them appear here', 'bone').'</p>';
	}
} elseif (is_single()) {
	if (is_active_sidebar('single-sidebar')) {
		dynamic_sidebar('single-sidebar');
	} elseif (is_active_sidebar('default-sidebar')) {
		dynamic_sidebar('default-sidebar');
	} elseif ( current_user_can('administrator') ) {
		echo '<p style="padding: 20px;background-color:#f5f5f5;">'.esc_html__('Place widgets on Single Sidebar to make them appear here', 'bone').'</p>';
	}
} else {
	if (is_active_sidebar('default-sidebar')) {
		dynamic_sidebar('default-sidebar');
	} elseif ( current_user_can('administrator') ) {
		echo '<p style="padding: 20px;background-color:#f5f5f5;">'.esc_html__('Place widgets on Default Sidebar to make them appear here', 'bone').'</p>';
	}
}

if ($sticky_sidebar == '1') {
	echo '</div>';
}