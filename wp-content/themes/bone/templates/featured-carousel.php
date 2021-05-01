<?php
	$args = md_bone_create_ft_args();
	if ( !$args ) {
		return; // there's no post to show
	}
	$feat_query = new WP_Query( $args );
	
if ( $feat_query->have_posts() ) :
?>
<div class="featuredBlockBackground clearfix">
	<div class="container">
		<div class="featuredBlock featuredBlock--carousel md-theme owl-carousel js-feat-carousel">
		<?php while ( $feat_query->have_posts() ) : $feat_query->the_post(); ?>
			<div class="carousel-item">
			<?php get_template_part( 'templates/post-tile-featured'); ?>
			</div>
			<?php endwhile; ?>	
		</div>
	</div>
</div>
<?php
endif;
wp_reset_postdata();