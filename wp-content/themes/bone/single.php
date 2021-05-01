<?php
$article_schema_type = '';
$article_body_schema = '';

$single_layout = md_bone_get_single_layout();
$sidebar_position = md_bone_get_metabox( 'post-sidebar-position', 'default' );
if ($sidebar_position == 'default') {
	$sidebar_position = md_bone_get_option('single-sidebar-position', 'right');
}
$review_switch = md_bone_get_metabox( 'review_switch', '0' );
if ($review_switch == '1') {
    $article_schema_type = 'http://schema.org/Review';
    $article_body_schema = 'reviewBody';
} else {
    $article_schema_type = 'http://schema.org/BlogPosting';
    $article_body_schema = 'articleBody';
}
$sticky_sidebar = md_bone_get_option('sticky-sidebar', '1');
$main_classes = '';
$sidebar_classes = '';
if($sidebar_position == 'right') {
	$main_classes .= ' hasRightSidebar';
	$sidebar_classes .= ' sidebar--right';
} elseif($sidebar_position == 'left') {
	$main_classes .= ' hasLeftSidebar';
	$sidebar_classes .= ' sidebar--left';
}
if($sticky_sidebar) {
	$sidebar_classes .= ' js-sticky-sidebar';
}

set_query_var('article_schema_type', $article_schema_type);
set_query_var('article_body_schema', $article_body_schema);
set_query_var('main_classes', $main_classes);
set_query_var('sidebar_classes', $sidebar_classes);
set_query_var('article_schema_type', $article_schema_type);

if (file_exists( get_template_directory() . '/templates/single-'.$single_layout.'.php')) {
	get_template_part( 'templates/single-'.$single_layout );
} else {
	get_template_part( 'templates/single-standard' );
}