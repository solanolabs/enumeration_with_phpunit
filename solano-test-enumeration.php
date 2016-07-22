#!/usr/bin/env php
<?php

/**
 * Custom enumeration of PHPUnit tests for Solano CI
 * This example uses a $INCLUDE_GROUPS environment variable to do a "dry run"
 * of PHPUnit with the 'enumeration' hook to determine which '@group' annotated 
 * tests should be run during the 'tests' phase of the build lifecycle.
 */

$test_list_file = getenv('TDDIUM_REPO_ROOT') . '/solano-phpunit-test-list.txt';

$commands = array();

// Determine which "dry run" command to run
$phpunit_command = 'ENUMERATE_FILES=true ./vendor/bin/phpunit --bootstrap tests/bootstrap.php';
if (!empty(getenv('INCLUDE_GROUPS'))) {
  $phpunit_command .= ' --group ' . getenv('INCLUDE_GROUPS');
}

// Execute "dry run" command and determine files to really run
echo("\n--- ENVIRONMENT VARIABLES:\n");
echo(system('env | sort'));
echo("\n");
echo("\n--- ENUMRATION COMMAND: $phpunit_command \n");
exec($phpunit_command, $output, $return);
echo("\n--- ENUMRATION OUTPUT START ---\n" . implode("\n", $output) . "\n--- ENUMERATION OUTPUT END ---\n");
if ($return || !file_exists($test_list_file)) {
  // The "dry run" command failed? Set the command to run to include `/bin/false` to ensure the build fails
  $commands[] = 'echo "Custom enumaration command failed!" && /bin/false';
} else {
  $test_files= array_filter(explode("\n", file_get_contents($test_list_file)));
  if (!count($test_files)) {
    // There were no files included in "dry run"? Ensure the build fails!
    $commands[] = 'echo "Custom enumaration command returned no test files!" && /bin/false';
  } else {
    $commands[] = array(
      'type'           => 'phpunit',
      'mode'           => 'parallel',
      'output'         => 'exit-status',
      'command'        => './vendor/bin/solano-phpunit --bootstrap tests/bootstrap.php',
      'config'         => 'phpunit.xml',
      'files'          => $test_files,
      'files_expanded' => $test_files
      );
  }
}

// Write results to enumeration pick-up file
$json = array();
$json['commands'] = $commands;
file_put_contents('test_list.json', json_encode($json));
