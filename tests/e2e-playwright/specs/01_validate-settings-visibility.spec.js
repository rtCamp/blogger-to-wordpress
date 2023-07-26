/**
 * WordPress dependencies
 */
const { test } = require( '@wordpress/e2e-test-utils-playwright' );
const {selectors} =require( '../utils/selectors' );
const { CommonFunction } = require( '../page/Functions.js' )

test.describe('Validate Start Configuration', () => {
    
    test('Check Blogger to WordPress is visible in the menu', async ( {admin,page } ) => {
        await admin.visitAdminPage('tools.php');
        const CommonFunctionobj = new CommonFunction(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading,selectors.bloggerToWordpressLink,selectors.bloggertoWordressHeading,selectors.urltoValidate);
        await CommonFunctionobj.validateButtonVisibility(selectors.startConfigurationHeading,selectors.startConfigButton);
        
    });
});