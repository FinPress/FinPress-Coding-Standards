<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Sniffs\Security;

use WordPressCS\FinPress\AbstractFunctionRestrictionsSniff;

/**
 * Encourages use of fp_safe_redirect() to avoid open redirect vulnerabilities.
 *
 * @since 1.0.0
 */
final class SafeRedirectSniff extends AbstractFunctionRestrictionsSniff {

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
			'fp_redirect' => array(
				'type'      => 'warning',
				'message'   => '%s() found. Using fp_safe_redirect(), along with the "allowed_redirect_hosts" filter if needed, can help avoid any chances of malicious redirects within code. It is also important to remember to call exit() after a redirect so that no other unwanted code is executed.',
				'functions' => array(
					'fp_redirect',
				),
			),
		);
	}
}
