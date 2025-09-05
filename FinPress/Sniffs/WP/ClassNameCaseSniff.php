<?php
/**
 * FinPress Coding Standard.
 *
 * @package FPCS\WordPressCodingStandards
 * @link    https://github.com/FinPress/FinPress-Coding-Standards
 * @license https://opensource.org/licenses/MIT MIT
 */

namespace WordPressCS\FinPress\Sniffs\FP;

use WordPressCS\FinPress\AbstractClassRestrictionsSniff;

/**
 * Verify whether references to FP native classes use the proper casing for the class name.
 *
 * @since 3.0.0
 */
final class ClassNameCaseSniff extends AbstractClassRestrictionsSniff {

	/**
	 * List of all FP native classes.
	 *
	 * List is sorted alphabetically and based on a draft sniff to autogenerate this list.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $fp_classes = array(
		'_FP_Dependency',
		'_FP_Editors',
		'_FP_List_Table_Compat',
		'AtomEntry',
		'AtomFeed',
		'AtomParser',
		'Automatic_Upgrader_Skin',
		'Bulk_Plugin_Upgrader_Skin',
		'Bulk_Theme_Upgrader_Skin',
		'Bulk_Upgrader_Skin',
		'Core_Upgrader',
		'Custom_Background',
		'Custom_Image_Header',
		'Featured_Content',
		'File_Upload_Upgrader',
		'ftp',
		'ftp_base',
		'ftp_pure',
		'ftp_sockets',
		'Gettext_Translations',
		'IXR_Base64',
		'IXR_Client',
		'IXR_ClientMulticall',
		'IXR_Date',
		'IXR_Error',
		'IXR_IntrospectionServer',
		'IXR_Message',
		'IXR_Request',
		'IXR_Server',
		'IXR_Value',
		'Language_Pack_Upgrader',
		'Language_Pack_Upgrader_Skin',
		'MO',
		'MagpieRSS',
		'NOOP_Translations',
		'PO',
		'POMO_CachedFileReader',
		'POMO_CachedIntFileReader',
		'POMO_FileReader',
		'POMO_Reader',
		'POMO_StringReader',
		'POP3',
		'PasswordHash',
		'PclZip',
		'Plugin_Installer_Skin',
		'Plugin_Upgrader',
		'Plugin_Upgrader_Skin',
		'Plural_Forms',
		'RSSCache',
		'Services_JSON',
		'Services_JSON_Error',
		'Snoopy',
		'Text_Diff',
		'Text_Diff_Engine_native',
		'Text_Diff_Engine_shell',
		'Text_Diff_Engine_string',
		'Text_Diff_Engine_xdiff',
		'Text_Diff_Op',
		'Text_Diff_Op_add',
		'Text_Diff_Op_change',
		'Text_Diff_Op_copy',
		'Text_Diff_Op_delete',
		'Text_Diff_Renderer',
		'Text_Diff_Renderer_inline',
		'Text_Exception',
		'Text_MappedDiff',
		'Theme_Installer_Skin',
		'Theme_Upgrader',
		'Theme_Upgrader_Skin',
		'Translation_Entry',
		'Translations',
		'Walker',
		'Walker_Category',
		'Walker_CategoryDropdown',
		'Walker_Category_Checklist',
		'Walker_Comment',
		'Walker_Nav_Menu',
		'Walker_Nav_Menu_Checklist',
		'Walker_Nav_Menu_Edit',
		'Walker_Page',
		'Walker_PageDropdown',
		'FP',
		'FP_Admin_Bar',
		'FP_Ajax_Response',
		'FP_Ajax_Upgrader_Skin',
		'FP_Application_Passwords',
		'FP_Application_Passwords_List_Table',
		'FP_Automatic_Updater',
		'FP_Block',
		'FP_Block_Bindings_Registry',
		'FP_Block_Bindings_Source',
		'FP_Block_Editor_Context',
		'FP_Block_List',
		'FP_Block_Metadata_Registry',
		'FP_Block_Parser',
		'FP_Block_Parser_Block',
		'FP_Block_Parser_Frame',
		'FP_Block_Pattern_Categories_Registry',
		'FP_Block_Patterns_Registry',
		'FP_Block_Styles_Registry',
		'FP_Block_Supports',
		'FP_Block_Template',
		'FP_Block_Templates_Registry',
		'FP_Block_Type',
		'FP_Block_Type_Registry',
		'FP_Classic_To_Block_Menu_Converter',
		'FP_Comment',
		'FP_Comment_Query',
		'FP_Comments_List_Table',
		'FP_Community_Events',
		'FP_Customize_Background_Image_Control',
		'FP_Customize_Background_Image_Setting',
		'FP_Customize_Background_Position_Control',
		'FP_Customize_Code_Editor_Control',
		'FP_Customize_Color_Control',
		'FP_Customize_Control',
		'FP_Customize_Cropped_Image_Control',
		'FP_Customize_Custom_CSS_Setting',
		'FP_Customize_Date_Time_Control',
		'FP_Customize_Filter_Setting',
		'FP_Customize_Header_Image_Control',
		'FP_Customize_Header_Image_Setting',
		'FP_Customize_Image_Control',
		'FP_Customize_Manager',
		'FP_Customize_Media_Control',
		'FP_Customize_Nav_Menu_Auto_Add_Control',
		'FP_Customize_Nav_Menu_Control',
		'FP_Customize_Nav_Menu_Item_Control',
		'FP_Customize_Nav_Menu_Item_Setting',
		'FP_Customize_Nav_Menu_Location_Control',
		'FP_Customize_Nav_Menu_Locations_Control',
		'FP_Customize_Nav_Menu_Name_Control',
		'FP_Customize_Nav_Menu_Section',
		'FP_Customize_Nav_Menu_Setting',
		'FP_Customize_Nav_Menus',
		'FP_Customize_Nav_Menus_Panel',
		'FP_Customize_New_Menu_Control',
		'FP_Customize_New_Menu_Section',
		'FP_Customize_Panel',
		'FP_Customize_Partial',
		'FP_Customize_Section',
		'FP_Customize_Selective_Refresh',
		'FP_Customize_Setting',
		'FP_Customize_Sidebar_Section',
		'FP_Customize_Site_Icon_Control',
		'FP_Customize_Theme_Control',
		'FP_Customize_Themes_Panel',
		'FP_Customize_Themes_Section',
		'FP_Customize_Upload_Control',
		'FP_Customize_Widgets',
		'FP_Date_Query',
		'FP_Debug_Data',
		'FP_Dependencies',
		'FP_Duotone',
		'FP_Embed',
		'FP_Error',
		'FP_Exception',
		'FP_Fatal_Error_Handler',
		'FP_Feed_Cache',
		'FP_Feed_Cache_Transient',
		'FP_Filesystem_Base',
		'FP_Filesystem_Direct',
		'FP_Filesystem_FTPext',
		'FP_Filesystem_SSH2',
		'FP_Filesystem_ftpsockets',
		'FP_Font_Collection',
		'FP_Font_Face',
		'FP_Font_Face_Resolver',
		'FP_Font_Library',
		'FP_Font_Utils',
		'FP_HTML_Active_Formatting_Elements',
		'FP_HTML_Attribute_Token',
		'FP_HTML_Decoder',
		'FP_HTML_Doctype_Info',
		'FP_HTML_Open_Elements',
		'FP_HTML_Processor',
		'FP_HTML_Processor_State',
		'FP_HTML_Span',
		'FP_HTML_Stack_Event',
		'FP_HTML_Tag_Processor',
		'FP_HTML_Text_Replacement',
		'FP_HTML_Token',
		'FP_HTML_Unsupported_Exception',
		'FP_HTTP_Fsockopen',
		'FP_HTTP_IXR_Client',
		'FP_HTTP_Proxy',
		'FP_HTTP_Requests_Hooks',
		'FP_HTTP_Requests_Response',
		'FP_HTTP_Response',
		'FP_Hook',
		'FP_Http',
		'FP_Http_Cookie',
		'FP_Http_Curl',
		'FP_Http_Encoding',
		'FP_Http_Streams',
		'FP_Image_Editor',
		'FP_Image_Editor_GD',
		'FP_Image_Editor_Imagick',
		'FP_Importer',
		'FP_Interactivity_API',
		'FP_Interactivity_API_Directives_Processor',
		'FP_Internal_Pointers',
		'FP_Links_List_Table',
		'FP_List_Table',
		'FP_List_Util',
		'FP_Locale',
		'FP_Locale_Switcher',
		'FP_MS_Sites_List_Table',
		'FP_MS_Themes_List_Table',
		'FP_MS_Users_List_Table',
		'FP_MatchesMapRegex',
		'FP_Media_List_Table',
		'FP_Meta_Query',
		'FP_Metadata_Lazyloader',
		'FP_Nav_Menu_Widget',
		'FP_Navigation_Block_Renderer',
		'FP_Navigation_Fallback',
		'FP_Network',
		'FP_Network_Query',
		'FP_Object_Cache',
		'FP_PHPMailer',
		'FP_Paused_Extensions_Storage',
		'FP_Plugin_Dependencies',
		'FP_Plugin_Install_List_Table',
		'FP_Plugins_List_Table',
		'FP_Post',
		'FP_Post_Comments_List_Table',
		'FP_Post_Type',
		'FP_Posts_List_Table',
		'FP_Privacy_Data_Export_Requests_List_Table',
		'FP_Privacy_Data_Export_Requests_Table',
		'FP_Privacy_Data_Removal_Requests_List_Table',
		'FP_Privacy_Data_Removal_Requests_Table',
		'FP_Privacy_Policy_Content',
		'FP_Privacy_Requests_Table',
		'FP_Query',
		'FP_REST_Application_Passwords_Controller',
		'FP_REST_Attachments_Controller',
		'FP_REST_Autosaves_Controller',
		'FP_REST_Block_Directory_Controller',
		'FP_REST_Block_Pattern_Categories_Controller',
		'FP_REST_Block_Patterns_Controller',
		'FP_REST_Block_Renderer_Controller',
		'FP_REST_Block_Types_Controller',
		'FP_REST_Blocks_Controller',
		'FP_REST_Comment_Meta_Fields',
		'FP_REST_Comments_Controller',
		'FP_REST_Controller',
		'FP_REST_Edit_Site_Export_Controller',
		'FP_REST_Font_Collections_Controller',
		'FP_REST_Font_Faces_Controller',
		'FP_REST_Font_Families_Controller',
		'FP_REST_Global_Styles_Controller',
		'FP_REST_Global_Styles_Revisions_Controller',
		'FP_REST_Menu_Items_Controller',
		'FP_REST_Menu_Locations_Controller',
		'FP_REST_Menus_Controller',
		'FP_REST_Meta_Fields',
		'FP_REST_Navigation_Fallback_Controller',
		'FP_REST_Pattern_Directory_Controller',
		'FP_REST_Plugins_Controller',
		'FP_REST_Post_Format_Search_Handler',
		'FP_REST_Post_Meta_Fields',
		'FP_REST_Post_Search_Handler',
		'FP_REST_Post_Statuses_Controller',
		'FP_REST_Post_Types_Controller',
		'FP_REST_Posts_Controller',
		'FP_REST_Request',
		'FP_REST_Response',
		'FP_REST_Revisions_Controller',
		'FP_REST_Search_Controller',
		'FP_REST_Search_Handler',
		'FP_REST_Server',
		'FP_REST_Settings_Controller',
		'FP_REST_Sidebars_Controller',
		'FP_REST_Site_Health_Controller',
		'FP_REST_Taxonomies_Controller',
		'FP_REST_Template_Autosaves_Controller',
		'FP_REST_Template_Revisions_Controller',
		'FP_REST_Templates_Controller',
		'FP_REST_Term_Meta_Fields',
		'FP_REST_Term_Search_Handler',
		'FP_REST_Terms_Controller',
		'FP_REST_Themes_Controller',
		'FP_REST_URL_Details_Controller',
		'FP_REST_User_Meta_Fields',
		'FP_REST_Users_Controller',
		'FP_REST_Widget_Types_Controller',
		'FP_REST_Widgets_Controller',
		'FP_Recovery_Mode',
		'FP_Recovery_Mode_Cookie_Service',
		'FP_Recovery_Mode_Email_Service',
		'FP_Recovery_Mode_Key_Service',
		'FP_Recovery_Mode_Link_Service',
		'FP_Rewrite',
		'FP_Role',
		'FP_Roles',
		'FP_Screen',
		'FP_Script_Modules',
		'FP_Scripts',
		'FP_Session_Tokens',
		'FP_Sidebar_Block_Editor_Control',
		'FP_SimplePie_File',
		'FP_SimplePie_Sanitize_KSES',
		'FP_Site',
		'FP_Site_Health',
		'FP_Site_Health_Auto_Updates',
		'FP_Site_Icon',
		'FP_Site_Query',
		'FP_Sitemaps',
		'FP_Sitemaps_Index',
		'FP_Sitemaps_Posts',
		'FP_Sitemaps_Provider',
		'FP_Sitemaps_Registry',
		'FP_Sitemaps_Renderer',
		'FP_Sitemaps_Stylesheet',
		'FP_Sitemaps_Taxonomies',
		'FP_Sitemaps_Users',
		'FP_Speculation_Rules',
		'FP_Style_Engine',
		'FP_Style_Engine_CSS_Declarations',
		'FP_Style_Engine_CSS_Rule',
		'FP_Style_Engine_CSS_Rules_Store',
		'FP_Style_Engine_Processor',
		'FP_Styles',
		'FP_Tax_Query',
		'FP_Taxonomy',
		'FP_Term',
		'FP_Term_Query',
		'FP_Terms_List_Table',
		'FP_Text_Diff_Renderer_Table',
		'FP_Text_Diff_Renderer_inline',
		'FP_Textdomain_Registry',
		'FP_Theme',
		'FP_Theme_Install_List_Table',
		'FP_Theme_JSON',
		'FP_Theme_JSON_Data',
		'FP_Theme_JSON_Resolver',
		'FP_Theme_JSON_Schema',
		'FP_Themes_List_Table',
		'FP_Token_Map',
		'FP_Translation_Controller',
		'FP_Translation_File',
		'FP_Translation_File_MO',
		'FP_Translation_File_PHP',
		'FP_Translations',
		'FP_URL_Pattern_Prefixer',
		'FP_Upgrader',
		'FP_Upgrader_Skin',
		'FP_User',
		'FP_User_Meta_Session_Tokens',
		'FP_User_Query',
		'FP_User_Request',
		'FP_User_Search',
		'FP_Users_List_Table',
		'FP_Widget',
		'FP_Widget_Archives',
		'FP_Widget_Area_Customize_Control',
		'FP_Widget_Block',
		'FP_Widget_Calendar',
		'FP_Widget_Categories',
		'FP_Widget_Custom_HTML',
		'FP_Widget_Factory',
		'FP_Widget_Form_Customize_Control',
		'FP_Widget_Links',
		'FP_Widget_Media',
		'FP_Widget_Media_Audio',
		'FP_Widget_Media_Gallery',
		'FP_Widget_Media_Image',
		'FP_Widget_Media_Video',
		'FP_Widget_Meta',
		'FP_Widget_Pages',
		'FP_Widget_RSS',
		'FP_Widget_Recent_Comments',
		'FP_Widget_Recent_Posts',
		'FP_Widget_Search',
		'FP_Widget_Tag_Cloud',
		'FP_Widget_Text',
		'FP_oEmbed',
		'FP_oEmbed_Controller',
		'fp_atom_server',
		'fp_xmlrpc_server',
		'fpdb',
	);

	/**
	 * List of all FP native classes as shipped with themes included in FP Core.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $fp_themes_classes = array(
		'TwentyNineteen_SVG_Icons',
		'TwentyNineteen_Walker_Comment',
		'TwentyTwenty_Customize',
		'TwentyTwenty_Non_Latin_Languages',
		'TwentyTwenty_SVG_Icons',
		'TwentyTwenty_Script_Loader',
		'TwentyTwenty_Separator_Control',
		'TwentyTwenty_Walker_Comment',
		'TwentyTwenty_Walker_Page',
		'Twenty_Eleven_Ephemera_Widget',
		'Twenty_Fourteen_Ephemera_Widget',
		'Twenty_Twenty_One_Custom_Colors',
		'Twenty_Twenty_One_Customize',
		'Twenty_Twenty_One_Customize_Color_Control',
		'Twenty_Twenty_One_Customize_Notice_Control',
		'Twenty_Twenty_One_Dark_Mode',
		'Twenty_Twenty_One_SVG_Icons',
	);

	/**
	 * List of all AVIF classes included in FP Core.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.1.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $avif_classes = array(
		'Avifinfo\\Box',
		'Avifinfo\\Chan_Prop',
		'Avifinfo\\Dim_Prop',
		'Avifinfo\\Features',
		'Avifinfo\\Parser',
		'Avifinfo\\Prop',
		'Avifinfo\\Tile',
	);

	/**
	 * List of all GetID3 classes included in FP Core.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $getid3_classes = array(
		'AMFReader',
		'AMFStream',
		'AVCSequenceParameterSetReader',
		'getID3',
		'getid3_ac3',
		'getid3_apetag',
		'getid3_asf',
		'getid3_dts',
		'getid3_exception',
		'getid3_flac',
		'getid3_flv',
		'getid3_handler',
		'getid3_id3v1',
		'getid3_id3v2',
		'getid3_lib',
		'getid3_lyrics3',
		'getid3_matroska',
		'getid3_mp3',
		'getid3_ogg',
		'getid3_quicktime',
		'getid3_riff',
	);

	/**
	 * List of all PHPMailer classes included in FP Core.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $phpmailer_classes = array(
		'PHPMailer\\PHPMailer\\Exception',
		'PHPMailer\\PHPMailer\\PHPMailer',
		'PHPMailer\\PHPMailer\\SMTP',
	);

	/**
	 * List of all Requests classes included in FP Core.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $requests_classes = array(
		// Interfaces, Requests v1.
		'Requests_Auth',
		'Requests_Hooker',
		'Requests_Proxy',
		'Requests_Transport',

		// Interfaces, Requests v2.
		'WpOrg\\Requests\\Auth',
		'WpOrg\\Requests\\Capability',
		'WpOrg\\Requests\\HookManager',
		'WpOrg\\Requests\\Proxy',
		'WpOrg\\Requests\\Transport',

		// Classes, Requests v1.
		'Requests',
		'Requests_Auth_Basic',
		'Requests_Cookie',
		'Requests_Cookie_Jar',
		'Requests_Exception',
		'Requests_Exception_HTTP',
		'Requests_Exception_Transport',
		'Requests_Exception_Transport_cURL',
		'Requests_Exception_HTTP_304',
		'Requests_Exception_HTTP_305',
		'Requests_Exception_HTTP_306',
		'Requests_Exception_HTTP_400',
		'Requests_Exception_HTTP_401',
		'Requests_Exception_HTTP_402',
		'Requests_Exception_HTTP_403',
		'Requests_Exception_HTTP_404',
		'Requests_Exception_HTTP_405',
		'Requests_Exception_HTTP_406',
		'Requests_Exception_HTTP_407',
		'Requests_Exception_HTTP_408',
		'Requests_Exception_HTTP_409',
		'Requests_Exception_HTTP_410',
		'Requests_Exception_HTTP_411',
		'Requests_Exception_HTTP_412',
		'Requests_Exception_HTTP_413',
		'Requests_Exception_HTTP_414',
		'Requests_Exception_HTTP_415',
		'Requests_Exception_HTTP_416',
		'Requests_Exception_HTTP_417',
		'Requests_Exception_HTTP_418',
		'Requests_Exception_HTTP_428',
		'Requests_Exception_HTTP_429',
		'Requests_Exception_HTTP_431',
		'Requests_Exception_HTTP_500',
		'Requests_Exception_HTTP_501',
		'Requests_Exception_HTTP_502',
		'Requests_Exception_HTTP_503',
		'Requests_Exception_HTTP_504',
		'Requests_Exception_HTTP_505',
		'Requests_Exception_HTTP_511',
		'Requests_Exception_HTTP_Unknown',
		'Requests_Hooks',
		'Requests_IDNAEncoder',
		'Requests_IPv6',
		'Requests_IRI',
		'Requests_Proxy_HTTP',
		'Requests_Response',
		'Requests_Response_Headers',
		'Requests_Session',
		'Requests_SSL',
		'Requests_Transport_cURL',
		'Requests_Transport_fsockopen',
		'Requests_Utility_CaseInsensitiveDictionary',
		'Requests_Utility_FilteredIterator',

		// Classes, Requests v2.
		'WpOrg\Requests\Auth\Basic',
		'WpOrg\Requests\Autoload',
		'WpOrg\Requests\Cookie',
		'WpOrg\Requests\Cookie\Jar',
		'WpOrg\Requests\Exception',
		'WpOrg\Requests\Exception\ArgumentCount',
		'WpOrg\Requests\Exception\Http',
		'WpOrg\Requests\Exception\Http\Status304',
		'WpOrg\Requests\Exception\Http\Status305',
		'WpOrg\Requests\Exception\Http\Status306',
		'WpOrg\Requests\Exception\Http\Status400',
		'WpOrg\Requests\Exception\Http\Status401',
		'WpOrg\Requests\Exception\Http\Status402',
		'WpOrg\Requests\Exception\Http\Status403',
		'WpOrg\Requests\Exception\Http\Status404',
		'WpOrg\Requests\Exception\Http\Status405',
		'WpOrg\Requests\Exception\Http\Status406',
		'WpOrg\Requests\Exception\Http\Status407',
		'WpOrg\Requests\Exception\Http\Status408',
		'WpOrg\Requests\Exception\Http\Status409',
		'WpOrg\Requests\Exception\Http\Status410',
		'WpOrg\Requests\Exception\Http\Status411',
		'WpOrg\Requests\Exception\Http\Status412',
		'WpOrg\Requests\Exception\Http\Status413',
		'WpOrg\Requests\Exception\Http\Status414',
		'WpOrg\Requests\Exception\Http\Status415',
		'WpOrg\Requests\Exception\Http\Status416',
		'WpOrg\Requests\Exception\Http\Status417',
		'WpOrg\Requests\Exception\Http\Status418',
		'WpOrg\Requests\Exception\Http\Status428',
		'WpOrg\Requests\Exception\Http\Status429',
		'WpOrg\Requests\Exception\Http\Status431',
		'WpOrg\Requests\Exception\Http\Status500',
		'WpOrg\Requests\Exception\Http\Status501',
		'WpOrg\Requests\Exception\Http\Status502',
		'WpOrg\Requests\Exception\Http\Status503',
		'WpOrg\Requests\Exception\Http\Status504',
		'WpOrg\Requests\Exception\Http\Status505',
		'WpOrg\Requests\Exception\Http\Status511',
		'WpOrg\Requests\Exception\Http\StatusUnknown',
		'WpOrg\Requests\Exception\InvalidArgument',
		'WpOrg\Requests\Exception\Transport',
		'WpOrg\Requests\Exception\Transport\Curl',
		'WpOrg\Requests\Hooks',
		'WpOrg\Requests\IdnaEncoder',
		'WpOrg\Requests\Ipv6',
		'WpOrg\Requests\Iri',
		'WpOrg\Requests\Port',
		'WpOrg\Requests\Proxy\Http',
		'WpOrg\Requests\Requests',
		'WpOrg\Requests\Response',
		'WpOrg\Requests\Response\Headers',
		'WpOrg\Requests\Session',
		'WpOrg\Requests\Ssl',
		'WpOrg\Requests\Transport\Curl',
		'WpOrg\Requests\Transport\Fsockopen',
		'WpOrg\Requests\Utility\CaseInsensitiveDictionary',
		'WpOrg\Requests\Utility\FilteredIterator',
		'WpOrg\Requests\Utility\InputValidator',
	);

	/**
	 * List of all SimplePie classes included in FP Core.
	 *
	 * Note: this list will be enhanced in the class constructor.
	 *
	 * {@internal To be updated after every major release. Last updated for FinPress 6.8.1.}
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in their "proper" case.
	 *               The constructor will add the lowercased class name as a key to each entry.
	 */
	private $simplepie_classes = array(
		// Interfaces, SimplePie v1.
		'SimplePie_Cache_Base',

		// Interfaces, SimplePie v2 (with BC layer in v1).
		'SimplePie\Cache\Base',
		'SimplePie\Cache\DataCache',
		'SimplePie\Cache\NameFilter',
		'SimplePie\RegistryAware',

		// Classes, SimplePie v1.
		'SimplePie',
		'SimplePie_Autoloader',
		'SimplePie_Author',
		'SimplePie_Cache',
		'SimplePie_Cache_DB',
		'SimplePie_Cache_File',
		'SimplePie_Cache_Memcache',
		'SimplePie_Cache_Memcached',
		'SimplePie_Cache_MySQL',
		'SimplePie_Cache_Redis',
		'SimplePie_Caption',
		'SimplePie_Category',
		'SimplePie_Content_Type_Sniffer',
		'SimplePie_Copyright',
		'SimplePie_Core',
		'SimplePie_Credit',
		'SimplePie_Decode_HTML_Entities',
		'SimplePie_Enclosure',
		'SimplePie_Exception',
		'SimplePie_File',
		'SimplePie_HTTP_Parser',
		'SimplePie_IRI',
		'SimplePie_Item',
		'SimplePie_Locator',
		'SimplePie_Misc',
		'SimplePie_Net_IPv6',
		'SimplePie_Parse_Date',
		'SimplePie_Parser',
		'SimplePie_Rating',
		'SimplePie_Registry',
		'SimplePie_Restriction',
		'SimplePie_Sanitize',
		'SimplePie_Source',
		'SimplePie_XML_Declaration_Parser',
		'SimplePie_gzdecode',

		// Classes, SimplePie v2 (with BC layer in v1).
		'SimplePie\Author',
		'SimplePie\Cache',
		'SimplePie\Cache\BaseDataCache',
		'SimplePie\Cache\CallableNameFilter',
		'SimplePie\Cache\DB',
		'SimplePie\Cache\File',
		'SimplePie\Cache\Memcache',
		'SimplePie\Cache\Memcached',
		'SimplePie\Cache\MySQL',
		'SimplePie\Cache\Psr16',
		'SimplePie\Cache\Redis',
		'SimplePie\Caption',
		'SimplePie\Category',
		'SimplePie\Content\Type\Sniffer',
		'SimplePie\Copyright',
		'SimplePie\Credit',
		'SimplePie\Enclosure',
		'SimplePie\Exception',
		'SimplePie\File',
		'SimplePie\Gzdecode',
		'SimplePie\HTTP\Parser',
		'SimplePie\IRI',
		'SimplePie\Item',
		'SimplePie\Locator',
		'SimplePie\Misc',
		'SimplePie\Net\IPv6',
		'SimplePie\Parse\Date',
		'SimplePie\Parser',
		'SimplePie\Rating',
		'SimplePie\Registry',
		'SimplePie\Restriction',
		'SimplePie\Sanitize',
		'SimplePie\SimplePie',
		'SimplePie\Source',
		'SimplePie\XML\Declaration\Parser',
	);

