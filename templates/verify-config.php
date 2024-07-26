<?php
/**
 * Verify Config Response
 *
 * @package Blogger_To_WordPress
 */

?>

<h3>
	<u><?php esc_html_e( 'Test Case', 'blogger-to-wordpress-redirection' ); ?></u>
</h3>
<pre class="test-cases">
	<?php esc_html_e( 'Clicking this link', 'blogger-to-wordpress-redirection' ); ?>
	&raquo;
	<b>
		<a id="blogger_url" href="" target="_blank"></a>
	</b>
	<br/>
	<?php esc_html_e( 'Should redirect to', 'blogger-to-wordpress-redirection' ); ?>
	&raquo;
	<b>
		<a id="local_url" href="" target="_blank"></a>
	</b>
</pre>
<p>
	<b>
		<?php
		echo wp_kses(
			__( 'If you are stuck, you can use our <a href="https://bloggertowp.org/tutorials/blogger-to-wordpress-redirection-plugin/" target="_blank">free support forum</a> or <a href="https://bloggertowp.org/contact-us/" target="_blank">hire us.</a>', 'blogger-to-wordpress-redirection' ),
			array(
				'a' => array(
					'href'   => array(),
					'target' => array(),
				),
			)
		);
		?>
	</b>
</p>
