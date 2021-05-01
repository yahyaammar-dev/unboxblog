<?php
	$thumb_size = 'md_bone_xl';
	$args = md_bone_create_ft_args();
	if ( !$args ) {
		return; // there's no post to show
	}
	$feat_query = new WP_Query( $args );

if ( $feat_query->have_posts() ) :
?>
<div class="featuredBlockBackground clearfix">
	<div class="container container--featured-tiles">
		<div class="featuredBlock featuredBlock--tiles clearfix">
			<div class="row">
			<?php
			 while ( $feat_query->have_posts() ) : $feat_query->the_post();
				switch ($feat_query->current_post) {
					case 0:
						echo '<div class="tileItem tileItem--big col-xs-12">';
						get_template_part( 'templates/post-tile-featured');
						echo '</div>';
						break;

					case 1:
					case 2:
						$thumb_size = 'md_bone_lg';
						echo '<div class="tileItem col-xs-12 col-sm-6">';
						get_template_part( 'templates/post-tile-featured-small');
						echo '</div>';
						break;
				}
			endwhile;
			?>
			</div>
		</div>
	</div>
</div>
<?php
endif;
wp_reset_postdata();