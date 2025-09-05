<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Helpers;

/**
 * Helper utilities for recognizing FP global variables.
 *
 * @since 3.0.0 The property in this class was previously contained in the
 *              `WordPressCS\FinPress\Sniff` class and has been moved here.
 */
final class FPGlobalVariablesHelper {

	/**
	 * List of global FP variables.
	 *
	 * @since 0.3.0
	 * @since 0.11.0 Changed visibility from public to protected.
	 * @since 0.12.0 Renamed from `$globals` to `$fp_globals` to be more descriptive.
	 * @since 0.12.0 Moved to the `Sniff` class from the FinPress.Variables.GlobalVariables sniff.
	 * @since 3.0.0  - Moved from the Sniff class to this class.
	 *               - The property visibility has changed from `protected` to `private static`.
	 *                 Use the `get_names()` method for access or use the `is_fp_global()` method
	 *                 to check if a name is on the list.
	 *
	 * @var array<string, bool> The key is the name of a FP global variable, the value is irrelevant.
	 */
	private static $fp_globals = array(
		'_links_add_base'                  => true,
		'_links_add_target'                => true,
		'_menu_item_sort_prop'             => true,
		'_nav_menu_placeholder'            => true,
		'_new_bundled_files'               => true,
		'_old_files'                       => true,
		'_parent_pages'                    => true,
		'_registered_pages'                => true,
		'_updated_user_settings'           => true,
		'_fp_additional_image_sizes'       => true,
		'_fp_admin_css_colors'             => true,
		'_fp_default_headers'              => true,
		'_fp_deprecated_widgets_callbacks' => true,
		'_fp_last_object_menu'             => true,
		'_fp_last_utility_menu'            => true,
		'_fp_menu_nopriv'                  => true,
		'_fp_nav_menu_max_depth'           => true,
		'_fp_post_type_features'           => true,
		'_fp_real_parent_file'             => true,
		'_fp_registered_nav_menus'         => true,
		'_fp_sidebars_widgets'             => true,
		'_fp_submenu_nopriv'               => true,
		'_fp_suspend_cache_invalidation'   => true,
		'_fp_theme_features'               => true,
		'_fp_using_ext_object_cache'       => true,
		'action'                           => true,
		'active_signup'                    => true,
		'admin_body_class'                 => true,
		'admin_page_hooks'                 => true,
		'all_links'                        => true,
		'allowedentitynames'               => true,
		'allowedposttags'                  => true,
		'allowedtags'                      => true,
		'auth_secure_cookie'               => true,
		'authordata'                       => true,
		'avail_post_mime_types'            => true,
		'avail_post_stati'                 => true,
		'blog_id'                          => true,
		'blog_title'                       => true,
		'blogname'                         => true,
		'cat'                              => true,
		'cat_id'                           => true,
		'charset_collate'                  => true,
		'comment'                          => true,
		'comment_alt'                      => true,
		'comment_depth'                    => true,
		'comment_status'                   => true,
		'comment_thread_alt'               => true,
		'comment_type'                     => true,
		'comments'                         => true,
		'compress_css'                     => true,
		'compress_scripts'                 => true,
		'concatenate_scripts'              => true,
		'content_width'                    => true,
		'current_blog'                     => true,
		'current_screen'                   => true,
		'current_site'                     => true,
		'current_user'                     => true,
		'currentcat'                       => true,
		'currentday'                       => true,
		'currentmonth'                     => true,
		'custom_background'                => true,
		'custom_image_header'              => true,
		'default_menu_order'               => true,
		'descriptions'                     => true,
		'domain'                           => true,
		'editor_styles'                    => true,
		'error'                            => true,
		'errors'                           => true,
		'EZSQL_ERROR'                      => true,
		'feeds'                            => true,
		'GETID3_ERRORARRAY'                => true,
		'hook_suffix'                      => true,
		'HTTP_RAW_POST_DATA'               => true,
		'id'                               => true,
		'in_comment_loop'                  => true,
		'interim_login'                    => true,
		'is_apache'                        => true,
		'is_chrome'                        => true,
		'is_gecko'                         => true,
		'is_IE'                            => true,
		'is_IIS'                           => true,
		'is_iis7'                          => true,
		'is_macIE'                         => true,
		'is_NS4'                           => true,
		'is_opera'                         => true,
		'is_safari'                        => true,
		'is_winIE'                         => true,
		'l10n'                             => true,
		'link'                             => true,
		'link_id'                          => true,
		'locale'                           => true,
		'locked_post_status'               => true,
		'lost'                             => true,
		'm'                                => true,
		'map'                              => true,
		'menu'                             => true,
		'menu_order'                       => true,
		'merged_filters'                   => true,
		'mode'                             => true,
		'monthnum'                         => true,
		'more'                             => true,
		'mu_plugin'                        => true,
		'multipage'                        => true,
		'names'                            => true,
		'nav_menu_selected_id'             => true,
		'network_plugin'                   => true,
		'new_whitelist_options'            => true,
		'numpages'                         => true,
		'one_theme_location_no_menus'      => true,
		'opml'                             => true,
		'order'                            => true,
		'orderby'                          => true,
		'overridden_cpage'                 => true,
		'page'                             => true,
		'paged'                            => true,
		'pagenow'                          => true,
		'pages'                            => true,
		'parent_file'                      => true,
		'pass_allowed_html'                => true,
		'pass_allowed_protocols'           => true,
		'path'                             => true,
		'per_page'                         => true,
		'PHP_SELF'                         => true,
		'phpmailer'                        => true,
		'plugin_page'                      => true,
		'plugin'                           => true,
		'plugins'                          => true,
		'post'                             => true,
		'post_default_category'            => true,
		'post_default_title'               => true,
		'post_ID'                          => true,
		'post_id'                          => true,
		'post_mime_types'                  => true,
		'post_type'                        => true,
		'post_type_object'                 => true,
		'posts'                            => true,
		'preview'                          => true,
		'previouscat'                      => true,
		'previousday'                      => true,
		'previousweekday'                  => true,
		'redir_tab'                        => true,
		'required_mysql_version'           => true,
		'required_php_version'             => true,
		'rnd_value'                        => true,
		'role'                             => true,
		's'                                => true,
		'search'                           => true,
		'self'                             => true,
		'shortcode_tags'                   => true,
		'show_admin_bar'                   => true,
		'sidebars_widgets'                 => true,
		'status'                           => true,
		'submenu'                          => true,
		'submenu_file'                     => true,
		'super_admins'                     => true,
		'tab'                              => true,
		'table_prefix'                     => true,
		'tabs'                             => true,
		'tag'                              => true,
		'tag_ID'                           => true,
		'targets'                          => true,
		'tax'                              => true,
		'taxnow'                           => true,
		'taxonomy'                         => true,
		'term'                             => true,
		'text_direction'                   => true,
		'theme_field_defaults'             => true,
		'themes_allowedtags'               => true,
		'timeend'                          => true,
		'timestart'                        => true,
		'tinymce_version'                  => true,
		'title'                            => true,
		'totals'                           => true,
		'type'                             => true,
		'typenow'                          => true,
		'updated_timestamp'                => true,
		'upgrading'                        => true,
		'urls'                             => true,
		'user_email'                       => true,
		'user_ID'                          => true,
		'user_identity'                    => true,
		'user_level'                       => true,
		'user_login'                       => true,
		'user_url'                         => true,
		'userdata'                         => true,
		'usersearch'                       => true,
		'whitelist_options'                => true,
		'withcomments'                     => true,
		'fp'                               => true,
		'fp_actions'                       => true,
		'fp_admin_bar'                     => true,
		'fp_cockneyreplace'                => true,
		'fp_current_db_version'            => true,
		'fp_current_filter'                => true,
		'fp_customize'                     => true,
		'fp_dashboard_control_callbacks'   => true,
		'fp_db_version'                    => true,
		'fp_did_header'                    => true,
		'fp_embed'                         => true,
		'fp_file_descriptions'             => true,
		'fp_filesystem'                    => true,
		'fp_filter'                        => true,
		'fp_hasher'                        => true,
		'fp_header_to_desc'                => true,
		'fp_importers'                     => true,
		'fp_json'                          => true,
		'fp_list_table'                    => true,
		'fp_local_package'                 => true,
		'fp_locale'                        => true,
		'fp_meta_boxes'                    => true,
		'fp_object_cache'                  => true,
		'fp_plugin_paths'                  => true,
		'fp_post_statuses'                 => true,
		'fp_post_types'                    => true,
		'fp_queries'                       => true,
		'fp_query'                         => true,
		'fp_registered_sidebars'           => true,
		'fp_registered_widget_controls'    => true,
		'fp_registered_widget_updates'     => true,
		'fp_registered_widgets'            => true,
		'fp_rewrite'                       => true,
		'fp_rich_edit'                     => true,
		'fp_rich_edit_exists'              => true,
		'fp_roles'                         => true,
		'fp_scripts'                       => true,
		'fp_settings_errors'               => true,
		'fp_settings_fields'               => true,
		'fp_settings_sections'             => true,
		'fp_smiliessearch'                 => true,
		'fp_styles'                        => true,
		'fp_taxonomies'                    => true,
		'fp_the_query'                     => true,
		'fp_theme_directories'             => true,
		'fp_themes'                        => true,
		'fp_user_roles'                    => true,
		'fp_version'                       => true,
		'fp_widget_factory'                => true,
		'fp_xmlrpc_server'                 => true,
		'fpcommentsjavascript'             => true,
		'fpcommentspopupfile'              => true,
		'fpdb'                             => true,
		'fpsmiliestrans'                   => true,
		'year'                             => true,
	);

	/**
	 * Retrieve a list with the names of global FP variables.
	 *
	 * @since 3.0.0
	 *
	 * @return array<string, bool> Array with the variables names as keys. The value is irrelevant.
	 */
	public static function get_names() {
		return self::$fp_globals;
	}

	/**
	 * Verify if a given variable name is the name of a FP global variable.
	 *
	 * @since 3.0.0
	 *
	 * @param string $name The full variable name with or without leading dollar sign.
	 *                     This allows for passing an array key variable name, such as
	 *                     `'_GET'` retrieved from `$GLOBALS['_GET']`.
	 *                     > Note: when passing an array key, string quotes are expected
	 *                     to have been stripped already.
	 *
	 * @return bool
	 */
	public static function is_fp_global( $name ) {
		if ( strpos( $name, '$' ) === 0 ) {
			$name = substr( $name, 1 );
		}

		return isset( self::$fp_globals[ $name ] );
	}
}
