<?php
/**
 * Unit test class for FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Tests\DateTime;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the CurrentTimeTimestamp sniff.
 *
 * @since 2.2.0
 *
 * @covers \WordPressCS\FinPress\Sniffs\DateTime\CurrentTimeTimestampSniff
 */
final class CurrentTimeTimestampUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected errors.
	 */
	public function getErrorList() {
		return array(
			9  => 1,
			11 => 1,
			17 => 1,
			31 => 1,
		);
	}

	/**
	 * Returns the lines where warnings should occur.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected warnings.
	 */
	public function getWarningList() {
		return array(
			22 => 1,
			23 => 1,
			24 => 1,
			25 => 1,
			32 => 1,
		);
	}
}
