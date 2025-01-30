/**
 * WordPress dependencies
 */
const { test } = require( '@wordpress/e2e-test-utils-playwright' );
const {selectors} =require( '../utils/selectors' );
const { BloggerToWordPress } = require( '../page/BloggerToWordPress.js' )

test.describe('Validate Start Configuration', () => {
    test('Check Blogger to WordPress is visible in the menu', async ( {admin,page } ) => {
        await admin.visitAdminPage('/');
        const CommonFunctionobj = new BloggerToWordPress(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading,selectors.bloggerToWordpressLink,selectors.bloggertoWordressHeading,selectors.urltoValidate);
        await CommonFunctionobj.validateButtonVisibility(selectors.startConfigurationHeading,selectors.startConfigButton);  
    });
});