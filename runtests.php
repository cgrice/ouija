<?php

require 'config.php';
require 'ansi2html.php';

function run_tests($suite) {
    $suite_path = TESTSUITE_SUITEDIR . '/' . escapeshellcmd($suite);
    $results_path = TESTSUITE_RESULTDIR . '/' . escapeshellcmd($suite) . '.xml';
    $output_path = TESTSUITE_RESULTDIR . '/' . escapeshellcmd($suite) . '.txt';

    exec('casperjs test '.$suite_path.' --xunit='.$results_path.' --no-color 2>&1', $out);

    $out = nl2br(ansi2html(implode("\n", $out)));

    file_put_contents($output_path, $out);
}

if(is_array($_GET['site'])) {
    foreach($_GET['site'] as $suite) {
        run_tests($suite);
    }

    header('Location: '.TESTSUITE_ROOT);exit;
} else {
    run_tests($_GET['suite']);
    header('Location: '.TESTSUITE_ROOT.'results.php?site=' . $_GET['site']);exit;
}
