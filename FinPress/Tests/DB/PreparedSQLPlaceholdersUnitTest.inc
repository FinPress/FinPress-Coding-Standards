<?php

$sql = $fpdb->prepare( $sql, $replacements ); // OK - no query available to examine - this will be handled by the PreparedSQL sniff.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", 1, "admin" ); // OK.
$sql = $fpdb?->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", array( 1, "admin" ) ); // OK.
$sql = $fpdb->prepare( 'SELECT * FROM `table` WHERE `column` = %s AND `field` = %d', 'foo', 1337 ); // OK.
$sql = $fpdb->prepare( 'SELECT DATE_FORMAT(`field`, "%%c") FROM `table` WHERE `column` = %s', 'foo' ); // OK.

/*
 * No placeholders, no need to use prepare().
 */
$sql = $fpdb->prepare( 'SELECT * FROM `table`' ); // Warning.
$sql = $fpdb->prepare( 'SELECT * FROM `table` WHERE id = ' . $id ); // OK - this will be handled by the PreparedSQL sniff.
$sql = $fpdb->prepare( "SELECT * FROM `table` WHERE id = $id" ); // OK - this will be handled by the PreparedSQL sniff.
$sql = $fpdb->prepare( "SELECT * FROM `table` WHERE id = {$id['some%sing']}" ); // OK - this will be handled by the PreparedSQL sniff.
$sql = $fpdb?->prepare( 'SELECT * FROM ' . $fpdb->users ); // Warning.
$sql = $fpdb->prepare( "SELECT * FROM `{$fpdb->users}`" );  // Warning.
$sql = $fpdb->prepare( "SELECT * FROM `{$fpdb->users}` WHERE id = $id" ); // OK - this will be handled by the PreparedSQL sniff.

/*
 * No placeholders found, but replacement variable(s) are being passed.
 */
$sql = $fpdb->prepare( 'SELECT * FROM `table`', $something ); // Warning.

/*
 * Test passing invalid replacement placeholder.
 */
$sql = $fpdb->prepare( '%d %1$e %%% % %A %h', 1 ); // Bad x 5.
$sql = $fpdb->prepare( '%%%s', 1 ); // OK.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb?->users WHERE id = %1\$d AND user_login = %2\$s", 1, "admin" ); // OK. 2 x warning for unquoted complex placeholders.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb?->users WHERE id = %01.2f AND user_login = %10.10X", 1, "admin" ); // Bad x 1 + 1 warning unquoted complex placeholders + 1 warning nr of replacements.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %'.09F AND user_login = %1\$04x", 1, "admin" ); // Bad x 1 + 1 warning unquoted complex placeholders + 1 warning nr of replacements.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = \"%1\$c\" AND user_login = '%2\$e'", 1, "admin" ); // Bad x 2 + 1 warning.
$sql = $fpdb->prepare( 'SELECT * FROM ' . $fpdb?->users . ' WHERE id = \'%1\$b\' AND user_login = "%2\$o"', 1, "admin" ); // Bad x 2 + 1 warning.

/*
 * Test passing quoted simple replacement placeholder and unquoted complex placeholder.
 */
$sql = $fpdb->prepare( '"%f"', 1.1 ); // Bad.
$sql = $fpdb->prepare( 'SELECT * FROM `table` WHERE `field` = \'%s\'', 'string' ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM `table` WHERE `id` = \"%d\"", 1 ); // Bad.
$sql = $fpdb->prepare( <<<EOD
	SELECT *
	FROM `%1\$s`
	WHERE id = %2\$d
		AND `%3\$s` = "%4\$s"
EOD
	, $fpdb->users, 1, 'user_login', "admin"
); // Warning x 3, unquoted complex placeholder.

/*
 * Test passing an incorrect amount of replacement parameters.
 */
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s" ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", 1 ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", 1, "admin", $variable ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", array( 1 ) ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", [1, "admin", $variable] ); // Bad.

$replacements = [1, "admin", $variable];
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", $replacements ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->users WHERE id = %d AND user_login = %s", $replacements ); // Bad - old-style ignore comment. FPCS: PreparedSQLPlaceholders replacement count OK.

