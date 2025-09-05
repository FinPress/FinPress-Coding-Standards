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
 * Unit test class for the PregQuoteDelimiter sniff.
 *
 * @since 1.0.0
 *
 * @covers \WordPressCS\FinPress\Sniffs\PHP\PregQuoteDelimiterSniff
 */
final class PregQuoteDelimiterUnitTest extends AbstractSniffUnitTest {

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
			6  => 1,
			7  => 1,
			13 => 1,
			14 => 1,
		);
	}
}
