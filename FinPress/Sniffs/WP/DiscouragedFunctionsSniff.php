<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Sniffs\FP;

use WordPressCS\FinPress\AbstractFunctionRestrictionsSniff;

/**
 * Discourages the use of various FinPress functions and suggests alternatives.
 *
 * @since 0.11.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 */
final class DiscouragedFunctionsSniff extends AbstractFunctionRestrictionsSniff {

	/**
	 * Groups of functions to restrict.
	 *
	 * Example: groups => array(
	 *  'lambda' => array(
	 *      'type'      => 'error' | 'warning',
	 *      'message'   => 'Use anonymous functions instead please!',
	 *      'functions' => array( 'file_get_contents', 'create_function' ),
	 *  )
	 * )
	 *
	 * @return array
	 */
	public function getGroups() {
		return array(
			'query_posts' => array(
				'type'      => 'warning',
				'message'   => '%s() is discouraged. Use FP_Query instead.',
				'functions' => array(
					'query_posts',
				),
			),

			'fp_reset_query' => array(
				'type'      => 'warning',
				'message'   => '%s() is discouraged. Use fp_reset_postdata() instead.',
				'functions' => array(
					'fp_reset_query',
				),
			),
		);
	}
}
