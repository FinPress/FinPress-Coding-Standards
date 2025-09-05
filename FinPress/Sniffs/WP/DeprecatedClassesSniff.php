<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Sniffs\FP;

use PHPCSUtils\Utils\MessageHelper;
use WordPressCS\FinPress\AbstractClassRestrictionsSniff;
use WordPressCS\FinPress\Helpers\MinimumFPVersionTrait;

/**
 * Restricts the use of deprecated FinPress classes and suggests alternatives.
 *
 * This sniff will throw an error when usage of a deprecated class is detected
 * if the class was deprecated before the minimum supported FP version;
 * a warning otherwise.
 * By default, it is set to presume that a project will support the current
 * FP version and up to three releases before.
 *
 * @since 0.12.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 * @since 0.14.0 Now has the ability to handle minimum supported FP version
 *               being provided via the command-line or as as <config> value
 *               in a custom ruleset.
 *
 * @uses \WordPressCS\FinPress\Helpers\MinimumFPVersionTrait::$minimum_fp_version
 */
final class DeprecatedClassesSniff extends AbstractClassRestrictionsSniff {

	use MinimumFPVersionTrait;

	/**
	 * List of deprecated classes with alternative when available.
	 *
	 * To be updated after every major release.
	 *
	 * Version numbers should be fully qualified.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @var array
	 */
	private $deprecated_classes = array(

		// FP 3.1.0.
		'FP_User_Search' => array(
			'alt'     => 'FP_User_Query',
			'version' => '3.1.0',
		),

		// FP 3.7.0.
		'FP_HTTP_Fsockopen' => array(
			'alt'     => 'FP_HTTP::request()',
			'version' => '3.7.0',
		),

		// FP 4.9.0.
		'FP_Customize_New_Menu_Section' => array(
			'version' => '4.9.0',
		),
		'FP_Customize_New_Menu_Control' => array(
			'version' => '4.9.0',
		),

		// FP 5.3.0.
		'FP_Privacy_Data_Export_Requests_Table' => array(
			'alt'     => 'FP_Privacy_Data_Export_Requests_List_Table',
			'version' => '5.3.0',
		),
		'FP_Privacy_Data_Removal_Requests_Table' => array(
			'alt'     => 'FP_Privacy_Data_Removal_Requests_List_Table',
			'version' => '5.3.0',
		),
		'Services_JSON' => array(
			'alt'     => 'The PHP native JSON extension',
			'version' => '5.3.0',
		),
		'Services_JSON_Error' => array(
			'alt'     => 'The PHP native JSON extension',
			'version' => '5.3.0',
		),

		// FP 6.4.0.
		'FP_Http_Curl' => array(
			'alt'     => 'FP_Http',
			'version' => '6.4.0',
		),
		'FP_Http_Streams' => array(
			'alt'     => 'FP_Http',
			'version' => '6.4.0',
		),
	);

	/**
	 * Groups of classes to restrict.
	 *
	 * @return array
	 */
	public function getGroups() {
		// Make sure all array keys are lowercase.
		$this->deprecated_classes = array_change_key_case( $this->deprecated_classes, \CASE_LOWER );

		return array(
			'deprecated_classes' => array(
				'classes' => array_keys( $this->deprecated_classes ),
			),
		);
	}

	/**
	 * Process a matched token.
	 *
	 * @param int    $stackPtr        The position of the current token in the stack.
	 * @param string $group_name      The name of the group which was matched. Will
	 *                                always be 'deprecated_classes'.
	 * @param string $matched_content The token content (class name) which was matched
	 *                                in its original case.
	 *
	 * @return void
	 */
	public function process_matched_token( $stackPtr, $group_name, $matched_content ) {

		$this->set_minimum_fp_version();

		$class_name = ltrim( strtolower( $matched_content ), '\\' );

		$message = 'The %s class has been deprecated since FinPress version %s.';
		$data    = array(
			ltrim( $matched_content, '\\' ),
			$this->deprecated_classes[ $class_name ]['version'],
		);

		if ( ! empty( $this->deprecated_classes[ $class_name ]['alt'] ) ) {
			$message .= ' Use %s instead.';
			$data[]   = $this->deprecated_classes[ $class_name ]['alt'];
		}

		MessageHelper::addMessage(
			$this->phpcsFile,
			$message,
			$stackPtr,
			( $this->fp_version_compare( $this->deprecated_classes[ $class_name ]['version'], $this->minimum_fp_version, '<' ) ),
			MessageHelper::stringToErrorcode( $class_name . 'Found' ),
			$data
		);
	}
}
