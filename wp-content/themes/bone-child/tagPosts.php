<?php


/**
 * Template Name: Tag Posts
 */
 

$request = file_get_contents("php://input");
print_r(json_decode($request,true));


$layout_opt = md_bone_get_layout_opt();
$page_title_style = md_bone_get_option( 'page-title-style', 'default' );
?>

<?php get_header(); ?>

<main id="main" class="layoutBody">
	<div class="pageHeading pageHeading--fw<?php if ($page_title_style === 'boxed') { echo ' pageHeading--boxed'; } ?>">
		<div class="container">
			<div class="pageHeading-prefix metaFont"><?php if (is_tag()) { esc_html_e('Tag', 'bone'); } else {  esc_html_e('Archive', 'bone'); } ?></div>
			<h3 class="pageHeading-title titleFont"><?php if (is_tag()) { single_tag_title(); } else { the_archive_title(); } ?></h3>
		</div>
	</div>

	<?php if ( $layout_opt['sidebar-position'] == 'none' ) { ?>
	<div class="contentBlockWrapper">

		<div class="container">
			<div class="layoutContent<?php echo esc_attr($layout_opt['main-class']); ?> clearfix">
				<?php if ( have_posts() ): ?>
				<div id="mdContent" class="<?php echo esc_attr($layout_opt['content-class']); ?> clearfix">
					<?php
					while ( have_posts() ) : the_post();
						md_bone_get_template( $layout_opt['content-layout'] );
					endwhile;
					?>
				</div>
				<?php md_bone_get_pagination( $layout_opt['pagination-type'] );?>

				<?php else:
					get_template_part('templates/no-result' ); ?>
				<?php endif; ?>
			</div>
		</div>

	</div><!-- contentBlockWrapper -->
	<?php } else { ?>
	<div class="contentBlockWrapper">

		<div class="container">
			<div class="layoutContent clearfix">
				<div class="layoutContent-main<?php echo esc_attr($layout_opt['main-class']); ?>">
					<?php if ( have_posts() ): ?>
					<div id="mdContent" class="<?php echo esc_attr($layout_opt['content-class']); ?> clearfix">
						<?php
						while ( have_posts() ) : the_post();
							md_bone_get_template( $layout_opt['content-layout'] );
						endwhile;
						?>
					</div>
					<?php md_bone_get_pagination( $layout_opt['pagination-type'] );?>

					<?php else:
						get_template_part('templates/no-result' ); ?>
					<?php endif; ?>
				</div>
			
				<aside class="layoutContent-sidebar sidebar<?php echo esc_attr($layout_opt['sidebar-class']); ?>">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</div>

	</div><!-- contentBlockWrapper -->
	<?php } ?>
	
</main>

<?php if (is_active_sidebar('adsidebar-2')) { ?>
	<div class="adSidebar adSidebar--2">
		<div class="container">
			<?php dynamic_sidebar('adsidebar-2'); ?>
		</div>
	</div>
<?php } ?>
	
<?php get_footer();