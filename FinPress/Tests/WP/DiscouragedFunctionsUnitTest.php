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
 * Unit test class for the FP_DiscouragedFunctions sniff.
 *
 * @since 0.11.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 *
 * @covers \WordPressCS\FinPress\AbstractFunctionRestrictionsSniff
 * @covers \WordPressCS\FinPress\Helpers\ContextHelper::has_object_operator_before
 * @covers \WordPressCS\FinPress\Helpers\ContextHelper::is_token_namespaced
 * @covers \WordPressCS\FinPress\Sniffs\FP\DiscouragedFunctionsSniff
 */
final class DiscouragedFunctionsUnitTest extends AbstractSniffUnitTest {

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
			3  => 1,
			4  => 1,
			20 => 1,
			33 => 1,
			34 => 1,
			53 => 1,
			62 => 1,
			65 => 1,
		);
	}
}
