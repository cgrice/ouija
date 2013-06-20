<?php

include 'config.php';

$suites = array();
$output = FALSE;

if($_REQUEST) {

} else {
    $shortopts  = "";
    $longopts  = array(
        "suites:",     // Required value
        "mailto",     // Required value
        "output",     // Required value
    );

    $options = getopt($shortopts, $longopts);

    if(isset($options['suites'])) {
        $suites = explode(',', $options['suites']);
    }
    
    if(isset($options['mailto'])) {
        $mailto = explode(',', $options['mailto']);
    }

    if(isset($options['output'])) {
        $output = TRUE;
    }
}

foreach($suites as $suite) {
    run_tests($suite, $output);
}

