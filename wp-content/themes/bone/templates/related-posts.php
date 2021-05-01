<?php
	$rel_layout = md_bone_get_option('related-post-layout', 'cards');
	if ($rel_layout === 'tiles') {
		$post_quantity = 4;
	} else {
		$post_quantity = 3;
	}
	$rel_query = md_bone_get_related_posts( get_the_ID(), $post_quantity);
	if ( $rel_query->have_posts() ) {
		if ($rel_layout === 'tiles') {
?>
			<div class="relatedPosts relatedPosts--card">
				<h5 class="blockHeading"><span><i class="fa fa-hand-o-right"></i><?php esc_html_e('You may also like', 'bone'); ?></span></h5>
				
				<?php if ( $rel_query->have_posts() ) : while ( $rel_query->have_posts() ) : $rel_query->the_post(); ?>
					
					<?php if (($rel_query->current_post + 1) % 2) { ?>
						<div class="row">
					<?php } ?>
						<div class="col-xs-12 col-sm-6">
							<?php get_template_part( 'templates/post-card-bg' ); ?>
						</div>

						<?php if ( (($rel_query->current_post() + 1) % 2) == 0 ): ?>
							<div class="clearfix"></div>
						<?php endif; ?>
					
					<?php if ((!(($rel_query->current_post + 1) % 2)) || (($rel_query->current_post + 1) == $rel_query->post_count )) { ?>
						</div>
					<?php } ?>

				<?php endwhile; endif; ?>
			</div>
<?php 
		} else {
?>
			<div class="relatedPosts relatedPosts--alt">
				<h5 class="blockHeading"><span><i class="fa fa-hand-o-right"></i><?php esc_html_e('You may also like', 'bone'); ?></span></h5>
				
				<?php if ( $rel_query->have_posts() ) : while ( $rel_query->have_posts() ) : $rel_query->the_post(); ?>
					
					<?php if ($rel_query->current_post == 0) { ?>
						<div class="row">
					<?php } ?>
						<div class="col-xs-12 col-sm-4">
							<?php get_template_part( 'templates/post-card-paper-micro' ); ?>
						</div>

						<?php if ( (($rel_query->current_post() + 1) % 2) == 0 ): ?>
							<div class="clearfix"></div>
						<?php endif; ?>
					
					<?php if (($rel_query->current_post == 2) || (($rel_query->current_post + 1) == $rel_query->post_count )) { ?>
						</div>
					<?php } ?>

				<?php endwhile; endif; ?>
			</div>
<?php
		}
	}
	
	wp_reset_postdata();