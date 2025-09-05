<?php

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . $_GET['title'] . "';" ); // Bad.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '{$_GET['title']}';" ); // Bad.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '$var';" ); // Bad.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE 'Hello World!';" ); // Ok.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '{$_GET['title']}';" ) ); // Bad.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '$var';" ) ); // Bad.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title LIKE %s;", $_GET['title'] ) ); // Ok.

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . $escaped_var . "';" ); // Bad: old-style ignore comment. FPCS: unprepared SQL OK.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '{$escaped_var}';" ); //  Bad: old-style ignore comment. FPCS: unprepared SQL OK.

$fpdb->query( $fpdb->prepare( "SELECT SUBSTRING( post_name, %d + 1 ) REGEXP '^[0-9]+$'", array( 123 ) ) ); // Ok.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title = 'The \$_GET var can be evil.' AND ID = %s", array( 123 ) ) ); // Ok.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title = 'The $_GET[foo] var is evil.' AND ID = %s", array( 123 ) ) ); // Bad.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title = 'The \\$_GET[foo]// var is evil again.' AND ID = %s", array( 123 ) ) ); // Bad.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title = 'The \$_GET var can be evil, but $_GET[foo] var is evil.' AND ID = %s", array( 123 ) ) ); // Bad.

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . foo() . "';" ); // Bad.
$fpdb->query( $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . foo() . "';" ) ); // Bad.

$fpdb->query( "SELECT * FROM " . $fpdb->posts . " WHERE post_title LIKE 'foo';" ); // Ok.

// All OK.
$all_post_meta = $fpdb->get_results( $fpdb->prepare( sprintf(
	'SELECT `post_id`, `meta_value` FROM `%s` WHERE `meta_key` = "sort_order" AND `post_id` IN (%s)',
	$fpdb->postmeta,
	implode( ',', array_fill( 0, count( $post_ids ), '%d' ) )
), $post_ids ) );

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . esc_sql( $foo ) . "';" ); // Ok.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE ID = " . absint( $foo ) . ";" ); // Ok.

// Test multi-line strings.
$all_post_meta = $fpdb->get_results( $fpdb->prepare( sprintf(
	'SELECT `post_id`, `meta_value`
	FROM `%s`
	WHERE `meta_key` = "sort_order"
		AND `post_id` IN (%s)',
	$fpdb->postmeta,
	\implode( ',', \array_fill( 0, \count( $post_ids ), '%d' ) )
), $post_ids ) ); // Ok.

$fpdb->query( "
	SELECT *
	FROM $fpdb->posts
	WHERE post_title LIKE '" . esc_sql( $foo ) . "';"
); // Ok.

$fpdb->query( $fpdb->prepare( "
	SELECT *
	FROM $fpdb->posts
	WHERE post_title = 'The \\$_GET[foo]// var is evil again.'
		AND ID = %s",
	array( 123 )
) ); // Bad.


// Test heredoc & nowdoc for query.
$fpdb->query( <<<EOT
	SELECT *
	FROM {$fpdb->posts}
	WHERE ID = {$foo};
EOT
); // Bad.

$fpdb->query( <<<"HD"
	SELECT *
	FROM {$fpdb->posts}
	WHERE post_title LIKE '{$var}';
HD
); // Bad.

$all_post_meta = $fpdb->get_results( $fpdb->prepare( sprintf( <<<'ND'
	SELECT `post_id`, `meta_value`
	FROM `%s`
	WHERE `meta_key` = "sort_order"
		AND `post_id` IN (%s)
ND
	, $fpdb->postmeta,
	IMPLODE( ',', array_fill( 0, count( $post_ids ), '%d' ) )
), $post_ids ) ); // OK.

fpdb::prepare( "SELECT * FROM $fpdb?->posts WHERE post_title LIKE '" . foo() . "';" ); // Bad.

$fpdb->query( // Some arbitrary comment.
	"SELECT *
		FROM $fpdb->posts
		WHERE post_title LIKE '" . $escaped_var . "';"
); // Bad x 1.

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE ID = " . (int) $foo . ";" ); // Ok.

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . (float) $foo . ";" ); // Ok.

$fpdb->query(
	"SELECT * FROM $fpdb->posts
	WHERE ID = "
	. absint // Ok.
		( $foo )
	. ";"
);

// Test handling of more complex embedded variables and expressions.
$fpdb->query( "SELECT * FROM {$fpdb->bar()} WHERE post_title LIKE '{$title->sub()}';" ); // Bad x 1.
$fpdb->query( "SELECT * FROM ${fpdb->bar} WHERE post_title LIKE '${title->sub}';" ); // Bad x 1.
$fpdb->query( "SELECT * FROM ${fpdb->{$baz}} WHERE post_title LIKE '${title->{$sub}}';" ); // Bad x 1.
$fpdb->query( "SELECT * FROM ${fpdb->{${'a'}}} WHERE post_title LIKE '${title->{${'sub'}}}';" ); // Bad x 1.

// More defensive variable checking
$fpdb->query( "SELECT * FROM $fpdb" ); // Bad x 1, $fpdb on its own is not valid.

$fpdb
	-> /*comment*/ query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . $_GET['title'] . "';" ); // Bad.

$fpdb?->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . (int) $foo . "';" ); // OK.
$fpdb?->query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . foo() . "';" ); // Bad.

FPDB::prepare( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . foo() . "';" ); // Bad.
$fpdb->Query( "SELECT * FROM $fpdb->posts WHERE post_title LIKE '" . foo() . "';" ); // Bad.

$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . {$foo} . ";" ); // Bad - on $foo, not on the {}.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . (array) $foo . ";" ); // Bad - on $foo, not on the (array).
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . -10 . ";" ); // OK.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . +1.0 . ";" ); // OK.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . 10 / 2.5 . ";" ); // OK.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . ++$foo . ";" ); // Bad - on $foo, not on the ++.

// Safeguard handling of PHP 8.0+ nullsafe object operators found within a query.
$fpdb->query( $fpdb->prepare( 'SELECT * FROM ' . $fpdb::TABLE_NAME . " WHERE post_title LIKE '%s';", '%something' ) ); // OK.
$fpdb->query( $fpdb->prepare( 'SELECT * FROM ' . $notfpdb?->posts . " WHERE post_title LIKE '%s';", '%something' ) ); // Bad.

// Safeguard handling of PHP 7.4+ numeric literals with undersocres and PHP 8.1 explicit octals.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . 10_000 . ";" ); // OK.
$fpdb->query( "SELECT * FROM $fpdb->posts WHERE value = " . 0o34 . ";" ); // OK.

// Not a method call.
$fpdb = new FPDB();
$foo = $fpdb->propertyAccess;
echo $fpdb::CONSTANT_NAME;

// Not an identifiable method call.
$fpdb->{$methodName}('query');

// Don't throw an error during live coding.
fpdb::prepare( "SELECT * FROM $fpdb->posts
