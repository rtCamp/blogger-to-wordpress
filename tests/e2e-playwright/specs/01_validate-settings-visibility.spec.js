/**
 * WordPress dependencies
 */
const { test, expect } = require( '@wordpress/e2e-test-utils-playwright' );

test.describe('Validate Start Configuration', () => {
    test.beforeEach(async ( { admin } ) => {
        await admin.visitAdminPage( 'tools.php' );
    });
    test('Check Blogger to WordPress is visible in the menu', async ({ page }) => {
        // Generic Check For Activity Tab for ensuring better page loading 
        await page.waitForSelector("#wpbody-content > div.wrap > h1");
        // Check For Menu link is present
        await page.focus('role=link[name="Blogger To WordPress Redirection"]');
        // Click The link and check for page URL
        await page.locator('role=link[name="Blogger To WordPress Redirection"]').click();
        await page.waitForSelector("#btowp_h2");
        await expect(page).toHaveURL(/rt-blogger-to-wordpress-redirection/);
        // Check start configuration visibility and validate button
        await page.focus("#content_block > h3 > u");
        await expect(page.locator("#start_config")).toBeVisible();
    });
});