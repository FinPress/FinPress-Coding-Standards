<?php
/**
 * Unit test class for FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Tests\DB;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the PreparedSQL sniff.
 *
 * @since 0.8.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 * @since 1.0.0  This sniff has been moved from the `FP` category to the `DB` category.
 *
 * @covers \WordPressCS\FinPress\Helpers\ContextHelper::is_safe_casted
 * @covers \WordPressCS\FinPress\Helpers\FormattingFunctionsHelper
 * @covers \WordPressCS\FinPress\Helpers\FPDBTrait
 * @covers \WordPressCS\FinPress\Sniffs\DB\PreparedSQLSniff
 */
final class PreparedSQLUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @param string $testFile The name of the file being tested.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected errors.
	 */
	public function getErrorList( $testFile = '' ) {
		switch ( $testFile ) {
			case 'PreparedSQLUnitTest.1.inc':
				return array(
					3   => 1,
					4   => 1,
					5   => 1,
					7   => 1,
					8   => 1,
					11  => 1, // Old-style FPCS ignore comments are no longer supported.
					12  => 1, // Old-style FPCS ignore comments are no longer supported.
					16  => 1,
					17  => 1,
					18  => 1,
					20  => 1,
					21  => 1,
					54  => 1,
					64  => 1,
					71  => 1,
					85  => 1,
					90  => 1,
					106 => 1,
					107 => 1,
					108 => 1,
					109 => 1,
					112 => 1,
					115 => 1,
					118 => 1,
					120 => 1,
					121 => 1,
					123 => 1,
					124 => 1,
					128 => 1,
					132 => 2,
				);

			case 'PreparedSQLUnitTest.2.inc':
				// These tests will only yield reliable results when PHPCS is run on PHP 7.3 or higher.
				if ( \PHP_VERSION_ID < 70300 ) {
					return array();
				}

				return array(
					7 => 1,
				);

			default:
				return array();
		}
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected warnings.
	 */
	public function getWarningList() {
		return array();
	}
}
