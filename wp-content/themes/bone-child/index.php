<?php

$layout_opt = md_bone_get_layout_opt();
$feat_layout = md_bone_get_option('feat-layout','slider');
$section_heading = md_bone_get_option('content-heading-text','');
$template = ( strpos($feat_layout, '-') ) ? substr($feat_layout, 0, strpos($feat_layout, '-')) : $feat_layout;
$fw_feat = ( ($feat_layout == 'slider-cover') || ($feat_layout == 'slider-fw') || ($feat_layout == 'carousel') ) ? true : false;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
global $wp_query;
$latest_post_ids = array();
?>

<?php get_header(); ?>

    <main id="main" class="layoutBody">

        <?php if ( is_home() && !is_paged() ) { ?>
            <div class="featuredBlockWrapper">
                <?php get_template_part('templates/featured-'.$template); ?>
            </div>
        <?php } ?>

        <?php if ( is_home() && !is_paged() ) { ?>
            <div class="listMaps">
                <?php get_template_part('templates/maps','list'); ?>
            </div>
        <?php } ?>


        <?php get_template_part('templates/featured','posts'); ?>


        <?php if ( is_home() && !is_paged() ) { ?>
            <div class="gallery-wrapper">
                <?php get_template_part('templates/home','gallery'); ?>
            </div>
        <?php } ?>

        <?php if (is_active_sidebar('adsidebar-1')) { ?>
            <div class="adSidebar adSidebar--1">
                <div class="container">
                    <?php dynamic_sidebar('adsidebar-1'); ?>
                </div>
            </div>
        <?php } ?>

        <?php if ( $layout_opt['sidebar-position'] == 'none' ) { ?>
            <div class="contentBlockWrapper">
                <div class="container">
                    <div class="layoutContent<?php echo esc_attr($layout_opt['main-class']); ?> clearfix">
                        <?php if ( is_home() && ( $section_heading !== '' ) ) { ?>
                            <div class="sectionHeading">
                                <h3 class="sectionHeading-title metaFont">
                                    <?php echo esc_html( $section_heading ); ?>
                                    <?php if ( $paged > 1) {
                                        esc_html_e(' - Page ', 'bone');
                                        echo esc_html($paged);
                                    } ?>
                                </h3>
                            </div>
                        <?php } ?>

                        <?php if ( have_posts() ): ?>
                            <div id="mdContent" class="<?php echo esc_attr($layout_opt['content-class']); ?> clearfix">
                                <?php
                                while ( have_posts() ) : the_post();
                                    md_bone_get_template( $layout_opt['content-layout'] );
                                    $latest_post_ids[] = get_the_id();
                                endwhile;
                                ?>
                            </div>
                            <?php md_bone_get_pagination( $layout_opt['pagination-type'] );?>

                        <?php else:
                            get_template_part('templates/no-result' ); ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div><!-- contentBlockWrapper -->
        <?php } else { ?>
            <div class="contentBlockWrapper">
                <div class="container">
                    <div class="layoutContent clearfix">
                        <div class="layoutContent-main<?php echo esc_attr($layout_opt['main-class']); ?>">
                            <?php if ( is_home() && ( $section_heading !== '' ) ) { ?>
                                <div class="sectionHeading">
                                    <h3 class="sectionHeading-title metaFont">
                                        <?php echo esc_html( $section_heading ); ?>
                                        <?php if ( $paged > 1) {
                                            esc_html_e(' - Page ', 'bone');
                                            echo esc_html($paged);
                                        } ?>
                                    </h3>
                                </div>
                            <?php } ?>

                            <?php if ( have_posts() ): ?>
                                <div id="mdContent" class="<?php echo esc_attr($layout_opt['content-class']); ?> clearfix">
                                    <?php
                                    while ( have_posts() ) : the_post();
                                        md_bone_get_template( $layout_opt['content-layout'] );
                                        $latest_post_ids[] = get_the_id();
                                    endwhile;
                                    ?>
                                </div>
                                <?php md_bone_get_pagination( $layout_opt['pagination-type'] );?>

                            <?php else:
                                get_template_part('templates/no-result' ); ?>
                            <?php endif; ?>

                        </div>

                        <aside class="layoutContent-sidebar sidebar<?php echo esc_attr($layout_opt['sidebar-class']); ?>">
                            <?php get_sidebar(); ?>
                        </aside>

                       

                    </div>
                </div>
            </div><!-- contentBlockWrapper -->
        <?php } ?>

        <?php get_template_part('templates/featured','video'); ?>

    </main>






<?php if (is_active_sidebar('adsidebar-2')) { ?>
    <div class="adSidebar adSidebar--2">
        <div class="container">
            <?php dynamic_sidebar('adsidebar-2'); ?>
        </div>
    </div>
<?php } ?>

<?php
$more_reading = md_bone_get_option('more-reading-switch', '1');
if ( $more_reading && !is_paged() ) {
    get_template_part( 'templates/by-category-listing' );
}
?>

<?php get_footer();