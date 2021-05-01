<?php
	$args = md_bone_create_ft_args();
	if ( !$args ) {
		return; // there's no post to show
	}
	$feat_query = new WP_Query( $args );

if ( $feat_query->have_posts() ) :
?>
<div class="featuredBlockBackground clearfix">
	<div class="featuredBlock featuredBlock--altGrid container">
		<?php while ( $feat_query->have_posts() ) : $feat_query->the_post(); ?>

			<?php if ($feat_query->current_post < 2) { ?>

				<?php if ($feat_query->current_post == 0) { ?>
				<div class="featuredBlock--altGrid--main row">
				<?php } ?>

				<div class="featuredBlock--altGrid--main-item col-xs-12 col-sm-6">
					<?php get_template_part( 'templates/post-tile-center' ); ?>
				</div>

				<?php if (($feat_query->current_post == 1) || $feat_query->current_post == ($feat_query->post_count - 1)) { ?>
				</div>
				<?php } ?>

			<?php } else { ?>

				<?php if ($feat_query->current_post == 2) { ?>
				<div class="featuredBlock--altGrid--minor row">
				<?php } ?>
				
				<div class="featuredBlock--altGrid--minor-item col-xs-12 col-md-4">
				<?php
					$title_limit = 80;
					set_query_var('title_limit', $title_limit);
					get_template_part( 'templates/post-list-paper-micro' );
				?>
				</div>

				<?php if (($feat_query->current_post == 0) || $feat_query->current_post == ($feat_query->post_count - 1)) { ?>
				</div>
				<?php } ?>

			<?php } ?>

		<?php endwhile;?>
	</div>
</div>
<?php
endif;
wp_reset_postdata();