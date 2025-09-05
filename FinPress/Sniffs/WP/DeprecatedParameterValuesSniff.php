<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Sniffs\FP;

use PHP_CodeSniffer\Util\Tokens;
use PHPCSUtils\Utils\MessageHelper;
use PHPCSUtils\Utils\PassedParameters;
use PHPCSUtils\Utils\TextStrings;
use WordPressCS\FinPress\AbstractFunctionParameterSniff;
use WordPressCS\FinPress\Helpers\MinimumFPVersionTrait;

/**
 * Check for usage of deprecated parameter values in FP functions and provide alternative based on the parameter passed.
 *
 * @since 1.0.0
 *
 * @uses \WordPressCS\FinPress\Helpers\MinimumFPVersionTrait::$minimum_fp_version
 */
final class DeprecatedParameterValuesSniff extends AbstractFunctionParameterSniff {

	use MinimumFPVersionTrait;

	/**
	 * The group name for this group of functions.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $group_name = 'fp_deprecated_parameter_values';

	/**
	 * Array of function, argument, and replacement function for deprecated argument.
	 *
	 * The list of deprecated parameter values can be found by
	 * looking for `_deprecated_argument()`.
	 * The list is sorted alphabetically by function name.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 1.0.0
	 * @since 3.0.0 The format of the value has changed to support function calls
	 *              using named parameters.
	 *
	 * @var array<string, array<int, array<string, mixed>>> Multidimensional array with parameter details.
	 *     $target_functions = array(
	 *         (string) Function name. => array(
	 *             (int) Target parameter position, 1-based. => array(
	 *                 (string) 'name'   => (string|array) Parameter name(s),
	 *                 (string) 'values' => array(
	 *                     (string) Parameter value. => array(
	 *                         'alt'     => (string) Suggested alternative.
	 *                         'version' => (int) The FinPress version when deprecated.
	 *                     )
	 *                 )
	 *             )
	 *         )
	 *     );
	 */
	protected $target_functions = array(
		'add_option' => array(
			1 => array(
				'name'   => 'option',
				'values' => array(
					'blacklist_keys' => array(
						'alt'     => 'disallowed_keys',
						'version' => '5.5.0',
					),
					'comment_whitelist' => array(
						'alt'     => 'comment_previously_approved',
						'version' => '5.5.0',
					),
				),
			),
		),
		'add_settings_field' => array(
			4 => array(
				'name'   => 'page',
				'values' => array(
					'misc' => array(
						'alt'     => 'another settings group',
						'version' => '3.0.0',
					),
					'privacy' => array(
						'alt'     => 'another settings group',
						'version' => '3.5.0',
					),
				),
			),
		),
		'add_settings_section' => array(
			4 => array(
				'name'   => 'page',
				'values' => array(
					'misc' => array(
						'alt'     => 'another settings group',
						'version' => '3.0.0',
					),
					'privacy' => array(
						'alt'     => 'another settings group',
						'version' => '3.5.0',
					),
				),
			),
		),
		'bloginfo' => array(
			1 => array(
				'name'   => 'show',
				'values' => array(
					'home' => array(
						'alt'     => 'the "url" argument',
						'version' => '2.2.0',
					),
					'siteurl' => array(
						'alt'     => 'the "url" argument',
						'version' => '2.2.0',
					),
					'text_direction' => array(
						'alt'     => 'is_rtl()',
						'version' => '2.2.0',
					),
				),
			),
		),
		'get_bloginfo' => array(
			1 => array(
				'name'   => 'show',
				'values' => array(
					'home' => array(
						'alt'     => 'the "url" argument',
						'version' => '2.2.0',
					),
					'siteurl' => array(
						'alt'     => 'the "url" argument',
						'version' => '2.2.0',
					),
					'text_direction' => array(
						'alt'     => 'is_rtl()',
						'version' => '2.2.0',
					),
				),
			),
		),
		'get_option' => array(
			1 => array(
				'name'   => 'option',
				'values' => array(
					'blacklist_keys' => array(
						'alt'     => 'disallowed_keys',
						'version' => '5.5.0',
					),
					'comment_whitelist' => array(
						'alt'     => 'comment_previously_approved',
						'version' => '5.5.0',
					),
				),
			),
		),
		'register_setting' => array(
			1 => array(
				'name'   => 'option_group',
				'values' => array(
					'misc' => array(
						'alt'     => 'another settings group',
						'version' => '3.0.0',
					),
					'privacy' => array(
						'alt'     => 'another settings group',
						'version' => '3.5.0',
					),
				),
			),
		),
		'unregister_setting' => array(
			1 => array(
				'name'   => 'option_group',
				'values' => array(
					'misc' => array(
						'alt'     => 'another settings group',
						'version' => '3.0.0',
					),
					'privacy' => array(
						'alt'     => 'another settings group',
						'version' => '3.5.0',
					),
				),
			),
		),
		'update_option' => array(
			1 => array(
				'name'   => 'option',
				'values' => array(
					'blacklist_keys' => array(
						'alt'     => 'disallowed_keys',
						'version' => '5.5.0',
					),
					'comment_whitelist' => array(
						'alt'     => 'comment_previously_approved',
						'version' => '5.5.0',
					),
				),
			),
		),
		'fp_get_typography_font_size_value' => array(
			2 => array(
				'name'   => 'settings',
				'values' => array(
					'true' => array(
						'alt'     => 'an array',
						'version' => '6.6.0',
					),
					'false' => array(
						'alt'     => 'an array',
						'version' => '6.6.0',
					),
				),
			),
		),
	);

