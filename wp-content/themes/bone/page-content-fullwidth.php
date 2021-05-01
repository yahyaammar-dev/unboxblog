<?php
/**
 * Template Name: Bone Fullwidth Content
 *
 * This is the fullwidth content template.
 */
$sidebar_position = md_bone_get_metabox( 'page-sidebar-position', 'default' );
if ($sidebar_position === 'default') {
	$sidebar_position = md_bone_get_option('page-sidebar-position', 'right');
}

$hide_page_title = md_bone_get_metabox( 'hide-page-title', '0' );
$page_title_style = md_bone_get_metabox( 'page-title-style', 'boxed' );
$sticky_sidebar = md_bone_get_option('sticky-sidebar', '1');
$main_classes = '';
$sidebar_classes = '';

if($sidebar_position === 'right') {
	$main_classes .= ' hasRightSidebar';
	$sidebar_classes .= ' sidebar--right';
} else {
	$main_classes .= ' hasLeftSidebar';
	$sidebar_classes .= ' sidebar--left';
}

if($sticky_sidebar) {
	$sidebar_classes .= ' js-sticky-sidebar';
}

if ($sidebar_position === 'none') {
	$post_classes = array(
		'pageTemplate',
		'pageTemplate--fullwidthContent',
		'pageTemplate--fullwidth',
	);
} else {
	$post_classes = array(
		'pageTemplate',
		'pageTemplate--fullwidthContent',
	);
}

if ( has_post_thumbnail() ) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'md_bone_cover', true );
	$thumb_url = $thumb_url_array[0];
} else {
	$thumb_url = '';
}
get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
<main class="layoutBody">
	<article <?php post_class($post_classes); ?>>
		<?php md_bone_single_schema_meta(); ?>
		<?php if (get_the_title() && ( $hide_page_title !== '1' )) { ?>
			<div class="pageHeading pageHeading--fw<?php if ($page_title_style === 'boxed') { echo ' pageHeading--boxed'; if ($thumb_url != '') { echo ' hasBgImg'; } } ?>">
				<div class="container">
					<?php if (($thumb_url !== '') && ($page_title_style === 'boxed')) { ?>
					<div class="o-backgroundImg" <?php echo 'style="background-image: url('.esc_url($thumb_url).')"'; ?>></div>
					<?php } ?>
					<h1 itemprop="name" class="pageHeading-title titleFont"><?php the_title(); ?></h1>
				</div>
			</div>
		<?php } ?>

	<?php if ( $sidebar_position === 'none' ) { ?>
		<div class="container">
			<div class="layoutContent clearfix">
				<div class="postContent postContent--fullwidth bodyCopy clearfix">
					<?php the_content(); ?>
				</div>

				<div class="contentWrap">
					<?php md_bone_post_pagination(); ?>

					<?php md_bone_review_score(); ?>
				</div>

				<?php
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			</div>
		</div>
	<?php } else { ?>
		<div class="container">
			<div class="layoutContent clearfix">
				<div class="layoutContent-main<?php echo esc_attr($main_classes); ?>">
					<div class="postContent bodyCopy clearfix">
						<?php the_content(); ?>
					</div>

					<?php md_bone_post_pagination(); ?>

					<?php md_bone_review_score(); ?>

					<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				</div><!-- end layoutContent-main -->

				<aside id="mdSidebar" class="layoutContent-sidebar sidebar<?php echo esc_attr($sidebar_classes); ?>">
					<?php get_sidebar(); ?>
				</aside>

			</div><!-- end layoutContent -->
		</div><!-- end container -->
	<?php } ?>

	</article>
</main>
<?php endif; ?>

<?php if (is_active_sidebar('adsidebar-2')) { ?>
	<div class="adSidebar adSidebar--2">
		<div class="container">
			<?php dynamic_sidebar('adsidebar-2'); ?>
		</div>
	</div>
<?php } ?>

<?php get_footer();