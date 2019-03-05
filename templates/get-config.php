<?php
/**
 * Get config template file
 *
 * @package Blogger_To_WordPress
 */

?>

<?php
if ( empty( $results ) ) {
	?>

	<p id="error_msg"><?php esc_html_e( 'Sorry… No posts found that were imported from a Blogger.com blog', 'blogger-to-wordpress' ); ?></p>

	<strong>
		<a href="<?php echo esc_url( RT_B2WR_BLOG_URL . '/wp-admin/admin.php?import=blogger' ); ?> "><?php esc_html_e( 'Import from Blogger.com', 'wordpress-to-blogger' ); ?></a>
	</strong>

	<?php esc_html_e( 'first and then "Start Configuration"', 'blogger-to-wordpress' ); ?>

	<?php
	die();
}
?>
	<br/>

	<h3><u> <?php printf( '%1$s', esc_html__( 'List of Blogs' ) ); ?> </u></h3>

	<?php
		printf(
			'%1$s',
			wp_kses(
				__( 'We found posts from following Blogger Blog(s) in your current WordPress installation. Click on <b>Get Code</b> button to generate the redirection code for the chosen Blogger blog<br /><br />', 'blogger-to-wordpress' ),
				array(
					'br' => array(),
					'b'  => array(),
				)
			)
		);
		?>

	<table width="350px">

		<?php
		foreach ( $results as $index => $result ) {

			$nonce = wp_create_nonce( 'b2w_code_nonce' );

			$site_no = $index + 1;

			?>

			<tr>
				<td width="15px"><?php echo esc_html( $site_no ); ?></td>
				<td><b><?php echo esc_html( $result->meta_value ); ?> </b></td>
				<td  width="75px"><input type="submit" class="button" onclick = "generate_code(<?php echo sprintf( '\'%1$s\',\'%2$s\',\'%3$s\'', esc_js( $result->meta_value ), esc_js( RT_B2WR_BLOG_URL ), esc_js( $nonce ) ); ?>);" name="start" value="<?php esc_attr_e( 'Get Code', 'blogger-to-wordpress' ); ?>"/></td>
			</tr>

			<?php
		}
		?>

	</table>

	<div id ="code_here" class="blogger-code">
		<?php require_once RT_B2WR_PLUGIN_DIR . 'templates/blogger-code.php'; ?>
	</div>
