/**
 * WordPress dependencies
 */
const { test, expect } = require('@wordpress/e2e-test-utils-playwright');
const { selectors } = require('../utils/selectors');
const { CommonFunction } = require('../page/Functions.js');

test.describe('Upload xml blogger importer', () => {
    
    test('Check upload functionality blogger importer', async ({ admin, page }) => {
        await admin.visitAdminPage('tools.php');
        const CommonFunctionobj = new CommonFunction(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading, selectors.bloggerToWordpressLink, selectors.bloggertoWordressHeading, selectors.urltoValidate);
        await CommonFunctionobj.validateClickButtonVisibility(selectors.startConfigurationHeading, selectors.startConfigButton, selectors.errorMessage, selectors.errorValidateText);
        await CommonFunctionobj.validateUploadImport(selectors.bloggerImportLink, selectors.installBlogger, selectors.runBlogger, selectors.uploadHeader, selectors.uploadButton, selectors.deactiveBlogger, selectors.deleteBlogger);
    });
});