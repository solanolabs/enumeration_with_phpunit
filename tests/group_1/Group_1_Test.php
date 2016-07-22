<?php
/**
 * @group group1
 */
class Example_1_Test extends Custom_PHPUnit_TestCase
{
  /**
   * The Custom_PHPUnit_TestCase extends PHPUnit_Framework_TestCase,
   * allowing for custom enumeration on Solano CI
   */

  public function test_1()
  {
    $this->assertEquals(0, 0);
  }
}
