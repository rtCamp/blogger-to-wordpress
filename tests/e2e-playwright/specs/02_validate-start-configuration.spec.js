/**
 * WordPress dependencies
 */
const { test } = require( '@wordpress/e2e-test-utils-playwright' );
const { selectors } = require( '../utils/selectors' );
const { BloggerToWordPress } = require( '../page/BloggerToWordPress.js' )
test.describe('Validate Start options are visible', () => {
    
    test('Check Start Configuration', async ({ admin, page }) => {
        const CommonFunctionobj = new BloggerToWordPress(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading, selectors.bloggerToWordpressLink, selectors.bloggertoWordressHeading, selectors.urltoValidate);
        await CommonFunctionobj.validateClickButtonVisibility(selectors.startConfigurationHeading, selectors.startConfigButton, selectors.errorMessage, selectors.errorValidateText);
    });

});