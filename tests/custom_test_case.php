<?php
/**
 * Custom PHPUnit TestCase to allow enumeration of tests to run on Solano CI.
 * To perform a "dry run", when $ENUMERATE_FILES == true, runBare() will not execute
 * tests, but instead will determine the file containing the test and either:
 * 1) if $TDDIUM is set, add it as necessary to test_list.json
 * 2) if $TDDIUM is not set, output the test case details
 */
class Custom_PHPUnit_TestCase extends \PHPUnit_Framework_TestCase
{
  public function runBare()
  {
    if (getenv('ENUMERATE_FILES')) {
      // Get test details
      $class_name = get_class($this);
      $refObject = new ReflectionObject($this);
      $file_full_path = $refObject->getFileName();
      $working_dir = getcwd();
      $file_relative_path = substr($file_full_path, 1 + strlen($working_dir));
      $test_name = $this->getName();

      // Display/write-to-file test details
      echo("\nDiscovered: " . $class_name . "::" . $test_name . " in " . $file_relative_path . " ");
      if (!empty(getenv('TDDIUM'))) {
        $test_list_file = getenv('TDDIUM_REPO_ROOT') . '/solano-phpunit-test-list.txt';
        $current_test_files = "";
        if (file_exists($test_list_file)) {
          $current_test_files = file_get_contents($test_list_file);
        }
        if (false === strpos($current_test_files, $file_relative_path . "\n")) {
          $current_test_files .= $file_relative_path . "\n";
        }
        file_put_contents($test_list_file, $current_test_files);
      }

      // Mark test as skipped since this is a "dry run"
      $this->markTestSkipped('Only enumerating tests');
    } else {
      parent::runBare();
    }
  }
}
