<?php
include 'config.php';

$results = array();
$results_path = $_GET['site'] . '.xml';
$output_path = TESTSUITE_RESULTDIR . '/' . $_GET['site'] . '.txt';

$testsuites = simplexml_load_file(TESTSUITE_RESULTDIR.'/'.$results_path);

foreach($testsuites->children() as $testsuite) {    

    $class = (string)$testsuite['package'];

    if(isset($results[$class]) == FALSE) {
        $results[$class] = array(
            'name' => (string)$testsuite['name'],
            'tests' => array(),
            'passes' => 0,
            'fails' => 0
        );
    }
    foreach($testsuite->children() as $testcase) {
        if($testcase->getName() == 'system-out') continue;
        if($testcase->getName() == 'error') continue;

        $result = ((string)$testcase->failure == '');
        $msg = (string)$testcase['name'];

        $results[$class]['tests'][] = array(
            'passed' => $result,
            'test' => $msg
        );

    	if($result) {
	        $results[$class]['passes'] += 1;
	    } else {
	        $results[$class]['fails'] += 1;
	    }
    }
}

$totalpasses = 0;
$totalfails = 0;

foreach($results as $class => $result) {
	$totalpasses += $results[$class]['passes'];
	$totalfails += $results[$class]['fails'];
}

include 'inc/header.php';

?>
        <div class="container">

	    <br/>

	    <ul class="breadcrumb">
		  <li><a href="<?php echo TESTSUITE_ROOT; ?>">Home</a> <span class="divider">/</span></li>
		  <li class="active"><?php echo $_GET['site']; ?></li>
	    </ul>

        <div class="page-header">
	    	<div class="pull-right">
                <a class="btn btn-primary runtests" href="<?php echo TESTSUITE_ROOT; ?>runtests.php?site=<?php echo $_GET['site']; ?>">Run Tests</a>
                <a class="btn btn-info" id="togglecode">Show log</a>
            </div>
            <h1>Test Results</h1>
        </div>

        <div class="well code" id="output">
            <?php echo file_get_contents($output_path); ?>
        </div>

        <div class="row">

<?php
        $i = 0;
        foreach($results as $class=>$result) {
            if($i != 0 && $i % 3 == 0) {
                echo '</div>';
                echo '<div class="row">';
            }   
            $i++;
?>
            <div class="span4 testfile">
                <div class="page-header">
                    <h3 <?php if($result['fails'] > 0) { echo 'class="text-error"'; } ?>>
                        <?php echo $result['name']; ?>
                    </h3>
                </div>

                  
                <ol>
                <?php foreach($result['tests'] as $test) { ?>
                <?php
                    $resultclass = 'pass text-success';
                    if($test['passed'] == FALSE) { 
                        $resultclass = 'fail text-error';
                    }
                ?>
                    <li>
                        <span class="test<?php echo $resultclass;?>">
                            <?php echo $test['test']; ?>
                        </span>
                    </li>
                <?php } ?>
                </ol>

            </div>
<?php
}
?>
        </div>
    </div>

<?php
    include 'inc/footer.php';
?>
