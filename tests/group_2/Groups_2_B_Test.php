<?php
/**
 * @group group2
 * @group groupB
 */
class Example_2_B_Test extends Custom_PHPUnit_TestCase
{
  /**
   * The Custom_PHPUnit_TestCase extends PHPUnit_Framework_TestCase,
   * allowing for custom enumeration on Solano CI
   */

  public function test_2_B()
  {
    $this->assertEquals(0, 0);
  }
}