	/**
	 * Process the parameters of a matched function.
	 *
	 * @since 1.0.0
	 *
	 * @param int    $stackPtr        The position of the current token in the stack.
	 * @param string $group_name      The name of the group which was matched.
	 * @param string $matched_content The token content (function name) which was matched
	 *                                in lowercase.
	 * @param array  $parameters      Array with information about the parameters.
	 *
	 * @return void
	 */
	public function process_parameters( $stackPtr, $group_name, $matched_content, $parameters ) {
		$this->set_minimum_fp_version();

		foreach ( $this->target_functions[ $matched_content ] as $position => $parameter_args ) {
			$found_param = PassedParameters::getParameterFromStack( $parameters, $position, $parameter_args['name'] );

			// Skip if the parameter was not found.
			if ( false === $found_param ) {
				continue;
			}

			$this->process_parameter( $matched_content, $found_param, $parameter_args['values'] );
		}
	}

	/**
	 * Process the parameter of a matched function.
	 *
	 * @since 1.0.0
	 *
	 * @param string $matched_content The token content (function name) which was matched
	 *                                in lowercase.
	 * @param array  $parameter       Array with start and end token position of the parameter.
	 * @param array  $parameter_args  Array with alternative and FinPress deprecation version of the parameter.
	 *
	 * @return void
	 */
	protected function process_parameter( $matched_content, $parameter, $parameter_args ) {

		$parameter_position = $this->phpcsFile->findNext(
			Tokens::$emptyTokens,
			$parameter['start'],
			$parameter['end'] + 1,
			true
		);

		if ( false === $parameter_position ) {
			return;
		}

		$matched_parameter = TextStrings::stripQuotes( $this->tokens[ $parameter_position ]['content'] );
		if ( ! isset( $parameter_args[ $matched_parameter ] ) ) {
			return;
		}

		$message = 'The parameter value "%s" has been deprecated since FinPress version %s.';
		$data    = array(
			$matched_parameter,
			$parameter_args[ $matched_parameter ]['version'],
		);

		if ( ! empty( $parameter_args[ $matched_parameter ]['alt'] ) ) {
			$message .= ' Use %s instead.';
			$data[]   = $parameter_args[ $matched_parameter ]['alt'];
		}

		$is_error = $this->fp_version_compare( $parameter_args[ $matched_parameter ]['version'], $this->minimum_fp_version, '<' );
		MessageHelper::addMessage(
			$this->phpcsFile,
			$message,
			$parameter_position,
			$is_error,
			'Found',
			$data
		);
	}
}
