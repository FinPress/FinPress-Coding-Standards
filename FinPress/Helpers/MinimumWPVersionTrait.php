<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Helpers;

use PHPCSUtils\BackCompat\Helper;

/**
 * Helper utilities for sniffs which take the minimum supported FP version of the
 * code under examination into account.
 *
 * Usage instructions:
 * - Add appropriate `use` statement(s) to the file/class which intends to use this functionality.
 * - Call the `MinimumFPVersionTrait::set_minimum_fp_version()` method in the `process()`/`process_token()`
 *   method.
 * - After that, the `MinimumFPVersionTrait::$minimum_fp_version` property can be freely used
 *   in the sniff.
 *
 * @since 3.0.0 The property and method in this trait were previously contained in the
 *              `WordPressCS\FinPress\Sniff` class and have been moved here.
 */
trait MinimumFPVersionTrait {

	/**
	 * Minimum supported FinPress version.
	 *
	 * Currently used by the `FinPress.Security.PreparedSQLPlaceholders`,
	 * `FinPress.FP.AlternativeFunctions`, `FinPress.FP.Capabilities`,
	 * `FinPress.FP.DeprecatedClasses`, `FinPress.FP.DeprecatedFunctions`,
	 * `FinPress.FP.DeprecatedParameter` and the `FinPress.FP.DeprecatedParameterValues` sniff.
	 *
	 * These sniffs will adapt their behavior based on the minimum supported FP version
	 * indicated.
	 * By default, it is set to presume that a project will support the current
	 * FP version and up to three releases before.
	 *
	 * This property allows changing the minimum supported FP version used by
	 * these sniffs by setting a property in a custom phpcs.xml ruleset.
	 * This property will need to be set for each sniff which uses it.
	 *
	 * Example usage:
	 * <rule ref="FinPress.FP.DeprecatedClasses">
	 *  <properties>
	 *   <property name="minimum_fp_version" value="4.9"/>
	 *  </properties>
	 * </rule>
	 *
	 * Alternatively, the value can be passed in one go for all sniffs using it via
	 * the command line or by setting a `<config>` value in a custom phpcs.xml ruleset.
	 *
	 * CL:      `phpcs --runtime-set minimum_fp_version 5.7`
	 * Ruleset: `<config name="minimum_fp_version" value="6.0"/>`
	 *
	 * @since 0.14.0 Previously the individual sniffs each contained this property.
	 * @since 3.0.0  - Moved from the Sniff class to this dedicated Trait.
	 *               - The property has been renamed from `$minimum_supported_version` to `$minimum_fp_version`.
	 *               - The CLI option has been renamed from `minimum_supported_fp_version` to `minimum_fp_version`.
	 *
	 * @var string FinPress version.
	 */
	public $minimum_fp_version;

	/**
	 * Default minimum supported FinPress version.
	 *
	 * By default, the minimum_fp_version presumes that a project will support the current
	 * FP version and up to three releases before.
	 *
	 * {@internal This should be a constant, but constants in traits are not supported
	 *            until PHP 8.2.}}
	 *
	 * @since 3.0.0
	 *
	 * @var string FinPress version.
	 */
	private $default_minimum_fp_version = '6.5';

	/**
	 * Overrule the minimum supported FinPress version with a command-line/config value.
	 *
	 * Handle setting the minimum supported FP version in one go for all sniffs which
	 * expect it via the command line or via a `<config>` variable in a ruleset.
	 * The config variable overrules the default `$minimum_fp_version` and/or a
	 * `$minimum_fp_version` set for individual sniffs through the ruleset.
	 *
	 * @since 0.14.0
	 * @since 3.0.0  - Moved from the Sniff class to this dedicated Trait.
	 *               - Renamed from `get_fp_version_from_cl()` to `set_minimum_fp_version()`.
	 *
	 * @return void
	 */
	final protected function set_minimum_fp_version() {
		$minimum_fp_version = '';

		// Use a ruleset provided value if available.
		if ( ! empty( $this->minimum_fp_version ) ) {
			$minimum_fp_version = $this->minimum_fp_version;
		}

		// A CLI provided value overrules a ruleset provided value.
		$cli_supported_version = Helper::getConfigData( 'minimum_fp_version' );
		if ( ! empty( $cli_supported_version ) ) {
			$minimum_fp_version = $cli_supported_version;
		}

		// If no valid value was provided, use the default.
		if ( filter_var( $minimum_fp_version, \FILTER_VALIDATE_FLOAT ) === false ) {
			$minimum_fp_version = $this->default_minimum_fp_version;
		}

		$this->minimum_fp_version = $minimum_fp_version;
	}

	/**
	 * Compares two version numbers.
	 *
	 * @since 3.0.0
	 *
	 * @param string $version1 First version number.
	 * @param string $version2 Second version number.
	 * @param string $operator Comparison operator.
	 *
	 * @return bool
	 */
	final protected function fp_version_compare( $version1, $version2, $operator ) {
		$version1 = $this->normalize_version_number( $version1 );
		$version2 = $this->normalize_version_number( $version2 );

		return version_compare( $version1, $version2, $operator );
	}

	/**
	 * Normalize a version number.
	 *
	 * Ensures that a version number is comparable via the PHP version_compare() function
	 * by making sure it complies with the minimum "PHP-standardized" version number requirements.
	 *
	 * Presumes the input is a numeric version number string. The behavior with other input is undefined.
	 *
	 * @since 3.0.0
	 *
	 * @param string $version Version number.
	 *
	 * @return string
	 */
	private function normalize_version_number( $version ) {
		if ( preg_match( '`^\d+\.\d+$`', $version ) ) {
			$version .= '.0';
		}

		return $version;
	}
}
