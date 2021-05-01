<?php
/**
 * Template Name: Bone Authors List
 *
 * This is the template for listing authors.
 */

$sidebar_position = md_bone_get_metabox( 'page-sidebar-position', 'default' );
if ($sidebar_position == 'default') {
	$sidebar_position = md_bone_get_option('page-sidebar-position', 'right');
}

$hide_page_title = md_bone_get_metabox( 'hide-page-title', '0' );
$page_title_style = md_bone_get_metabox( 'page-title-style', 'boxed' );
$sticky_sidebar = md_bone_get_option('sticky-sidebar', '1');
$main_classes = '';
$sidebar_classes = '';

if($sidebar_position == 'right') {
	$main_classes .= ' hasRightSidebar';
	$sidebar_classes .= ' sidebar--right';
} else {
	$main_classes .= ' hasLeftSidebar';
	$sidebar_classes .= ' sidebar--left';
}

if($sticky_sidebar) {
	$sidebar_classes .= ' js-sticky-sidebar';
}

if ($sidebar_position == 'none') {
	$post_classes = array(
		'pageTemplate',
		'pageTemplate--fullwidth',
	);
} else {
	$post_classes = array(
		'pageTemplate',
	);
}

if ( has_post_thumbnail() ) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'md_bone_cover', true );
	$thumb_url = $thumb_url_array[0];
} else {
	$thumb_url = '';
}

// Pagination variables
$number   = 10;
$paged    = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'who'					=> 'authors',
	'has_published_posts'	=> true,
	'orderby'				=> 'display_name',
	'order'					=> 'ASC',
	'number'				=> $number,
	'paged'					=> $paged,
);
$user_query = new WP_User_Query( $args );
$total_authors = $user_query->get_total();
$total_pages = intval($total_authors / $number);

get_header(); ?>

<main class="layoutBody">
	<div <?php post_class($post_classes); ?>>

		<?php if (get_the_title() && ( $hide_page_title !== '1' )) { ?>
			<div class="pageHeading pageHeading--fw<?php if ($page_title_style === 'boxed') { echo ' pageHeading--boxed'; if ($thumb_url != '') { echo ' hasBgImg'; } } ?>">
				<div class="container">
					<?php if (($thumb_url !== '') && ($page_title_style === 'boxed')) { ?>
					<div class="o-backgroundImg" <?php echo 'style="background-image: url('.esc_url($thumb_url).')"'; ?>></div>
					<?php } ?>
					<h1 itemprop="name" class="pageHeading-title titleFont"><?php the_title(); ?></h1>
				</div>
			</div>
		<?php } ?>

	<?php if ( $sidebar_position === 'none' ) { ?>
		<div class="container">
			<div class="layoutContent clearfix">
				<div class="contentWrap">
					<?php
					if ( ! empty( $user_query->results ) ) {
						foreach ( $user_query->results as $user ) {
							$author_id = $user->ID;
							$author_bio = get_the_author_meta('description', $author_id);
						    $author_name = get_the_author_meta('display_name', $author_id);
						    $author_website = get_the_author_meta('url', $author_id);
						    $author_post_counts = count_user_posts( $author_id );
						?>
						<div itemprop="author" itemscope itemtype="http://schema.org/Person" class="authorBox">
							<div class="authorBox-avatar"><?php echo get_avatar( $author_id, 100, '', esc_html__( 'avatar', 'bone' ), array('extra_attr' => 'itemprop="image"') ); ?></div>
							<div class="authorBox-text">
								<div class="authorBox-name authorName">
									<h4 itemprop="name" ><a href="<?php echo get_author_posts_url($author_id); ?>"><?php echo esc_html($author_name); ?></a></h4>
								</div>
								<div class="authorBox-bio"><?php echo esc_html($author_bio);; ?></div>

								<div class="authorBox-meta">
									<?php if ($author_website) { ?>
									<div class="authorBox-website metaFont">
										<span><?php esc_html_e('Website: ', 'bone') ?></span><a href="<?php echo esc_url($author_website); ?>" target="_blank" title="Website"><?php echo esc_url($author_website); ?></a>
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
						<?php
						} // end foreach

						if ( $total_pages > 1 ) {
					    	echo '<div class="pagePagination metaFont clearfix">';
					    	$current_page = max(1, $paged);
							$pagination = array(
								'base' => get_pagenum_link(1) . '%_%',
					            'format' => 'page/%#%/',
								'total' => $total_pages,
								'current' => $current_page,
								'prev_text' => esc_html__( 'Previous', 'bone' ),
								'next_text' => esc_html__( 'Next', 'bone' ),
								'type' => 'plain',
							);
							echo paginate_links( $pagination );
					    	echo '</div>';
						}
					} else {
						esc_html_e('No users found.', 'bone');
					}
					?>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="container">
			<div class="layoutContent clearfix">

				<div class="layoutContent-main<?php echo esc_attr($main_classes); ?>">
					<?php
					if ( ! empty( $user_query->results ) ) {
						foreach ( $user_query->results as $user ) {
							$author_id = $user->ID;
							$author_bio = get_the_author_meta('description', $author_id);
						    $author_name = get_the_author_meta('display_name', $author_id);
						    $author_website = get_the_author_meta('url', $author_id);
						    $author_post_counts = count_user_posts( $author_id );
						?>
						<div itemprop="author" itemscope itemtype="http://schema.org/Person" class="authorBox">
							<div class="authorBox-avatar"><?php echo get_avatar( $author_id, 100, '', esc_html__( 'avatar', 'bone' ), array('extra_attr' => 'itemprop="image"') ); ?></div>
							<div class="authorBox-text">
								<div class="authorBox-name authorName">
									<h4 itemprop="name" ><a href="<?php echo get_author_posts_url($author_id); ?>"><?php echo esc_html($author_name); ?></a></h4>
								</div>
								<div class="authorBox-bio"><?php echo esc_html($author_bio);; ?></div>

								<div class="authorBox-meta">
									<?php if ($author_website) { ?>
									<div class="authorBox-website metaFont">
										<span><?php esc_html_e('Website: ', 'bone') ?></span><a href="<?php echo esc_url($author_website); ?>" target="_blank" title="Website"><?php echo esc_url($author_website); ?></a>
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
						<?php
						} // end foreach

						if ( $total_pages > 1 ) {
					    	echo '<div class="pagePagination metaFont clearfix">';
					    	$current_page = max(1, $paged);
							$pagination = array(
								'base' => get_pagenum_link(1) . '%_%',
					            'format' => 'page/%#%/',
								'total' => $total_pages,
								'current' => $current_page,
								'prev_text' => esc_html__( 'Previous', 'bone' ),
								'next_text' => esc_html__( 'Next', 'bone' ),
								'type' => 'plain',
							);
							echo paginate_links( $pagination );
					    	echo '</div>';
						}
					} else {
						esc_html_e('No users found.', 'bone');
					}
					?>

				</div><!-- end layoutContent-main -->
				
				<aside id="mdSidebar" class="layoutContent-sidebar sidebar<?php echo esc_attr($sidebar_classes); ?>">
					<?php get_sidebar(); ?>
				</aside>

			</div><!-- end layoutContent -->
		</div><!-- end container -->
	<?php } ?>

	</div>
</main>

<?php if (is_active_sidebar('adsidebar-2')) { ?>
	<div class="adSidebar adSidebar--2">
		<div class="container">
			<?php dynamic_sidebar('adsidebar-2'); ?>
		</div>
	</div>
<?php } ?>

<?php get_footer();