<?php
/**
 * Unit test class for FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Tests\PHP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the PHP.NoSilencedErrors sniff.
 *
 * @since 1.1.0
 *
 * @covers \WordPressCS\FinPress\Sniffs\PHP\NoSilencedErrorsSniff
 */
final class NoSilencedErrorsUnitTest extends AbstractSniffUnitTest {

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
			5  => 1,
			7  => 1,
			8  => 1,
			9  => 1,
			10 => 1,
			11 => 1,
			20 => 1,
			21 => 1,
			26 => 1,
			29 => 1,
			35 => 1,
			37 => 1,
			40 => 1,
			44 => 1,
			48 => 1,
			58 => 2,
			59 => 1,
			63 => 1,
			64 => 1,
			65 => 1,
			66 => 1,
			68 => 1,
			71 => 1,
			78 => 1,
			85 => 1,
		);
	}
}