// Valid test case as found in FP core /fp-admin/includes/export.php
$esses = array_fill( 0, count($post_types), '%s' );
$where = $fpdb->prepare( "{$fpdb->posts}.post_type IN (" . implode( ',', $esses ) . ')', $post_types ); // Warning.
// Testing that ignore comment works for this mismatch too.
$where = $fpdb->prepare( "{$fpdb->posts}.post_type IN (" . implode( ',', $esses ) . ')', $post_types ); // Bad - old-style ignore comment. FPCS: PreparedSQLPlaceholders replacement count OK.

/*
 * Test correctly recognizing queries using IN in combination with dynamic placeholder creation.
 */
// The proper way to write a query using `IN` won't throw a warning:
$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( 0, count($post_types), '%s' ) )
	),
	$post_types
); // OK.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)
		AND {$fpdb->posts}.post_status IN (%s)",
		implode( ',', array_fill( 0, count($post_types), '%s' ), ),
		IMPLODE( ',', Array_Fill( 0, count($post_statusses), '%s' ), ),
	),
	array_merge( $post_types, $post_statusses, ),
); // OK.

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN ("
		. implode( ',', array_fill( 0, count($post_types), '%s' ) )
		. ") AND {$fpdb->posts}.post_status IN ("
		. implode( ',', array_fill( 0, count($post_statusses), '%s' ) )
		. ')',
	array_merge( $post_types, $post_statusses )
); // OK.

$query = $fpdb->prepare(
	sprintf(
		'SELECT COUNT(ID)
		  FROM `%s`
		 WHERE ID IN (%s)
		   AND post_status = "publish"',
		$fpdb->posts,
		implode( ',', array_fill( 0, count( $post_ids ), '%d' ) )
	) . ' AND post_type = %s',
	array_merge( $post_ids, array( $this->get_current_post_type() ) ),
); // OK.

$results = $fpdb->get_results(
	$fpdb->prepare( '
		SELECT ID
		FROM ' . $fpdb->posts . '
		WHERE ID NOT IN( SELECT post_id FROM ' . $fpdb?->postmeta . ' WHERE meta_key = %s AND meta_value = %s )
			AND post_status in( "future", "draft", "pending", "private", "publish" )
			AND post_type in( ' . implode( ',', array_fill( 0, count( $post_types ), '%s' ) ) . ' )
		LIMIT %d',
		$replacements
	),
	ARRAY_A
); // OK.

