/**
 * WordPress dependencies
 */
const { test, expect } = require('@wordpress/e2e-test-utils-playwright');

test.describe('Validate WordPress Importer', () => {
    test.beforeEach(async ({ admin }) => {
        await admin.visitAdminPage('tools.php');
    });

    test('Check Start Configuration and WordPress importer', async ({ admin, page }) => {
        // Generic Check For Activity Tab for ensuring better page loading 
        await page.waitForSelector("#wpbody-content > div.wrap > h1");
        await page.locator('role=link[name="Blogger To WordPress Redirection"]').click();
        await page.waitForSelector("#btowp_h2");
        await expect(page).toHaveURL(/rt-blogger-to-wordpress-redirection/);
        // Check start configuration visibility and validate button
        await page.focus("#content_block > h3 > u");
        await page.locator("#start_config").click();
        // check For message is appearing
        await page.waitForSelector("#error_msg");
        const buttonLink = await page.locator("#get_config > strong");
        await buttonLink.click();
        // Check For page load
        await page.locator("#wpbody-content > div.wrap > h1").first();
        // Check for Live Journal
        const tweets = await page.locator("tr:nth-child(7) > td.import-system > span.importer-action > a").first();
        const getText = await tweets.evaluate(node => node.innerText);

        if (getText == 'Install Now') {
            await page.locator('[aria-label="Install WordPress now"]').click();
            // Check page load
            await Promise.all([
                page.waitForNavigation(),
                //page.locator('text=Activate Plugin & Run Importer').click()
                page.locator('[aria-label="Run Blogger Importer"]').click()
            ]);
            // Validate WordPress Importer
            await page.waitForSelector("#wpbody-content > div.wrap > h2");
            // Validate upload button
            await expect(page.locator("#upload")).toBeVisible();
            // Reset Settings
            // Goto Plugins Page
            await admin.visitAdminPage("plugins.php")
            // Click [aria-label="Deactivate Blogger Importer"]
            await Promise.all([
                page.waitForNavigation(),
                page.locator('[aria-label="Deactivate WordPress Importer"]').click()
            ]);
            // Delete Blogger Importer
            page.on('dialog', dialog => dialog.accept());
            await page.locator('[aria-label="Delete WordPress Importer"]').click();
        }

    });

});