<?php
/**
 * Unit test class for FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Tests\WhiteSpace;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

/**
 * Unit test class for the CastStructureSpacing sniff.
 *
 * @since 0.3.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 *
 * @covers \WordPressCS\FinPress\Sniffs\WhiteSpace\CastStructureSpacingSniff
 */
final class CastStructureSpacingUnitTest extends AbstractSniffUnitTest {

	/**
	 * Returns the lines where errors should occur.
	 *
	 * @return array<int, int> Key is the line number, value is the number of expected errors.
	 */
	public function getErrorList() {
		return array(
			3  => 1,
			6  => 1,
			9  => 1,
			12 => 1,
			15 => 1,
			18 => 1,
			21 => 1,
		);
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
