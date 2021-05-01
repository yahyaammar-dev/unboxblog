<?php
	$classes = array(
		'postItem',
		'post--card',
		'post--card--paper',
	);			
	$category_array = get_the_category();
	if ( $category_array ) {
		$category_id = $category_array[0]->term_id;
		$category_name = esc_attr( $category_array[0]->name );
		$category_link = esc_url( get_category_link( $category_id ) );
	}
	$article_link =  get_permalink();
	if (!isset($thumb_size)) {
		$thumb_size = 'md_bone_md';
	}
?>
<article <?php post_class( $classes ); ?>>
	<?php
	if ( has_post_thumbnail() ) { ?>
	<div class="postFeaturedImg">
		<?php the_post_thumbnail($thumb_size); ?>
		<?php md_bone_format_icon(); ?>
		<a href="<?php echo esc_url($article_link); ?>" class="o-overlayLink"></a>
	</div>
	<?php } ?>

	<div class="postInfo">
		<?php md_bone_post_category(); ?>
		<h3 class="postTitle entry-title">
			<a href="<?php echo esc_url($article_link); ?>" rel="bookmark"><?php the_title(); ?></a>
			<?php md_bone_review_score_badge(); ?>
		</h3>
	</div>

	<div class="postFooter">
		<?php md_bone_post_meta_btn('3'); ?>
	</div>
</article>