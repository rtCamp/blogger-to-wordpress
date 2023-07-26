/**
 * WordPress dependencies
 */
const { test, expect } = require('@wordpress/e2e-test-utils-playwright');
const { selectors } = require('../utils/selectors');
const { CommonFunction } = require('../page/Functions.js')
test.describe('Validate Start options are visible', () => {
    
    test('Check Start Configuration', async ({ admin, page }) => {
        await admin.visitAdminPage('tools.php');
        const CommonFunctionobj = new CommonFunction(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading, selectors.bloggerToWordpressLink, selectors.bloggertoWordressHeading, selectors.urltoValidate);
        await CommonFunctionobj.validateClickButtonVisibility(selectors.startConfigurationHeading, selectors.startConfigButton, selectors.errorMessage, selectors.errorValidateText);

        // Without POM
        // // Generic Check For Activity Tab for ensuring better page loading 
        // await page.waitForSelector("#wpbody-content > div.wrap > h1");
        // await page.locator('role=link[name="Blogger To WordPress Redirection"]').click();
        // await page.waitForSelector("#btowp_h2");
        // await expect(page).toHaveURL(/rt-blogger-to-wordpress-redirection/);
        // // Check start configuration visibility and validate button
        // await page.focus("#content_block > h3 > u");
        //await page.locator(selectors.startConfigButton).click();
        // check For message is appearing
        //await expect(page.locator().first()).toContainText("Sorry… No posts found that were imported from a Blogger.com blog");
        
    });

});