$query = $fpdb->prepare(
	sprintf(
		'SELECT COUNT(ID)
		  FROM `%s`
		 WHERE ID in (%s)
		   AND post_status = "publish"',
		$fpdb->posts,
		implode( ',', array_fill( 0, count( $post_ids ), '%d' ) )
	) . ' AND post_type = %s',
	array_merge( $post_ids, array( $this->get_current_post_type() ) ),
	$another
); // Error - second replacement param is incorrect, with a variable nr of placeholders you always need to pass a replacement array.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN ('%s')",
		implode( ',', array_fill( 0, count($post_types), '%s' ) ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad x 2 - %s is quoted, so this won't work properly, will throw incorrect nr of replacements error + quotes found.

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN (\""
		. implode( ',', array_fill( 0, count($post_types), '%s' ) )
		. "\") AND {$fpdb->posts}.post_status IN ('"
		. implode( ',', array_fill( 0, count($post_statusses), '%s' ) )
		. '\')',
	array_merge( $post_types, $post_statusses )
); // Bad x 2 - quotes between the () for the IN.

/*
 * Test distinguishing wildcard _ and %'s in LIKE statements.
 */
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_content LIKE %s", $like ); // OK.
$sql = $fpdb->prepare( 'SELECT * FROM ' . $fpdb->posts . ' WHERE post_content LIKE \'a string\'' ); // Warning x 2. Like without wildcard, no need for prepare.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_content LIKE 'a string'" ); // Warning x 2. Like without wildcard, no need for prepare.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_content LIKE '%a string' AND post_status = %s", $status ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_content LIKE 'a string%' AND post_status = %s", $status ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_content LIKE '%a string%' AND post_status = %s", $status ); // Bad.
$sql = $fpdb->prepare( "SELECT * FROM $fpdb->posts WHERE post_content LIKE 'a_string' AND post_status = %s", $status ); // Bad.

// Some VALID test cases as found in plugins published on FP.org.
$comment_id = $fpdb->get_var($fpdb->prepare('SELECT comment_ID FROM ' . $fpdb->comments . ' WHERE comment_post_ID = %d AND comment_agent LIKE %s', intval($post->ID), 'Disqus/1.0:' . $comment_id)); // OK.

$sql = $fpdb->prepare( "SELECT option_name FROM $fpdb->options WHERE option_name LIKE %s", self::CACHE_KEY_PREFIX . '%' ); // OK.

$fpdb->query($fpdb->prepare('UPDATE '.$fpdb->prefix.'posts SET post_content = REPLACE(post_content, %s, %s) WHERE post_type = "page" AND post_content LIKE %s', $meta_before, $meta_after, '%'.$fpdb->esc_like($meta_before).'%')); // OK.

$query = $fpdb->prepare("DELETE FROM {$fpdb->prefix}options WHERE `option_name` LIKE %s OR `option_name` LIKE %s", "%{$transient_name}%", "%{$transient_timeout_name}%"); // OK.

// Some INVALID test cases as found in plugins published on FP.org.
$fpdb->prepare( "UPDATE $fpdb->posts SET post_status = 'pending' WHERE (post_type LIKE 'product_variation' or post_type LIKE 'product') AND NOT ID IN (". implode(",", $imported_ids ) .")"); // Error x 1 for `product_variation`; warning x 1 for wrong use of LIKE with `product`; the PreparedSQL sniff will also kick in and throw an error about `$imported_ids`.

$attachment = $fpdb->get_col( $fpdb->prepare( "SELECT ID FROM $fpdb->posts WHERE guid LIKE '%%%s%%' LIMIT 1;", $img_url ) ); // Bad.

$result = $fpdb->get_col($fpdb->prepare("SELECT guid FROM $fpdb->posts WHERE guid LIKE '%%%s' and post_parent=%d;", $atts['model'], $post->ID )); // Bad.

$comments = $fpdb->get_results( $fpdb->prepare("SELECT * FROM $fpdb->comments WHERE comment_post_ID = %d AND comment_agent NOT LIKE 'Disqus/%%'", $post->ID) ); // Bad.

$sql = $fpdb->prepare( "SELECT count(*) FROM $this->fontsTable WHERE name LIKE '%%%s%%' OR status LIKE '%%%s%%' OR metadata LIKE '%%%s%%'", $search, $search, $search ); // Bad x 3, the PreparedSQL sniff will also kick in and throw an error about `$this`.

$additional_where = $fpdb->prepare(' AND (network like "%%%s%%" OR ProgramTitle like "%%%s%%" OR TransactionStatus like "%%%s%%" ) ', $search, $search, $search); // Bad x 3.

$robots_query    = $fpdb->prepare( "SELECT name FROM $robots_table WHERE %s LIKE concat('%%',name,'%%')", $http_user_agent ); // Bad, the PreparedSQL sniff will also kick in.

$sql = $fpdb->prepare('SELECT * FROM ' . $fpdb->avatar_privacy . ' WHERE email LIKE "%s"', $email); // Bad (quotes).

$res = $fpdb->query( $fpdb->prepare( 'UPDATE ' . $fpdb->posts . ' SET post_name="feed" WHERE post_name LIKE "feed-%" AND LENGTH(post_name)=6 AND post_type=%s', BAWAS_POST_TYPE ) ); // Bad.

$sql = $fpdb->prepare( "SELECT ID FROM $fpdb->users AS us INNER JOIN $fpdb->usermeta AS mt ON ( us.ID = mt.user_id ) WHERE ( mt.meta_key = 'bbp_last_login' AND mt.meta_value < %s ) AND user_id IN ( SELECT user_id FROM $fpdb->usermeta AS mt WHERE (mt.meta_key = '{$fpdb->prefix}capabilities' AND mt.meta_value LIKE '%%bbp_user%%' ))", $beforegmdate ); // Bad.

$paged_events = $fpdb->get_results( $fpdb->prepare( "SELECT id as event_id FROM {$bp->events->table_name} WHERE ( name LIKE '{$filter}%%' OR description LIKE '{$filter}%%' ) AND id IN ({$gids}) " . $oldevents . " {$pag_sql}" ) ); // Bad x 2, the PreparedSQL sniff will also kick in and throw six errors.

$query = $fpdb->prepare( "SELECT language_code FROM {$fpdb->prefix}icl_translations WHERE element_type LIKE '%%post_%%' AND element_id = %d", $post_ID ); // Bad.

$postID = $fpdb->get_var($fpdb->prepare("SELECT `postID` FROM `".EPDataBase::$table_name."` WHERE `path` like '".$filePath."';")); // OK, the PreparedSQL sniff will kick in and throw four errors.

$fpdb->query($fpdb->prepare("show tables like '$this->table_name'")) > 0; // OK, the PreparedSQL sniff will kick in.

$fpdb->query( $fpdb->prepare( "DELETE FROM $fpdb->fp_options WHERE option_name LIKE '%widget_gigya%'" ) ); // Bad.

$where .= $fpdb->prepare( " AND `name` LIKE '%%%%" . '%s' . "%%%%' ", $args['name'] ); // Bad x 2.

$fpdb->query($fpdb->prepare("delete from fp_postmeta where post_id = $target_postId AND meta_key like 'google_snippets'")); // Bad, the PreparedSQL sniff will also kick in and throw an error about `$target_postId`.

// phpcs:set FinPress.DB.PreparedSQLPlaceholders minimum_fp_version 6.2

$fpdb->prepare( 'WHERE %i = %s', $field, $value ); // OK.
$fpdb->prepare( 'WHERE %i = %s', $value ); // ReplacementsWrongNumber.
$fpdb->prepare( 'WHERE %i = %x', $field, $value ); // UnsupportedPlaceholder & ReplacementsWrongNumber.
$fpdb->prepare( 'WHERE %i = %2$s', $field, $value ); // UnquotedComplexPlaceholder.
$fpdb->prepare( 'WHERE %i = %10s', $field, $value ); // UnquotedComplexPlaceholder.
$fpdb->prepare( 'WHERE %i = %2$-10s', $field, $value ); // UnquotedComplexPlaceholder.

$fpdb->prepare( 'WHERE %i = "%s"', $field, $value ); // QuotedSimplePlaceholder.
$fpdb->prepare( 'WHERE "%i" = %s', $field, $value ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( "WHERE \"%i\" = %s", $field, $value ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( "WHERE '%i' = %s", $field, $value ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE \'%i\' = %s', $field, $value ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE `%i` = %s', $field, $value ); // QuotedIdentifierPlaceholder.

$fpdb->prepare( "WHERE '%10i' IS NULL", $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE "%10i" IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE \'%1$i\' IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( "WHERE \"%10i\" IS NULL", $field ); // QuotedIdentifierPlaceholder.

$fpdb->prepare( 'WHERE %1$i IS NULL', $field ); // OK.
$fpdb->prepare( 'WHERE %10i IS NULL', $field ); // OK.
$fpdb->prepare( 'WHERE % i IS NULL', $field ); // UnescapedLiteral & UnfinishedPrepare (while this is valid, should avoid).
$fpdb->prepare( 'WHERE %1$-10i IS NULL', $field ); // OK.
$fpdb->prepare( 'WHERE %1$-10.3i IS NULL', $field ); // OK.
$fpdb->prepare( 'WHERE %1$+10.3i IS NULL', $field ); // OK.
$fpdb->prepare( 'WHERE %1$ 10.3i IS NULL', $field ); // UnsupportedPlaceholder (parsed as "%1$", which is valid, but should avoid).
$fpdb->prepare( 'WHERE %1$010.3i IS NULL', $field ); // OK.
$fpdb->prepare( "WHERE %1$'x10.3i IS NULL", $field ); // OK.

$fpdb->prepare( 'WHERE %.2i IS NULL', 'a``b' ); // Currently ignore, but it might cause a problem (most likely a parse error) "WHERE `a`` IS NULL".

$fpdb->prepare( 'WHERE `%1$i` IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE `%10i` IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE `% i` IS NULL', $field ); // UnescapedLiteral & UnfinishedPrepare (if RegEx matched, then it should be QuotedIdentifierPlaceholder).
$fpdb->prepare( 'WHERE `%1$-10i` IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE `%1$-10.3i` IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE `%1$+10.3i` IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( 'WHERE `%1$ 10.3i` IS NULL', $field ); // QuotedIdentifierPlaceholder, and UnsupportedPlaceholder (parsed as "%1$", which is valid, but should avoid).
$fpdb->prepare( 'WHERE `%1$010.3i` IS NULL', $field ); // QuotedIdentifierPlaceholder.
$fpdb->prepare( "WHERE `%1$'x10.3i` IS NULL", $field ); // QuotedIdentifierPlaceholder.

$fpdb->prepare( 'SELECT ID FROM `%2$i` WHERE `%1$i` = "%3$s"', $field, $fpdb->posts, $value ); // QuotedIdentifierPlaceholder (x2).

$fpdb->prepare( 'SELECT ID FROM %i.%i WHERE %i = "false"', $db, $table, $field ); // OK.

$fpdb->prepare(
	sprintf(
		'xxx IN (%s)',
		implode( ',', array_fill( 0, count($fields), '%i' ) )
	),
	$fields
); // ReplacementsWrongNumber + IdentifierWithinIN.

$fpdb->prepare( 'xxx IN ( ' . implode( ',', array_fill( 0, count( $post_types ),
	'%i' ) ) . ' )',
	$fields
); // IdentifierWithinIN.

$fpdb->prepare( '
	xxx IN ( ' . implode( ',', array_fill( 0, count( $post_types ), "%i" ) ) . ' )',
	$fields
); // IdentifierWithinIN.

// phpcs:set FinPress.DB.PreparedSQLPlaceholders minimum_fp_version 5.8

$fpdb->prepare( 'WHERE %1$+10.3i = %s', $field, $value ); // UnsupportedIdentifierPlaceholder.
$fpdb->prepare( "WHERE '%10i' IS NULL", $field ); // UnsupportedIdentifierPlaceholder + QuotedIdentifierPlaceholder.
$fpdb->prepare( 'xxx IN ( ' . implode( ',', array_fill( 0, count( $post_types ), '%i' ) ) . ' )', $fields ); // UnsupportedIdentifierPlaceholder + IdentifierWithinIN.

// phpcs:set FinPress.DB.PreparedSQLPlaceholders minimum_fp_version

$fpdb->prepare(); // Ignore.

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN (\""
		. implode()
		. "\") AND {$fpdb->posts}.post_id = %s",
	$post_id
); // Bad, dynamic placeholder generation quotes with invalid implode call (no params).

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_status IN ('"
		. implode( ',' )
		. '\') AND {$fpdb->posts}.post_id = %s',
	$post_id
); // Bad, dynamic placeholder generation quotes with invalid implode call (missing second param).

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_status IN ('"
		. implode( '|', array_fill( 0, count($post_stati), '%s' ) )
		. '\') AND {$fpdb->posts}.post_id = %s',
	$post_id
); // Bad x2, dynamic placeholder generation quotes with invalid implode call (separator parameter does not contain expected ',' value).

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN (\""
		. implode( ',', $array_fill )
		. "\") AND {$fpdb->posts}.post_id = %s",
	$post_id
); // Bad, dynamic placeholder generation quotes with invalid implode call (array param is not call to array_fill).

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN (\""
		. implode( ',', array_fill() )
		. "\") AND {$fpdb->posts}.post_id = %s",
	$post_id
); // Bad, dynamic placeholder generation quotes with invalid implode call (array param is call to array_fill() without params).

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN (\""
		. implode( ',', array_fill( 0, count($post_types) ) )
		. "\") AND {$fpdb->posts}.post_id = %s",
	$post_id
); // Bad, dynamic placeholder generation quotes with invalid implode call (array param is call to array_fill(), but missing third param).

// Safeguard that short array as $args is handled correctly.
$fpdb->get_col(
	$fpdb->prepare(
		"SELECT term_taxonomy_id FROM {$fpdb->term_taxonomy} WHERE taxonomy = %s LIMIT %d",
		[ 'taxonomy_name', $limit ]
	) // Ok.
);

// Disregard comments in the implode() $separator param.
$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',' /*comment*/, array_fill( 0, count($post_types), '%s' ) )
	),
	$post_types
); // OK.

// Disregard comments in the array_fill() $value param.
// Also test handling of %i when minimum supported FP version is not high enough yet.
// phpcs:set FinPress.DB.PreparedSQLPlaceholders minimum_fp_version 6.0
$fpdb->prepare( 'xxx IN ( ' . implode( ',', array_fill( 0, count( $post_types ), '%i' /*comment*/ ) ) . ' )', $fields ); // IdentifierWithinIN.
// phpcs:set FinPress.DB.PreparedSQLPlaceholders minimum_fp_version

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN ("
		. implode( ',', array_fill( 0, count($post_types), '%C' ) )
		. ')',
	array_merge( $post_types )
); // Bad x 2, UnsupportedPlaceholder + UnfinishedPrepare.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( 0, count($post_types), '%C' ) )
	),
	$post_types
); // Bad, ReplacementsWrongNumber due to unrecognized placeholder in array_fill().

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN ("
		. implode( ',', array_fill( 0, count($post_types), /*comment*/ '%s' ) )
		. ')',
	array_merge( $post_types )
); // OK.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( 0, count($post_types), "%s" /*comment*/ ) )
	),
	$post_types
); // OK.

