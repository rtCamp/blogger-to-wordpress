/**
 * B2W Javascript functions.
 *
 * @package Blogger_To_WordPress
 */

/**
 * Gets configuration and appends to dom.
 *
 * @param {String} nonce
 *
 * @returns {void}
 */
function rt_start_config( nonce ){

	if ( jQuery( '#get_config' ).html() != '' ) {
		jQuery( '#get_config' ).html( '' );
	}

	jQuery.ajax(
		{
			url:'admin-ajax.php',
			type: 'POST',
			data: 'action=rt_b2wr_get_config&nonce=' + nonce,
			success: function(result){
				jQuery( '#get_config' ).append( result );
			}
		}
	);
}
/**
 * Generates blogger code
 *
 * @param {String} domain_name
 * @param {String} curr_domain
 * @param {String} nonce
 *
 * @returns {void}
 */
function generate_code( domain_name, curr_domain, nonce){

	jQuery( '#code_here' ).show();
	var response = jQuery( '#code_here' ).html();
	response = response.replace( /{{curr_domain}}/g, curr_domain );
	response = response.replace( /{{domain_name}}/g, domain_name );
	response = response.replace( /{{nonce}}/g, nonce );
	jQuery( '#code_here' ).html( response );

}

/**
 * Checks configuration
 *
 * @param {String} domain_name domain name
 * @param {String} nonce nonce
 *
 * @returns {void}
 */
function check_configuration( domain_name, nonce ) {

	if ( jQuery( '#verify_config' ).html() != '' ) {
		jQuery( '#verify_config' ).html( '' );
	}

	jQuery.ajax(
		{
			url:'admin-ajax.php',
			type: 'POST',
			data: 'action=rt_b2wr_verify_config&dname=' + domain_name + '&config_nonce=' + nonce,
			success: function(result) {
				jQuery( '#verify_config' ).append( result );
			}
		}
	);
}

jQuery( '#hide_b2wr_notice_block' ).click(
	function() {

		var nonce = $( '#b2wr_nonce_field' ).val();

		jQuery.ajax(
			{
				url:'admin-ajax.php',
				type: 'POST',
				data: 'action=rt_b2wr_hide_notice_block&update_nonce=' + nonce,
				success: function( result ) {
					jQuery( '#b2wr_notice_block' ).slideUp( 'slow','linear' );
				}
			}
		);
	}
);
