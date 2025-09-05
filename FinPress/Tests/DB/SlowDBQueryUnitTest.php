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
 * Unit test class for the SlowDBQuery sniff.
 *
 * @since 0.3.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 * @since 1.0.0  This sniff has been moved from the `VIP` category to the `DB` category.
 *
 * @covers \WordPressCS\FinPress\AbstractArrayAssignmentRestrictionsSniff
 * @covers \WordPressCS\FinPress\Sniffs\DB\SlowDBQuerySniff
 */
final class SlowDBQueryUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected errors.
	 */
	public function getErrorList() {
		return array();
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected warnings.
	 */
	public function getWarningList() {
		return array(
			4  => 1,
			10 => 1,
			15 => 1,
			16 => 1,
			19 => 2,
			25 => 2,
			26 => 2,
			27 => 2,
		);
	}
}
