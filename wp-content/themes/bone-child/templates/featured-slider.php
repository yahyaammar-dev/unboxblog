<?php
$args = md_bone_create_ft_args();
if ( !$args ) {
	return; // there's no post to show
}

$feat_layout = md_bone_get_option('feat-layout', 'slider');
$thumb_size = 'md_bone_xxxl';
$slider_class = 'featuredBlock featuredBlock--slider md-theme';
$feat_query = new WP_Query( $args );
if (( $feat_layout == 'slider-cover' ) || ( $feat_layout == 'slider-fw' )) {
	$fw_feat = true;
	$thumb_size = 'md_bone_cover';
	if ( $feat_layout == 'slider-cover' ) {
		$slider_class .= ' featuredBlock--slider--cover';
	} else {
		$slider_class .= ' featuredBlock--slider--fw';
	}
	if ( $feat_query->post_count > 1 ) {
		$slider_class .= ' owl-carousel js-feat-slider';
	}
} else {
	$fw_feat = false;
	if ( $feat_query->post_count > 1 ) {
		$slider_class .= ' owl-carousel js-feat-slider-peek';
	}
}
if ( $feat_layout == 'slider-cover' ) {
	$slider_class .= ' featuredBlock--slider--cover';
}

if ( $feat_query->have_posts() ) :
?>
<?php if ($feat_layout == 'slider') { ?>
<div class="featuredBlockBackground clearfix">
<?php } ?>

<?php if (!$fw_feat) { ?>
<div class="featuredSliderWrap container">
<?php } ?>

	<div class="<?php echo esc_attr( $slider_class ); ?>">
		<?php while ( $feat_query->have_posts() ) : $feat_query->the_post(); ?>
			<div class="slide-content">
			<?php
				set_query_var('fw_feat', $fw_feat);
				set_query_var('thumb_size', $thumb_size);
				get_template_part( 'templates/post-slide' );
			?>
			</div>
		<?php endwhile; ?>
	</div>

<?php if (!$fw_feat) { ?>
</div>
<?php } ?>

<?php if ($feat_layout == 'slider') { ?>
</div>
<?php } ?>

<?php
endif;
wp_reset_postdata();