	/**
	 * List of all FP native classes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $fp_classes property.
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $fp_classes_lc = array();

	/**
	 * List of all FP native classes as shipped with themes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $fp_themes_classes property.
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $fp_themes_classes_lc = array();

	/**
	 * List of all AVIF classes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $avif_classes property.
	 *
	 * @since 3.1.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $avif_classes_lc = array();

	/**
	 * List of all GetID3 classes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $phpmailer_classes property.
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $getid3_classes_lc = array();

	/**
	 * List of all PHPMailer classes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $phpmailer_classes property.
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $phpmailer_classes_lc = array();

	/**
	 * List of all Requests classes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $requests_classes property.
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $requests_classes_lc = array();

	/**
	 * List of all SimplePie classes in lowercase.
	 *
	 * This array is automatically generated in the class constructor based on the $simplepie_classes property.
	 *
	 * @since 3.0.0
	 *
	 * @var string[] The class names in lowercase.
	 */
	private $simplepie_classes_lc = array();

	/**
	 * Groups names.
	 *
	 * Used to dynamically fill in some of the above properties and to generate the getGroups() array.
	 *
	 * @since 3.0.0
	 *
	 * @var array
	 */
	private $class_groups = array(
		'fp_classes',
		'fp_themes_classes',
		'avif_classes',
		'getid3_classes',
		'phpmailer_classes',
		'requests_classes',
		'simplepie_classes',
	);

