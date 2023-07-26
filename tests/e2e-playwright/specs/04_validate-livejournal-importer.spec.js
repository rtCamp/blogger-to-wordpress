/**
 * WordPress dependencies
 */
const { test } = require('@wordpress/e2e-test-utils-playwright');
const { selectors } = require('../utils/selectors');
const { CommonFunction } = require('../page/Functions.js');

test.describe('Validate Live Journal Importer', () => {
    test('Check Start Configuration and Live Journal', async ({ admin, page }) => {
        await admin.visitAdminPage('tools.php');
        const CommonFunctionobj = new CommonFunction(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading, selectors.bloggerToWordpressLink, selectors.bloggertoWordressHeading, selectors.urltoValidate);
        await CommonFunctionobj.validateClickButtonVisibility(selectors.startConfigurationHeading, selectors.startConfigButton, selectors.errorMessage, selectors.errorValidateText);
        await CommonFunctionobj.validateAllImport(selectors.liveJournalImportLink, selectors.installJournal, selectors.runLiveJournal, selectors.validateUser, selectors.validatePassword,selectors.deactivateJournal,selectors.deleteJournal);
    });

});