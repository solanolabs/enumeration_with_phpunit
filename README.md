![Solano Labs Logo](https://www.solanolabs.com/assets/solano-labs-1cfeb8f4276fc9294349039f602d5923.png) 
# custom_enumeration_with_phpunit

This repository contains an example of using [PHPUnit](https://phpunit.de/) to provide
[custom enumeration](http://docs.solanolabs.com/Beta/custom-enumeration/) of which test files
will be included in a [Solano CI](https://www.solanolabs.com/) build.

The [solano.yml](./solano.yml) configuration file demonstrates preparing the workers, specifying
``solano-test-enumeration.php`` as the enumeration script, and defines multiple
[build profiles](http://docs.solanolabs.com/Beta/build-profiles/) that change the
[environment variables](http://docs.solanolabs.com/Setup/setting-environment-variables/)
used to determine the applicable test files.

The [solano-test-enumeration.php](./solano-test-enumeration.php) script does a "dry run" with PHPUnit (by setting
``ENUMERATE_FILES=true``) to build a list of test files and create the 
[solano-phpunit](https://github.com/solanolabs/solano-phpunit) command that will be used
for running tests in parallel. 

A custom [PHPUnit test case class](https://phpunit.de/manual/current/en/extending-phpunit.html),
**must** be the base class for the test files to allow a "dry run" to enumerate applicable test files.
All of the test files in this repo extend the [Custom_PHPUnit_TestCase class](./tests/custom_test_case.php),
which determines when to enumerate files, and when to call ``parent::runBare()``.
