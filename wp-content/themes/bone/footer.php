<?php
	$single_layout = md_bone_get_single_layout();
	$backtop = md_bone_get_option('back-top-switch', '1');
	$header_login = md_bone_get_option('header-login-switch', '1');
?>

		<footer id="footer" class="siteFooter">
			<?php if ( has_nav_menu( 'footer-menu' ) ) { ?>
			<div class="siteFooter-top">
				<div class="container">
					<nav class="siteFooter-menu navigation navigation--footer">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'footer-menu',
							'container' => false,
							'depth' => 1,
							'fallback_cb' => false,
						));
						?>
					</nav>
				</div>
			</div>
			<?php } ?>

			<?php if(is_active_sidebar('footer-sidebar-1') || is_active_sidebar('footer-sidebar-2') || is_active_sidebar('footer-sidebar-3')) { ?>
			<div class="siteFooter-middle">
				<div class="container">
					<div class="siteFooter-middle-inner clearfix">
						<?php if(is_active_sidebar('footer-sidebar-1')) { ?>
						<div class="siteFooter-widgetArea siteFooter-widgetArea--1">
						<?php dynamic_sidebar('footer-sidebar-1'); ?>	
						</div>
						<?php } ?>

						<?php if(is_active_sidebar('footer-sidebar-2')) { ?>
						<div class="siteFooter-widgetArea siteFooter-widgetArea--2">
						<?php dynamic_sidebar('footer-sidebar-2'); ?>	
						</div>
						<?php } ?>

						<?php if(is_active_sidebar('footer-sidebar-3')) { ?>
						<div class="siteFooter-widgetArea siteFooter-widgetArea--3">
						<?php dynamic_sidebar('footer-sidebar-3'); ?>	
						</div>
						<?php } ?>

                        <div class="siteFooter-widgetArea siteFooter-widgetArea--4" style="margin-top: -1.5rem; width: 20%;">
                            <img  src="<?php echo get_theme_file_uri().'/123.png' ?>">
                        </div>

					</div>
				</div>
			</div>
			<?php } ?>
			
			<div class="siteFooter-bottom">
				<div class="container">
					<div class="siteFooter-bottom-inner clearfix">
						<div class="siteFooter-copyright u-floatLeft metaFont">
							<?php echo md_bone_get_option('copyright-text','<a href="http://minimaldog.net">minimaldog</a>'); ?>
						</div>
						<div class="siteFooter-backTop u-floatRight">
							<!-- Back top button -->
							<div class="backTopBtn metaFont js-scrolltop-btn"><?Php esc_html_e('Back to top', 'bone'); ?>&nbsp;<i class="fa fa-arrow-up"></i></div>
						</div>
					</div>
				</div>
			</div>
			
		</footer>
	</div>
	<!-- siteWrap -->
	
	<!-- Offcanvas menu -->
	<div id="md_offCanvasMenu" class="md_offCanvasMenu md_offCanvas md_offCanvas--left">
		<div class="offCanvasClose metaFont js-offCanvasClose"><i class="fa fa-times-circle"></i><?php esc_html_e('Close', 'bone') ?></div>
		<div class="md_offCanvasMenu-social">
			<?php get_template_part('templates/site-social-inline'); ?>
		</div>

		<?php
		if ( has_nav_menu( 'main-menu' ) ) {
		?>
		<nav class="navigation navigation--offCanvas md_offCanvasMenu-navigation">
			<?php
			wp_nav_menu( array(
				'container' => false,
				'theme_location' => 'main-menu',
				'fallback_cb' => false,
				'depth' => 3,
			) );
			?>
		</nav>
		<?php
		}
		?>

		<?php if ($header_login === '1') { ?>
		<div class="md_offCanvasMenu-userActions">
			<?php get_template_part('templates/user-actions-list'); ?>
		</div>
		<?php } ?>
	</div>
	
	<?php
	if ($header_login === '1') {
	?>
	<!-- Login form modal -->					
	<div id="js-login-wrapper" class="loginFormWrapper modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-close" data-dismiss="modal" aria-label="Close"><i class="fa fa-times-circle"></i></div>
			<?php wp_login_form(); ?>
			<a href="<?php echo wp_registration_url( get_permalink() ); ?>" title="<?php esc_html__('Register', 'bone'); ?>" class="btn btn--pill login-register"><?php esc_html_e('Register', 'bone'); ?></a>
			<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" title="<?php esc_html__('Lost Password', 'bone'); ?>" class="login-lostPwd metaFont"><?php esc_html_e('Forgot Password ?', 'bone'); ?></a>
		</div>
	</div>
	<?php } ?>

	<?php wp_footer(); ?>
</body>
</html>