<?php
/**
 * Feeds template file
 *
 * @package blogger-to-wordpress
 */

?>
<ul>
	<?php

	if ( 0 === $maxitems ) {
		printf( '<li> %1$s </li>', esc_html__( 'No Items', 'blogger-to-wordpress' ) );
	} else {
		foreach ( $rss_items as $item ) {
			?>
			<li>
				<a href="<?php echo esc_url( $item->get_permalink() ); ?>" title="Posted <?php echo esc_attr( $item->get_date( 'j F Y | g:i a' ) ); ?>"><?php echo esc_html( $item->get_title() ); ?></a>
			</li>
			<?php
		}
	}
	?>
</ul>
