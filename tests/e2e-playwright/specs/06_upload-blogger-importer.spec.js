/**
 * WordPress dependencies
 */
const { test, expect } = require('@wordpress/e2e-test-utils-playwright');

test.describe('Upload xml blogger importer', () => {
    test.beforeEach(async ({ admin }) => {
        await admin.visitAdminPage('tools.php');
    });
    test('Check upload functionality blogger importer', async ({ admin, page }) => {
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
        // Check for blogger import
        const tweets = await page.locator("tr:nth-child(1) > td.import-system > span.importer-action > a").first();
        const getText = await tweets.evaluate(node => node.innerText);

        if (getText == 'Install Now') {
            await page.locator('[aria-label="Install Blogger now"]').click();
            // Check page load
            await Promise.all([
                page.waitForNavigation(),
                //page.locator('text=Activate Plugin & Run Importer').click()
                page.locator('[aria-label="Run Blogger Importer"]').click()
            ]);
            await page.waitForSelector("#wpbody-content > div.wrap > h2");
            // Validate upload button
            await expect(page.locator("#upload")).toBeVisible();
            //Upload
            const xmlPath = "assets/dummy.xml";
            const [fileChooser] = await Promise.all([
                // It is important to call waitForEvent before click to set up waiting.
                page.waitForEvent('filechooser'),
                // Opens the file chooser.
                page.locator('#upload').click(),
                
                
            ])
            await fileChooser.setFiles([
                xmlPath,
            ])
          await  page.locator("#submit").click();
            // Reset Settings
            // Goto Plugins Page
            await admin.visitAdminPage("plugins.php")
            // Click [aria-label="Deactivate Blogger Importer"]
            await Promise.all([
                page.waitForNavigation(),
                page.locator('[aria-label="Deactivate Blogger Importer"]').click()
            ]);
            // Delete Blogger Importer
            page.on('dialog', dialog => dialog.accept());
            await page.locator('[aria-label="Delete Blogger Importer"]').click();
        }
    
    });

});