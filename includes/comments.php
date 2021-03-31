<?php
/**
 * Renders a single comments; Called for each comment
 */
function crb_render_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment__entry">
			<div class="comment__author vcard">
				<?php echo get_avatar( $comment, 48, '', '', [ 'class' => "comment__author-avatar" ] ); ?>
				<?php comment_author_link(); ?>
				<span class="comment__author-says"><?php _e( 'says:', 'crb' ); ?></span>
			</div><!-- /.comment__author -->

			<?php if ( $comment->comment_approved === '0' ) : ?>
				<em class="moderation-notice"><?php _e( 'Your comment is awaiting moderation.', 'crb' ); ?></em><br />
			<?php endif; ?>

			<div class="comment__meta">
				<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
					<?php printf( __( '%1$s at %2$s', 'crb' ), get_comment_date(), get_comment_time() ); ?>
				</a>

				<?php edit_comment_link( __( '(Edit)', 'crb' ), '  ', '' ); ?>
			</div><!-- /.comment__meta -->
			
			<div class="comment__text">
				<?php comment_text(); ?>
			</div><!-- /.comment__text -->
	
			<div class="comment__reply">
				<?php
				comment_reply_link( array_merge( $args, array(
					'depth'     => $depth,
					'max_depth' => $args['max_depth']
				) ) );
				?>
			</div><!-- /.comment__reply -->
		</div><!-- /.comment__entry -->
	<?php
}