<?php

include 'ansi2html.php';

function run_tests($suite, $output = FALSE) {
    $out = array();

    $suite_path = TESTSUITE_SUITEDIR . '/' . escapeshellcmd($suite);
    $results_path = TESTSUITE_RESULTDIR . '/' . escapeshellcmd($suite) . '.xml';
    $output_path = TESTSUITE_RESULTDIR . '/' . escapeshellcmd($suite) . '.txt';

    $cmd = 'casperjs test '.$suite_path.' --xunit='.$results_path.' --no-color 2>&1';

    if($output) {
        passthru($cmd);
    } else {
        exec($cmd, $out);
        $out = nl2br(ansi2html(implode("\n", $out)));
        file_put_contents($output_path, $out);
    }

    @chmod($results_path, 0766);
    @chmod($output_path, 0766);
}