// Safeguard that FQN function calls to implode() and array_fill() are handled correctly.
$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		\implode( ',', array_fill( 0, count($post_types), '%s' ) )
	),
	$post_types
); // OK.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', \array_fill( 0, count($post_types), '%s' ) )
	),
	$post_types
); // OK.

$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN ("
		. implode( ',', \array_fill( 0, count($post_types), '%s' ) )
		. ") AND {$fpdb->posts}.post_status IN ("
		. implode( ',', \array_fill( 0, count($post_statusses), '%s' ) )
		. ')',
	array_merge( $post_types, $post_statusses )
); // OK.

/*
 * Safeguard support for PHP 8.0+ named parameters.
 */
// FPDB::prepare() with named params. Named args not supported with ...$args, but that's not the concern of this sniff.
$query = $fpdb->prepare(
	args  : $replacements,
	query : 'SELECT ID
		FROM ' . $fpdb->posts . '
		WHERE post_type = %s',
); // OK, named args not supported with ...$args, but that's not the concern of this sniff.

$query = $fpdb->prepare(
	query : 'SELECT ID
		FROM ' . $fpdb->posts . '
		WHERE post_type = %s',
); // Bad, missing replacements.

$query = $fpdb->prepare(
	args  : $replacements,
	queri : 'SELECT ID
		FROM ' . $fpdb->posts . '
		WHERE post_type = %s',
); // Ignore, incorrect name used for named param `query`, so param not recognized.

