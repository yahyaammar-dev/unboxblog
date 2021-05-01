<?php
$bh = md_bone_get_option('behance-url', '');
$dr = md_bone_get_option('dribbble-url', '');
$fb = md_bone_get_option('facebook-url', '');
$gp = md_bone_get_option('google-url', '');
$in = md_bone_get_option('instagram-url', '');
$li = md_bone_get_option('linkedin-url', '');
$pi = md_bone_get_option('pinterest-url', '');
$sn = md_bone_get_option('snapchat-url', '');
$sc = md_bone_get_option('soundcloud-url', '');
$sp = md_bone_get_option('spotify-url', '');
$tg = md_bone_get_option('telegram-url', '');
$tu = md_bone_get_option('tumblr-url', '');
$tw = md_bone_get_option('twitter-url', '');
$vk = md_bone_get_option('vk-url', '');
$yt = md_bone_get_option('youtube-url', '');
$open_in_new_tab = md_bone_get_option('social-open-new-tab', '1');
$attrs = '';
$title = '';
if ( $open_in_new_tab === '1' ) {
	$attrs = ' target="_blank" rel="noopener noreferrer"';
}
$default_order = array(
    'bh' => true,
    'dr' => true,
    'fb' => true,
    'gp' => true,
    'in' => true,
    'li' => true,
    'pi' => true,
    'sn' => true,
    'sc' => true,
    'sp' => true,
    'tg' => true,
    'tu' => true,
    'tw' => true,
    'vk' => true,
    'yt' => true,
);
$social_sortable = md_bone_get_option('social-sortable', $default_order);
if (($bh !== '') || ($dr !== '') || ($fb !== '') || ($gp !== '') || ($in !== '') || ($li !== '') || ($pi !== '') || ($sn !== '') || ($sc !== '') || ($sp !== '') || ($tg !== '') || ($tu !== '') || ($tw !== '') || ($yt !== '') || ($vk !== '')) {
?>
<div class="siteFollow">
	<div class="siteFollow-btn btn btn--pill js-popover-toggle"><i class="fa fa-share-alt"></i><span><?php esc_html_e('Follow', 'bone'); ?></span></div>
	<div class="siteFollow-list popover popover--bottom popover--socialList js-popover">
		<div class="popover-arrow"></div>
		<ul class="socialList metaFont">
		<?php
		foreach ($social_sortable as $key => $value) {
			if ($value) {
				switch ($key) {
					case 'bh':
						if ($bh !== '') {
							$title = md_bone_get_option('behance-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-behance"><a href="'.esc_url($bh).'"'.$title.$attrs.'><i class="fa fa-behance"></i>Behance</a></li>';
						}
						break;

					case 'dr':
						if ($dr !== '') {
							$title = md_bone_get_option('dribbble-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-dribbble"><a href="'.esc_url($dr).'"'.$title.$attrs.'><i class="fa fa-dribbble"></i>Dribbble</a></li>';
						}
						break;

					case 'fb':
						if ($fb !== '') {
							$title = md_bone_get_option('facebook-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-facebook"><a href="'.esc_url($fb).'"'.$title.$attrs.'><i class="fa fa-facebook"></i>Facebook</a></li>';
						}
						break;

					case 'gp':
						if ($gp !== '') {
							$title = md_bone_get_option('google-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-google"><a href="'.esc_url($gp).'"'.$title.$attrs.'><i class="fa fa-google-plus"></i>Google+</a></li>';
						}
						break;					
					
					case 'in':
						if ($in !== '') {
							$title = md_bone_get_option('instagram-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-instagram"><a href="'.esc_url($in).'"'.$title.$attrs.'><i class="fa fa-instagram"></i>Instagram</a></li>';
						}
						break;

					case 'li':
						if ($li !== '') {
							$title = md_bone_get_option('linkedin-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-linkedin"><a href="'.esc_url($li).'"'.$title.$attrs.'><i class="fa fa-linkedin"></i>Linkedin</a></li>';
						}
						break;
					
					case 'pi':
						if ($pi !== '') {
							$title = md_bone_get_option('pinterest-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-pinterest"><a href="'.esc_url($pi).'"'.$title.$attrs.'><i class="fa fa-pinterest"></i>Pinterest</a></li>';
						}
						break;

					case 'sn':
						if ($sn !== '') {
							$title = md_bone_get_option('snapchat-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-snapchat"><a href="'.esc_url($sn).'"'.$title.$attrs.'><i class="fa fa-snapchat-ghost"></i>Snapchat</a></li>';
						}
						break;

					case 'sc':
						if ($sc !== '') {
							$title = md_bone_get_option('soundcloud-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-soundcloud"><a href="'.esc_url($sc).'"'.$title.$attrs.'><i class="fa fa-soundcloud"></i>Soundcloud</a></li>';
						}
						break;

					case 'sp':
						if ($sp !== '') {
							$title = md_bone_get_option('spotify-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-spotify"><a href="'.esc_url($sp).'"'.$title.$attrs.'><i class="fa fa-spotify"></i>Spotify</a></li>';
						}
						break;

					case 'tg':
						if ($tg !== '') {
							$title = md_bone_get_option('telegram-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-telegram"><a href="'.esc_url($tg).'"'.$title.$attrs.'><i class="fa fa-telegram"></i>Telegram</a></li>';
						}
						break;
					
					case 'tu':
						if ($tu !== '') {
							$title = md_bone_get_option('tumblr-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-tumblr"><a href="'.esc_url($tu).'"'.$title.$attrs.'><i class="fa fa-tumblr-square"></i>Tumblr</a></li>';
						}
						break;

					case 'tw':
						if ($tw !== '') {
							$title = md_bone_get_option('twitter-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-twitter"><a href="'.esc_url($tw).'"'.$title.$attrs.'><i class="fa fa-twitter-square"></i>Twitter</a></li>';
						}
						break;
					
					case 'vk':
						if ($vk !== '') {
							$title = md_bone_get_option('vk-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-vk"><a href="'.esc_url($vk).'"'.$title.$attrs.'><i class="fa fa-vk"></i>VK</a></li>';
						}
						break;

					case 'yt':
						if ($yt !== '') {
							$title = md_bone_get_option('youtube-title', '');
							if ($title !== '') {
								$title = ' title="'.$title.'"';
							}
							echo '<li class="socialList-youtube"><a href="'.esc_url($yt).'"'.$title.$attrs.'><i class="fa fa-youtube"></i>Youtube</a></li>';
						}
						break;
				}
			}
		}
		?>
		</ul>
	</div>
</div>
<?php }