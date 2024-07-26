/**
 * B2W Javascript functions.
 *
 * @package Blogger_To_WordPress
 */

/**
 * Gets configuration and appends to dom.
 *
 * @returns {void}
 */
function rt_start_config(){
	jQuery( '#get_config' ).show();
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
	let blogger_code = jQuery( '#blogger-code-textarea' ).val();
	blogger_code = blogger_code.replace( /{{curr_domain}}/g, curr_domain );
	jQuery( '#blogger-code-textarea' ).val( blogger_code );
	jQuery( '#redirection-domain-name-1' ).attr( 'href', domain_name );
	jQuery( '#redirection-domain-name-1' ).text( domain_name );
	jQuery( '#redirection-domain-name-2' ).text( domain_name );
	jQuery( '#check_config' ).attr( 'onClick', 'check_configuration("' + domain_name + '","' + nonce + '")' );
	jQuery( '#code_here' ).show();
	jQuery( '#verify_config' ).hide();
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
	jQuery.ajax(
		{
			url:'admin-ajax.php',
			type: 'POST',
			data: 'action=rt_b2wr_verify_config&dname=' + domain_name + '&config_nonce=' + nonce,
			success: function(result) {
				const { blogger_url, local_url } = JSON.parse(result);
				jQuery( '#blogger_url' ).attr( 'href', blogger_url );
				jQuery( '#local_url' ).attr( 'href', local_url );
				jQuery( '#blogger_url' ).text( blogger_url );
				jQuery( '#local_url' ).text( local_url );
				jQuery( '#verify_config' ).show();
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
