<?php
	$author_bio = get_the_author_meta( 'description' );
	if (($author_bio === '') && is_single()) return; // do not display author box on single page if there's no bio set.
	$author_id = get_the_author_meta( 'ID' );
    $author_name = get_the_author_meta('display_name', $author_id);
    $author_website = get_the_author_meta('url', $author_id);
    $author_post_counts = count_user_posts( $author_id );
?>
<div class="authorBox">
	<div class="authorBox-avatar"><?php echo get_avatar( $author_id, 100, '', esc_html__( 'avatar', 'bone' )); ?></div>
	<div class="authorBox-text">
		<div class="authorBox-name authorName">
			<h4><?php the_author_posts_link(); ?></h4>
		</div>
		<div class="authorBox-bio"><?php echo esc_html($author_bio); ?></div>

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