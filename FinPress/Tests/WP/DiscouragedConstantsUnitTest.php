<?php
/**
 * Unit test class for FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Tests\FP;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the FP_DiscouragedConstants sniff.
 *
 * @since 0.14.0
 *
 * @covers \WordPressCS\FinPress\Sniffs\FP\DiscouragedConstantsSniff
 */
final class DiscouragedConstantsUnitTest extends AbstractSniffUnitTest {

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
			50 => 1,
			51 => 1,
			52 => 1,
			53 => 1,
			54 => 1,
			55 => 1,
			56 => 1,
			57 => 1,
			58 => 1,
			59 => 1,
			60 => 1,
			61 => 1,
			63 => 1,
			64 => 1,
			66 => 1,
			67 => 1,
			71 => 1,
			72 => 1,
			83 => 1,
			88 => 1,
		);
	}
}
