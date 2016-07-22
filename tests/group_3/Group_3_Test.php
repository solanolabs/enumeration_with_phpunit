<?php
/**
 * @group group3
 */
class Example_3_Test extends Custom_PHPUnit_TestCase
{
  /**
   * The Custom_PHPUnit_TestCase extends PHPUnit_Framework_TestCase,
   * allowing for custom enumeration on Solano CI
   */

  public function test_3()
  {
    $this->assertEquals(0, 0);
  }
}