	/**
	 * Constructor.
	 *
	 * @since 3.0.0
	 */
	public function __construct() {
		// Adjust the class list properties to have the lowercased version of the value as a key.
		foreach ( $this->class_groups as $name ) {
			$name_lc        = $name . '_lc';
			$this->$name_lc = array_map( 'strtolower', $this->$name );
			$this->$name    = array_combine( $this->$name_lc, $this->$name );
		}
	}

	/**
	 * Groups of classes to restrict.
	 *
	 * @since 3.0.0
	 *
	 * @return array
	 */
	public function getGroups() {
		$groups = array();
		foreach ( $this->class_groups as $name ) {
			$name_lc         = $name . '_lc';
			$groups[ $name ] = array(
				'classes' => $this->$name_lc,
			);
		}

		return $groups;
	}

	/**
	 * Process a matched token.
	 *
	 * @since 3.0.0
	 *
	 * @param int    $stackPtr        The position of the current token in the stack.
	 * @param string $group_name      The name of the group which was matched. Will
	 *                                always be 'fp_classes'.
	 * @param string $matched_content The token content (class name) which was matched.
	 *                                in its original case.
	 *
	 * @return void
	 */
	public function process_matched_token( $stackPtr, $group_name, $matched_content ) {

		$matched_unqualified = ltrim( $matched_content, '\\' );
		$matched_lowercase   = strtolower( $matched_unqualified );
		$matched_proper_case = $this->get_proper_case( $matched_lowercase );

		if ( $matched_unqualified === $matched_proper_case ) {
			// Already using proper case, nothing to do.
			return;
		}

		$warning = 'It is strongly recommended to refer to classes by their properly cased name. Expected: %s Found: %s';
		$data    = array(
			$matched_proper_case,
			$matched_unqualified,
		);

		$this->phpcsFile->addWarning( $warning, $stackPtr, 'Incorrect', $data );
	}

	/**
	 * Match a lowercase class name to its proper cased name.
	 *
	 * @since 3.0.0
	 *
	 * @param string $matched_lc Lowercase class name.
	 *
	 * @return string
	 */
	private function get_proper_case( $matched_lc ) {
		foreach ( $this->class_groups as $name ) {
			$current = $this->$name; // Needed to prevent issues with PHP < 7.0.
			if ( isset( $current[ $matched_lc ] ) ) {
				return $current[ $matched_lc ];
			}
		}

		// Shouldn't be possible.
		return ''; // @codeCoverageIgnore
	}
}
