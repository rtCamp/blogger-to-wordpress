/**
 * WordPress dependencies
 */
const { test } = require( '@wordpress/e2e-test-utils-playwright' );
const { selectors } = require( '../utils/selectors' );
const { BloggerToWordPress } = require( '../page/BloggerToWordPress.js' )

test.describe('Validate WordPress Importer', () => {
   
    test('Check Start Configuration and WordPress importer', async ( { admin, page } ) => {
        const CommonFunctionobj = new BloggerToWordPress(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading, selectors.bloggerToWordpressLink, selectors.bloggertoWordressHeading, selectors.urltoValidate);
        await CommonFunctionobj.validateClickButtonVisibility(selectors.startConfigurationHeading, selectors.startConfigButton, selectors.errorMessage, selectors.errorValidateText);
        await CommonFunctionobj.validateAllImport(selectors.wordpressImportLink,selectors.installWordPress,selectors.runWordPress,selectors.uploadHeader,selectors.uploadButton,selectors.deactivateWordPress,selectors.deleteWordPress);
    });

});