<?php
$post_classes = array(
	'postSingle',
	'postSingle--headerTop',
	'hentry',
);
$format = md_bone_get_post_format();
get_header(); ?>

<?php if (have_posts()) : the_post(); ?>
<main class="layoutBody<?php if (!has_post_thumbnail()) echo ' noThumb'; ?>">
	<div class="container">
		<div class="layoutContent clearfix">

			<div class="layoutContent-main<?php echo esc_attr($main_classes); ?>">				
				<article <?php md_bone_post_class($post_classes); ?>>
					<?php md_bone_single_schema_meta(); ?>
					<?php md_bone_single_header(); ?>

					<?php
					if ($format == '') {
						md_bone_featured_img('md_bone_xl');
					} else {
						md_bone_post_format('md_bone_xl');
					} ?>
					
					<?php if ($post->post_content !== '') { ?>

						<div class="postContent bodyCopy entry-content clearfix">
							<?php the_content(); ?>
						</div>

						<?php md_bone_post_pagination(); ?>

						<?php md_bone_review_score(); ?>

					<?php } ?>

					<?php md_bone_single_footer(); ?>

					<?php if(is_active_sidebar('adsidebar-3')) { ?>
						<div class="adSidebar adSidebar--3">
						<?php dynamic_sidebar('adsidebar-3'); ?>
						</div>
					<?php } ?>
					
					<?php if (md_bone_get_option('authorbox-switch', '1')) get_template_part('templates/author-box'); ?>

				</article>

				<?php if (md_bone_get_option('postnav-switch', '1')) get_template_part('templates/post-navigation'); ?>
								
				<?php /* if (md_bone_get_option('related-post-switch', '1')) get_template_part('templates/related-posts'); */ ?>

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