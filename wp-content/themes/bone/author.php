<?php
	$layout_opt = md_bone_get_layout_opt();
	if ( $author_id = get_query_var( 'author' ) ) { $user = get_user_by( 'id', $author_id ); } else { $user = null; }
?>
<?php get_header(); ?>
	<main id="main" class="layoutBody">
		
		<?php if ( $layout_opt['sidebar-position'] == 'none' ) { ?>
		<div class="container">
			<div class="layoutContent<?php echo esc_attr($layout_opt['main-class']); ?> clearfix">
				<div class="contentWrap">
					<?php get_template_part('templates/author-box-large'); ?>
				</div>
				
				<?php
				if ( have_posts() ) : ?>
					<div class="sectionHeading">
						<h3 class="sectionHeading-title metaFont">
							<?php esc_html_e('Latest posts', 'bone'); ?>
							<?php if ( $paged > 1) {
								esc_html_e(' - Page ', 'bone');
								echo esc_html($paged);
							} ?>
						</h3>
					</div>

					<div class="<?php echo esc_attr($layout_opt['content-class']); ?>">
						
					<?php
					while ( have_posts() ) : the_post();

						md_bone_get_template( $layout_opt['content-layout'] );

					endwhile; ?>

					</div>

					<?php
					md_bone_get_pagination('1');

				endif; ?>
			</div>
		</div>
		<?php } else { ?>
		<div class="container">
			<div class="layoutContent clearfix">
				<div class="layoutContent-main<?php echo esc_attr($layout_opt['main-class']); ?>">

					<?php get_template_part('templates/author-box-large'); ?>
					<?php
					if ( have_posts() ) : ?>
						<div class="sectionHeading">
							<h3 class="sectionHeading-title metaFont">
								<?php esc_html_e('Latest posts', 'bone'); ?>
								<?php if ( $paged > 1) {
									esc_html_e(' - Page ', 'bone');
									echo esc_html($paged);
								} ?>
							</h3>
						</div>

						<div class="<?php echo esc_attr($layout_opt['content-class']); ?>">

						<?php
						while ( have_posts() ) : the_post();

							md_bone_get_template( $layout_opt['content-layout'] );

						endwhile; ?>

						</div>

						<?php
						md_bone_get_pagination('1');

					endif; ?>
				</div><!-- end layoutContent-main -->

				<aside id="mdSidebar" class="layoutContent-sidebar sidebar<?php echo esc_attr($layout_opt['sidebar-class']); ?>">
					<?php get_sidebar(); ?>
				</aside>	
			</div>
		</div>
		
		<?php } ?>

	</main>

<?php if (is_active_sidebar('adsidebar-2')) { ?>
	<div class="adSidebar adSidebar--2">
		<div class="container">
			<?php dynamic_sidebar('adsidebar-2'); ?>
		</div>
	</div>
<?php } ?>

<?php get_footer(); ?>