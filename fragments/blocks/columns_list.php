<?php extract( $fields );
if ( !empty( $columns_list ) ) : ?>
	<div>
		<dl>
			<?php foreach ( $columns_list as $list_item ) : ?>
				<dt><?php esc_html_e( $list_item['title'] ); ?></dt>

				<dd><?php echo nl2br( $list_item['text'] ); ?></dd>
			<?php endforeach ?>
		</dl>
	</div>
<?php endif ?>
