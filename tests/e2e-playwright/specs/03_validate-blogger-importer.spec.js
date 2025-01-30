/**
 * WordPress dependencies
 */
const { test } = require( '@wordpress/e2e-test-utils-playwright' );
const { selectors } = require( '../utils/selectors' );
const { BloggerToWordPress } = require( '../page/BloggerToWordPress.js' )

test.describe('Validate blogger importer', () => {

    test('Check Start Configuration and blogger importer', async ( { admin,page } ) => {
        const CommonFunctionobj = new BloggerToWordPress(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading, selectors.bloggerToWordpressLink, selectors.bloggertoWordressHeading, selectors.urltoValidate);
        await CommonFunctionobj.validateClickButtonVisibility(selectors.startConfigurationHeading, selectors.startConfigButton, selectors.errorMessage, selectors.errorValidateText);
        await CommonFunctionobj.validateAllImport(selectors.bloggerImportLink, selectors.installBlogger, selectors.runBlogger, selectors.uploadHeader, selectors.uploadButton,selectors.deactiveBlogger,selectors.deleteBlogger);

    });

});