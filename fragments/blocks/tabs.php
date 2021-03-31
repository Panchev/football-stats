<?php extract( $fields ); ?>

<div class="group group--guide">
	<?php if ( !empty( $title ) ) : ?>
		<header class="group__head">
			<h3><?php esc_html_e( $title ); ?></h3>
		</header><!-- /.group__head -->
	<?php endif ?>

	<div class="guide">
		<?php if ( !empty( $title ) ) : ?>
			<header class="guide__head">
				<h3><?php esc_html_e( $title ); ?></h3>
			</header><!-- /.guide__head -->
		<?php
		endif;

		if ( !empty( $tabs ) ) :
		?>
			<div class="guide__nav">
				<ul>
					<?php foreach ( $tabs as $index => $tab ) : ?>
						<li class="<?php echo $index === 0 ? 'current' : ''; ?>">
							<a href="#guide<?php echo $index; ?>"><?php esc_html_e( $tab['title'] ); ?></a>
						</li>
					<?php endforeach ?>
				</ul>
			</div><!-- /.guide__nav -->

			<div class="guide__tabs">
				<?php foreach ( $tabs as $index => $tab ) : ?>
					<div id="guide<?php echo $index; ?>" class="guide__tab <?php echo $index === 0 ? 'active' : ''; ?>">
						<header class="guide__tab-head">
							<h5><?php esc_html_e( $tab['title'] ); ?></h5>
						</header><!-- /.guide__tab-head -->

						<div class="guide__tab-body">
							<?php if ( !empty( $tab['list_items'] ) ) : ?>
								<p class="list-items"><?php
									foreach ( $tab['list_items'] as $list_item ) :
										$icon = 'ico-check.svg';
										$class = '';
										if ( empty( $list_item['icon'] ) || $list_item['icon'] === 'bullet' ) {
											$class = 'bullet';
											$icon = '';
										} elseif ( $list_item['icon'] === 'cross' ) {
											$icon = 'ico-x-red.svg';
										} else {
											$icon = 'ico-check.svg';
										}
										?>
										<img class="<?php echo $class; ?>" src="<?php bloginfo('stylesheet_directory'); ?>/resources/images/temp/<?php echo $icon; ?>" alt=""><?php echo $list_item['text']; ?><br>
									<?php endforeach ?>
								</p>
							<?php
							endif;

							if ( empty( $tab['content'] ) ) {
								$tab['content'] = '';
							}

							if ( ( !empty( $tab['display_read_more_link'] ) && $tab['display_read_more_link'] == true ) && ( !empty( $tab['read_more_section_id'] ) ) ) {
								if ( substr( $tab['content'], -4 == '</p>' ) ) {
									$tab['content'] = rtrim($tab['content'], '</p>');
									$tab['content'] .= ' <a class="guide__link" href="#' . $tab['read_more_section_id'] . '">Read more</a></p>';
								} else {
									$tab['content'] .= ' <a class="guide__link" href="#' . $tab['read_more_section_id'] . '">Read more</a>';
								}
							}

							if ( !empty( $tab['content'] ) ) {
								echo crb_content( $tab['content'] );
							}
							?>
						</div><!-- /.guide__tab-body -->
					</div><!-- /.guide__tab -->
				<?php endforeach ?>
			</div><!-- /.guide__tabs -->
		<?php endif ?>
	</div><!-- /.guide -->
</div>