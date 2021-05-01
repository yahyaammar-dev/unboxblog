<?php
	global $wp_query;
	$curauth = $wp_query->get_queried_object();
	$author_id = $curauth->ID;
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_website = get_the_author_meta('url', $author_id);
    $author_post_counts = count_user_posts( $author_id );
?>
<div class="authorBox authorBox--large">
	<div class="authorBox-avatar"><?php echo get_avatar( $author_id, 120, '', esc_html__( 'avatar', 'bone' )); ?></div>
	<div class="authorBox-text">

		<h4 class="authorBox-name authorName"><?php echo esc_html($author_name); ?></h4>
		<div class="authorBox-bio"><?php the_author_meta( 'description' ); ?></div>

		<div class="authorBox-meta">
			<?php if ($author_website) { ?>
			<div class="authorBox-website metaFont">
				<span><?php esc_html_e('Website: ', 'bone') ?></span><a href="<?php echo esc_url($author_website); ?>" target="_blank" rel="noopener" title="Website"><?php echo esc_url($author_website); ?></a>
			</div>
			<?php } ?>

			<?php if ($author_post_counts > 0) { ?>
			<div class="authorBox-postCount metaFont">
				<span><?php esc_html_e('Posts created: ', 'bone') ?><strong><?php echo esc_html($author_post_counts); ?></strong></span>
			</div>
			<?php } ?>
		</div>
	</div>
</div>