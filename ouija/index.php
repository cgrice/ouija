<?php

require 'config.php';

$all_suites = '';

foreach($sites as $i => $site) {

	$tests = 0;
	$fails = 0;
	$class = '';
	$timestamp = null;

	$results_path = $site['code'] . '.xml';

    $all_suites .= 'site[]=' . $site['code'] . '&';

	$testsuites = @simplexml_load_file(TESTSUITE_RESULTDIR.'/'.$results_path);
	
	if($testsuites) { 
		foreach($testsuites as $suite) {
			$tests += (int)$suite['tests'];
			$fails += (int)$suite['failures'];
			$timestamp = strtotime($suite['timestamp']);
		}
	}

	$passes = $tests - $fails;

	$sites[$i]['passes'] = $passes;
	$sites[$i]['fails'] = $fails;

	if($timestamp == 0) {
		$sites[$i]['last_ran'] = 'Never';
	} else {
		$sites[$i]['last_ran'] = date('Y-m-d H:i:s', $timestamp);
	}

	if($fails > 0) {
		$sites[$i]['class'] = 'class="fails"';
	}
	else if($passes > 0) {
		$sites[$i]['class'] = 'class="passes"';
	} 
	else {
		$sites[$i]['class'] = '';
	}
}

$all_suites = rtrim($all_suites, '&');

include 'inc/header.php';

?>

	<div class="container">
		<div class="page-header">
			<h1><?php echo TESTSUITE_TITLE; ?></h1>	
		</div>
		<div class="row">
			<table class="span12 table table-striped table-bordered">	
				<thead>
				<tr>
					<th>Site</th>
					<th>URL</th>
					<th>Results</th>
					<th>Last ran</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				<?php foreach($sites as $site) { ?>
					<tr <?php echo $site['class']; ?>>
						<td><?php echo $site['name']; ?></td>
						<td><?php echo $site['url']; ?></td>
						<td>
                            <?php if ($site['last_ran'] != 'Never') { ?>
                            <b><?php echo $site['passes']; ?></b> passed / <b><?php echo $site['fails']; ?></b> failed
                            <?php } ?>
                        </td>
						<td><?php echo $site['last_ran']; ?></td>
						<td width="15%"><a href="<?php echo TESTSUITE_ROOT; ?>runtests.php?site=<?php echo $site['code']; ?>" class="btn btn-primary runtests">Run Tests</a></td>
					</tr>
				<?php } ?>
                    <tr>
                        <td colspan="4"></td>
						<td width="15%"><a href="<?php echo TESTSUITE_ROOT; ?>runtests.php?<?php echo $all_suites ?>" class="btn btn-primary runtests">Run All</a></td>
				</tbody>
			</table>	
		</div>
	</div>

<?php

include 'inc/footer.php';

?>


