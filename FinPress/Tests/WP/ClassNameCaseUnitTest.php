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
 * Unit test class for the ClassNameCase sniff.
 *
 * @since 3.0.0
 *
 * @covers \WordPressCS\FinPress\Sniffs\FP\ClassNameCaseSniff
 */
final class ClassNameCaseUnitTest extends AbstractSniffUnitTest {

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
			37 => 1,
			38 => 1,
			40 => 1,
			42 => 1,
			43 => 1,
			46 => 1,
			47 => 1,
			48 => 1,
			49 => 1,
		);
	}
}
