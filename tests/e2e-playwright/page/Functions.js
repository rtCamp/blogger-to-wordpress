const { expect } =require ("@playwright/test");
const {selectors} =require('../utils/selectors')
exports.CommonFunction = class CommonFunction {
    constructor(page) {
        this.page = page
    }

    //  This function is used to navigate to the blogger to WordPress page
    async navigateToBloggerPage(heading, bloggerToWordpressLink, bloggertoWordressHeading, validateURL) {
        await this.page.waitForSelector(heading);
        await this.page.focus(bloggerToWordpressLink);
        // Click The link and check for page URL
        await this.page.locator(bloggerToWordpressLink).click();
        await this.page.waitForSelector(bloggertoWordressHeading);
        await expect(this.page).toHaveURL(validateURL);
    }

    // This function is used to validate page heading and button visibility
    async validateButtonVisibility(focusHeading,button){
        await this.page.focus(focusHeading);
        await expect(this.page.locator(button)).toBeVisible();
    }
   // This function is used to validate button visibility and assert Message
    async validateClickButtonVisibility(focusHeading, button,errorMessage,validateMessage) {
        await this.page.focus(focusHeading);
        await expect(this.page.locator(button)).toBeVisible();
        await this.page.locator(button).click();
        await expect(this.page.locator(errorMessage).first()).toContainText(validateMessage)
    }
   // This function is used to validate all kinds of generic importer
    async validateAllImport(importLink, installItem, runItem, validateHeader, validateMsg, deactivateItem, deleteItem){
        await this.page.locator(selectors.importFromBloggerLink).click();
        // Check For page load
        await this.page.locator(selectors.importHeader).first();
        // Check for import
        const tweets = await this.page.locator(importLink).first().innerText();
        if (tweets == 'Install Now') {
            await this.page.locator(installItem).click();
            // Check page load
            await Promise.all([
                this.page.locator(runItem).click()
            ]);
            await this.page.waitForSelector(validateHeader);
            // Validate 
            await expect(this.page.locator(validateMsg)).toBeVisible();
            // Reset Settings
                // Goto Plugins Page
            await this.page.goto("./wp-admin/plugins.php");
            
            await Promise.all([
              
                this.page.locator(deactivateItem).click()
            ]);
            // Delete  Importer
            this.page.on('dialog', dialog => dialog.accept());
            await this.page.locator(deleteItem).click();
        }
    }
    async validateUploadImport(importLink, installItem, runItem, validateHeader, validateMsg, deactivateItem, deleteItem) {
        await this.page.locator(selectors.importFromBloggerLink).click();
        // Check For page load
        await this.page.locator(selectors.importHeader).first();
        // Check for import
        const tweets = await this.page.locator(importLink).first().innerText();
        if (tweets == 'Install Now') {
            await this.page.locator(installItem).click();
            // Check page load
            await Promise.all([
                this.page.locator(runItem).click()
            ]);
            await this.page.waitForSelector(validateHeader);
            // Validate 
            await expect(this.page.locator(validateMsg)).toBeVisible();
            //Upload
            const xmlPath = "assets/dummy.xml";
            const [fileChooser] = await Promise.all([
                // It is important to call waitForEvent before click to set up waiting.
                this.page.waitForEvent('filechooser'),
                // Opens the file chooser.
               this.page.locator(selectors.uploadButton).click(),
            ])
            await fileChooser.setFiles([
                xmlPath,
            ])
            await this.page.locator("#submit").click();
            // Reset Settings
            // Goto Plugins Page
            await this.page.goto("./wp-admin/plugins.php");

            await Promise.all([

                this.page.locator(deactivateItem).click()
            ]);
            // Delete  Importer
            this.page.on('dialog', dialog => dialog.accept());
            await this.page.locator(deleteItem).click();
        }
    }
}