/**
 * WordPress dependencies
 */
const { test, expect } = require( '@wordpress/e2e-test-utils-playwright' );
const {selectors} =require( '../utils/selectors' );
const { CommonFunction } = require('../page/Functions.js')

test.describe('Validate Start Configuration', () => {
    
    test('Check Blogger to WordPress is visible in the menu', async ({admin,page }) => {
        await admin.visitAdminPage('tools.php');
        const CommonFunctionobj = new CommonFunction(page);
        await CommonFunctionobj.navigateToBloggerPage(selectors.toolsHeading,selectors.bloggerToWordpressLink,selectors.bloggertoWordressHeading,selectors.urltoValidate);
        await CommonFunctionobj.validateButtonVisibility(selectors.startConfigurationHeading,selectors.startConfigButton);
        
        // without POM
        // // Generic Check For Activity Tab for ensuring better page loading 
        // await page.waitForSelector(selectors.toolsHeading);
        // // Check For Menu link is present
        // await page.focus('role=link[name="Blogger To WordPress Redirection"]');
        // // Click The link and check for page URL
        // await page.locator('role=link[name="Blogger To WordPress Redirection"]').click();
        // await page.waitForSelector("#btowp_h2");
        // await expect(page).toHaveURL(/rt-blogger-to-wordpress-redirection/);
        // // Check start configuration visibility and validate button
        // await page.focus("#content_block > h3 > u");
        // await expect(page.locator("#start_config")).toBeVisible();
    });
});