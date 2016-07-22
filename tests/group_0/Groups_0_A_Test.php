<?php
/**
 * @group group0
 * @group groupA
 */
class Example_0_A_Test extends Custom_PHPUnit_TestCase
{
  /**
   * The Custom_PHPUnit_TestCase extends PHPUnit_Framework_TestCase,
   * allowing for custom enumeration on Solano CI
   */

  public function test_0_A()
  {
    $this->assertEquals(0, 0);
  }
}
