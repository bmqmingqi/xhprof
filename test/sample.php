<?php
require '../vendor/autoload.php';
function bar($x) {
  if ($x > 0) {
    bar($x - 1);
  }
}

function foo() {
  for ($idx = 0; $idx < 5; $idx++) {
    bar($idx);
    $x = strlen("abc");
  }
}

// start profiling
xhprof_enable();

// run program
foo();

// stop profiler
$xhprof_data = xhprof_disable();

// display raw xhprof data for the profiler run
print_r($xhprof_data);



 use xhprof\xhprof_lib\utils\xhprofLib;
 use xhprof\xhprof_lib\utils\xhprofRunsDefault;
// save raw data for this profiler run using default
// implementation of iXHProfRuns.
$xhprof_runs = new xhprofRunsDefault();

// save the run under a namespace "xhprof_foo"
$run_id = $xhprof_runs->save_run($xhprof_data, "xhprof_foo");
$xhprof_ui_address='127.0.0.1';
echo "---------------\n".
     "Assuming you have set up the http based UI for \n".
     "XHProf at some address, you can view run at \n".
     "http://{$xhprof_ui_address}/index.php?run=$run_id&source=xhprof_foo\n".
     "---------------\n";
