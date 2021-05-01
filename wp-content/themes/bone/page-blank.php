<?php
/**
 * Template Name: Bone Blank Page
 *
 * This is the blank template for using with page builder.
 */
$hide_page_title = md_bone_get_metabox( 'hide-page-title', '0' );
$page_title_style = md_bone_get_metabox( 'page-title-style', 'boxed' );
$main_classes = '';

$post_classes = array(
	'pageTemplate',
	'pageTemplate--fullwidth',
	'pageTemplate--blank',
);

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

		<div class="postContent postContent--fullwidth clearfix">
			<?php the_content(); ?>
		</div>
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