// Implode() with named params.
$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( array: array_fill( 0, count( $post_types ), '%s' ), separator: ',', ),
	),
	array_merge( $post_types, $post_statusses )
); // Okay.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( array: $something, separator: ',', ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - `array` param is not an array_fill() function call.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( arrays: array_fill( 0, count( $post_types ), '%s' ), separator: ',', ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - incorrect name used for named param `array`, so param not recognized.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( separator: ',', ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - missing `array` param.

// Array_fill() with named params.
$where = $fpdb->prepare(
	"{$fpdb->posts}.post_type IN ("
		. implode( ',', array_fill( start_index: 0, count: count($post_types), value: '%s' ) ) // Expected order.
		. ") AND {$fpdb->posts}.post_status IN ("
		. implode( ',', array_fill( value: '%s', start_index: 0, count: count($post_statusses), ) ) // Unconventional order.
		. ')',
	array_merge( $post_types, $post_statusses )
); // OK.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( start_index: 0, count: count($post_types) ) ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - missing $value param in array_fill().

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( start_index: 0, values: '%s', count: count($post_types) ) ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - incorrect $values param name in array_fill().

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( value: 's', start_index: 0, count: count($post_types) ) ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - $value param name in array_fill() does not contain placeholder.

$where = $fpdb->prepare(
	sprintf(
		"{$fpdb->posts}.post_type IN (%s)",
		implode( ',', array_fill( value: $s, start_index: 0, count: count($post_types) ) ),
	),
	array_merge( $post_types, $post_statusses )
); // Bad - will throw incorrect nr of replacements error - $value param name in array_fill() does not contain plain text placeholder.

// Sprintf() with named params. This is invalid as variadic functions do not support named params.
// The sniff will ignore the sprintf() as it cannot be analyzed correctly.
$where = $fpdb->prepare(
	sprintf(
		values: implode( ',', array_fill( 0, count($post_types), '%s' ) ),
		format: "{$fpdb->posts}.post_type IN ('%s')",
	),
	array_merge( $post_types, $post_statusses )
); // OK, well not really, but not something we can reliably analyze.

/*
 * Safeguard handling of $fpdb->prepare as PHP 8.1+ first class callable.
 */
$callback = $fpdb->prepare(...); // OK.

