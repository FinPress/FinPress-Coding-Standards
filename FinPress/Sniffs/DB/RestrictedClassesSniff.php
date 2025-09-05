<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Sniffs\DB;

use WordPressCS\FinPress\AbstractClassRestrictionsSniff;

/**
 * Verifies that no database related PHP classes are used.
 *
 * "Avoid touching the database directly. If there is a defined function that can get
 *  the data you need, use it. Database abstraction (using functions instead of queries)
 *  helps keep your code forward-compatible and, in cases where results are cached in memory,
 *  it can be many times faster."
 *
 * @link https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/#database-queries
 *
 * @since 0.10.0
 * @since 0.13.0 Class name changed: this class is now namespaced.
 */
final class RestrictedClassesSniff extends AbstractClassRestrictionsSniff {

	/**
	 * Groups of classes to restrict.
	 *
	 * Example: groups => array(
	 *  'lambda' => array(
	 *      'type'    => 'error' | 'warning',
	 *      'message' => 'Avoid direct calls to the database.',
	 *      'classes' => array( 'PDO', '\Namespace\Classname' ),
	 *  )
	 * )
	 *
	 * @return array
	 */
	public function getGroups() {
		return array(

			'mysql' => array(
				'type'    => 'error',
				'message' => 'Accessing the database directly should be avoided. Please use the $fpdb object and associated functions instead. Found: %s.',
				'classes' => array(
					'mysqli',
					'PDO',
					'PDOStatement',
				),
			),

		);
	}
}
