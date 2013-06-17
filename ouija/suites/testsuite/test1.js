/*global casper*/
/*jshint strict:false*/

casper.test.begin('Test One', 3, {

    test: function(test) {
        casper.test.comment('this is test 1');
        casper.test.assertTrue(true);
        casper.test.assertTrue(true, 'True is True!');
        casper.test.assertTrue(false, 'False is True?');
        casper.test.done();
    }
});
