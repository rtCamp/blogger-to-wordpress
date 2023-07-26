const selectors ={
    toolsHeading: "#wpbody-content > div.wrap > h1",
    bloggerToWordpressLink: 'role=link[name="Blogger To WordPress Redirection"]',
    bloggertoWordressHeading: "#btowp_h2",
    urltoValidate: /rt-blogger-to-wordpress-redirection/,
    startConfigurationHeading: "#content_block > h3 > u",
    startConfigButton: "#start_config",
    errorMessage: "#error_msg",
    errorValidateText: "Sorry… No posts found that were imported from a Blogger.com blog",
    importFromBloggerLink: "#get_config > strong",
    importHeader: "#wpbody-content > div.wrap > h1",

    //Blogger Importer locators
    bloggerImportLink: "tr:nth-child(1) > td.import-system > span.importer-action > a",
    installBlogger: '[aria-label="Install Blogger now"]',
    runBlogger: '[aria-label="Run Blogger Importer"]',
    uploadHeader: "#wpbody-content > div.wrap > h2",
    uploadButton: "#upload",
    deactiveBlogger: '[aria-label="Deactivate Blogger Importer"]',
    deleteBlogger: '[aria-label="Delete Blogger Importer"]',
    
    // Live Journal Locators
    liveJournalImportLink: "tr:nth-child(3) > td.import-system > span.importer-action > a",
    installJournal: '[aria-label="Install LiveJournal now"]',
    runLiveJournal: '[aria-label="Run LiveJournal Importer"]',
    deactivateJournal: '[aria-label="Deactivate LiveJournal Importer"]',
    deleteJournal: '[aria-label="Delete LiveJournal Importer"]',
    validateUser: 'label:has-text("LiveJournal Username")',
    validatePassword: 'th:has-text("Protected Post Password")',

    // WordPress Importer Locators
    wordpressImportLink: "tr:nth-child(7) > td.import-system > span.importer-action > a",
    installWordPress: '[aria-label="Install WordPress now"]',
    runWordPress: '[aria-label="Run WordPress Importer"]',
    deactivateWordPress: '[aria-label="Deactivate WordPress Importer"]',
    deleteWordPress: '[aria-label="Delete WordPress Importer"]'
}

module.exports ={selectors}