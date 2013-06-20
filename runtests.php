<?php

require 'config.php';

if(is_array($_GET['site'])) {
    foreach($_GET['site'] as $suite) {
        run_tests($suite);
    }

    header('Location: '.TESTSUITE_ROOT);exit;
} else {
    run_tests($_GET['suite']);
    header('Location: '.TESTSUITE_ROOT.'results.php?site=' . $_GET['site']);exit;
}
