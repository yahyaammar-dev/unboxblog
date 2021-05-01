<?php
	$prev_post = get_previous_post();
	if (!empty( $prev_post )) {
		$prev_post_url = get_permalink( $prev_post->ID );
		$prev_post_title = get_the_title( $prev_post->ID );
	}

	$next_post = get_next_post();
	if (!empty( $next_post )) {
		$next_post_url = get_permalink( $next_post->ID );
		$next_post_title = get_the_title( $next_post->ID );
	}
?>
<div class="postNavigation">
	<div class="postNavigation-inner">
		<div class="flexbox">
			<div class="flexbox-item">
				<div class="postNavigation-prev clearfix">
					<?php if (!empty( $prev_post )) { ?>
						<?php if ( has_post_thumbnail($prev_post->ID) ) { ?>
						<div class="postNavigation-thumb">
							<?php echo get_the_post_thumbnail( $prev_post->ID, 'md_bone_xs' ); ?>
						</div>
						<?php } ?>
						<span class="metaFont"><?php esc_html_e('Previous article', 'bone'); ?></span>
						<span class="postTitle"><?php echo wp_kses_post($prev_post_title); ?></span>
						<a href="<?php echo esc_url($prev_post_url); ?>" class="u-stretched"></a>
					<?php } else { ?>
						<span class="metaFont"><?php esc_html_e('No older article', 'bone'); ?></span>
					<?php } ?>
				</div>
			</div>
			
			<div class="flexbox-item">
				<div class="postNavigation-next clearfix">
					<?php if (!empty( $next_post )) { ?>
						<?php if ( has_post_thumbnail($next_post->ID) ) { ?>
						<div class="postNavigation-thumb">
							<?php echo get_the_post_thumbnail( $next_post->ID, 'md_bone_xs' ); ?>
						</div>
						<?php } ?>
						<span class="metaFont"><?php esc_html_e('Next article', 'bone'); ?></span>
						<span class="postTitle"><?php echo wp_kses_post($next_post_title); ?></span>
						<a href="<?php echo esc_url($next_post_url); ?>" class="u-stretched"></a>
					<?php } else { ?>
						<span class="metaFont"><?php esc_html_e('No newer article', 'bone'); ?></span>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>