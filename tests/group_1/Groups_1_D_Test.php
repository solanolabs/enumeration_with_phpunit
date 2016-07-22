<?php
/**
 * @group group1
 * @group groupD
 */
class Example_1_D_Test extends Custom_PHPUnit_TestCase
{
  /**
   * The Custom_PHPUnit_TestCase extends PHPUnit_Framework_TestCase,
   * allowing for custom enumeration on Solano CI
   */

  public function test_1_D()
  {
    $this->assertEquals(0, 0);
  }
}
