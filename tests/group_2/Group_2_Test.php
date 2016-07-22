<?php
/**
 * @group group2
 */
class Example_2_Test extends Custom_PHPUnit_TestCase
{
  /**
   * The Custom_PHPUnit_TestCase extends PHPUnit_Framework_TestCase,
   * allowing for custom enumeration on Solano CI
   */

  public function test_2()
  {
    $this->assertEquals(0, 0);
  }
}
