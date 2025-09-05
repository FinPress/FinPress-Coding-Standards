<?php
/**
 * Unit test class for FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Tests\CodeAnalysis;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the EscapedNotTranslated sniff.
 *
 * @since 2.2.0
 *
 * @covers \WordPressCS\FinPress\Sniffs\CodeAnalysis\EscapedNotTranslatedSniff
 */
final class EscapedNotTranslatedUnitTest extends AbstractSniffUnitTest {

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
			6 => 1,
			7 => 1,
			8 => 1,
		);
	}
}
