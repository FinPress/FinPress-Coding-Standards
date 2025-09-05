<?php

/*
 * These should be disregarded by the sniff.
 */
class Foo {
	function bar() {
		$obj = new self();
		echo static::MY_CONSTANT;
	}
}

$obj = new Not_A_FP_Core_Class();


/*
 * These all use the class name in proper case.
 */
$obj = new FP_Importer();
$obj = new \FP_Query;

class MyList extends FP_List_Table {}

echo FP_User_Search::$users_per_page;
FP_Customize_New_Menu_Control::foo();

// External libraries.
$obj = new getID3;
class MyMailer extends PHPMailer\PHPMailer\PHPMailer {}
$obj = new Requests_Cookie_Jar();
$anon = new class extends SimplePie_IRI {};


/*
 * These all use the class name in an unconventional case.
 */
$obj = new FPDB();
$obj = new \FP_date_query;

class MyList extends \FP_LIST_table {}

echo fp_user_search::$users_per_page;
FP_Customize_NEW_Menu_Control::foo();

// External libraries.
$obj = new GetID3();
class MyMailer extends PhpMailer\PhpMailer\PhpMailer {}
$obj = new Requests_cookie_jar();
$anon = new class extends SimplePie_Iri {};


/*
 * These will not (yet) be detected as the abstract doesn't handle these.
 * This will be fixed in the future when the PHPCSUtils abstract will be made available.
 */

try {
	// Do something.
} catch ( Wp_Error ) {
}

class NotYetDetected {
	public WalKer $property_type;

	public function paramTypeDeclaration( fp_role $role ) {}
	public function returnTypeDeclaration() : FP_TERM {}
}
