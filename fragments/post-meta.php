<?php
/**
 * Displays the post date/time, author, tags, categories and comments link.
 * 
 * Should be called only within The Loop.
 * 
 * It will be displayed only for post type "post".
 */

if ( empty( $post ) || get_post_type() !== 'post' ) {
	return;
}
?>

<div class="article__meta">
	<p>
		<?php the_time( 'F jS, Y ' ); printf( __( 'by %s', 'crb' ), get_the_author() ); ?> |

		<?php _e( 'Posted in ', 'crb' ); the_category( ', ' ); ?> |

		<?php
		if ( comments_open() ) {
			comments_popup_link( __( 'No Comments', 'crb' ), __( '1 Comment', 'crb' ), __( '% Comments', 'crb' ) );
		}
		?>
	</p>

	<?php the_tags( '<p>' . __( 'Tags:', 'crb' ) . ' ', ', ', '</p>' ); ?>
</div><!-- /.article__meta -->