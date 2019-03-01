<?php
/**
 * Get config template file
 *
 * @package blogger-to-wordpress
 */

?>

<?php
if ( empty( $results ) ) {
	?>

	<p id="error_msg">Sorry… No posts found that were imported from a Blogger.com blog</p>
	<strong>
		<a href="<?php echo esc_url( RT_B2WR_BLOG_URL . '/wp-admin/admin.php?import=blogger' ); ?> ">Import from Blogger.com</a>
	</strong> first and then "Start Configuration"

	<?php
	die();
}
?>
	<br/>
	<h3><u>List of Blogs</u></h3>
	We found posts from following Blogger Blog(s) in your current WordPress installation. Click on <b>Get Code</b> button to generate the redirection code for the chosen Blogger blog<br /><br />

	<table width="350px">
		<?php
		foreach ( $results as $index => $result ) {
			$nonce   = wp_create_nonce( 'b2w_code_nonce' );
			$site_no = $index + 1;
			?>

			<tr>
			<td width="15px"><?php echo esc_html( $site_no ); ?></td>
			<td><b><?php echo esc_html( $result->meta_value ); ?> </b></td>
			<td  width="75px"><input type="submit" class="button" onclick = "generate_code(<?php echo sprintf( '\'%1$s\',\'%2$s\',\'%3$s\',\'%4$s\'', esc_js( $site_no ), esc_js( $result->meta_value ), esc_js( RT_B2WR_BLOG_URL ), esc_js( $nonce ) ); ?>);" name="start" value="Get Code"/></td>
			</tr>

			<?php
		}
		?>
	</table>

	<div id ="code_here"></div>
