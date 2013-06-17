
casper.test.begin('CasperJS Google Test', 1, function suite(test) {
    casper.start("http://www.google.com/", function() {
        this.fill('form[action="/search"]', {
            q: "casperjs"
        }, true);
    });

    casper.then(function() {
        test.assertSelectorContains(".g", "casperjs.org", "casperjs.org is first ranked");
    });

    casper.run(function() {
        test.done();
    });
});
