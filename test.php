<?php

require "../vendor/autoload.php";

$tests = array(
    new \Test\MainTest(),
    new \Test\SingleCommandTest(),
    new \Test\EventCommandTest()
);

foreach ($tests as $test) {
    echo "===".get_class($test)."===".PHP_EOL;

    $test->runTest();
}
