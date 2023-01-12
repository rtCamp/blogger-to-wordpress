/**
 * WordPress dependencies
 */
const { test, expect } = require('@wordpress/e2e-test-utils-playwright');

test.describe('Validate Start options are visible', () => {
    test.beforeEach(async ({ admin }) => {
        await admin.visitAdminPage('tools.php');
    });
   
    test('Check Start Configuration', async ({ admin, page }) => {
        // Generic Check For Activity Tab for ensuring better page loading 
        await page.waitForSelector("#wpbody-content > div.wrap > h1");
        await page.locator('role=link[name="Blogger To WordPress Redirection"]').click();
        await page.waitForSelector("#btowp_h2");
        await expect(page).toHaveURL(/rt-blogger-to-wordpress-redirection/);
        // Check start configuration visibility and validate button
        await page.focus("#content_block > h3 > u");
        await page.locator("#start_config").click();
        // check For message is appearing
        const msg = await page.locator("#error_msg").isVisible();
        if (msg) {
            console.log("Configure button is functional")
        }
        else {
            console.log("Configure button is not working")
        }

    });

});