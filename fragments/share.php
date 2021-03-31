<?php
$title = get_the_title();
$link = get_the_permalink();
?>

<li class="widget-share">
	<div class="share">
		<h6>
			<?php _e( 'Share!', 'crb' ); ?>

			<img src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/quite-happy.svg" alt="">
		</h6>

		<ul>
			<?php
			$twitter_url = add_query_arg( array(
				'status' => $link,
			), 'https://twitter.com/home' );
			?>
			<li data-aos-once="true" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
				<a href="<?php echo $twitter_url; ?>" onclick="event.preventDefault(); window.open('<?php echo esc_url( $twitter_url ); ?>','mywindow','width=800,height=500');">
					<i class="ico ico--twitter"></i>
				</a>
			</li>

			<?php
			$facebook_url = add_query_arg( array(
				'u' => $link,
			), 'https://www.facebook.com/sharer/sharer.php' );
			?>
			<li data-aos-once="true" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
				<a href="<?php echo $facebook_url; ?>" onclick="event.preventDefault(); window.open('<?php echo esc_url( $facebook_url ); ?>','mywindow','width=800,height=500');">
					<i class="ico ico--facebook"></i>
				</a>
			</li>

			<?php
			$image_url = '';
			if ( !empty( $image = carbon_get_the_post_meta( 'crb_intro_image' ) ) ) {
				$image_url = wp_get_attachment_image_url( $image, 'full' );
			}

			$pinterest_link = add_query_arg( array(
					'url' => $link,
					'media' => $image_url,
					'description' => get_the_title(),
				), 'https://pinterest.com/pin/create/button/' );
			?>
			<li data-aos-once="true" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
				<a href="<?php echo $pinterest_link; ?>" onclick="event.preventDefault(); window.open('<?php echo esc_url( $pinterest_link ); ?>','mywindow','width=800,height=500');">
					<i class="ico ico--pinterest"></i>
				</a>
			</li>

			<li>
				<a href="#" data-copy>
					<i class="ico ico--link"></i>
				</a>
			</li>
		</ul>
	</div>
</li>