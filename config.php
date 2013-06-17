<?php

error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

define('TESTSUITE_TITLE',  'Ouija');
define('TESTSUITE_SUITEDIR', 'suites');
define('TESTSUITE_RESULTDIR',  'results');

$sites = array(
	array(
		'url' => 'http://www.example.com',
		'name' => 'Test Suite',	
		'code' => 'testsuite'
	),
	array(
		'url' => 'http://www.casperjs.org',
		'name' => 'CasperJS',	
		'code' => 'casper'
	)
);

// Do not change values below this line

$request_uri = substr(strrchr($_SERVER['REQUEST_URI'],'/'), 1);
$root = substr($_SERVER['REQUEST_URI'], 0, - strlen($request_uri));

define('TESTSUITE_ROOT', $root);

// Sanity checks!
exec('which phantomjs', $output);
if($output == array()) {
    echo 'PHP cannot find phantomjs - check it\'s available in your $PATH - ' . getenv('PATH');;
    exit;
}
exec('which casperjs', $output);
if($output == array()) {
    echo 'PHP cannot find casperjs - check it\'s available in your $PATH - ' . getenv('PATH');;
    exit;
}




