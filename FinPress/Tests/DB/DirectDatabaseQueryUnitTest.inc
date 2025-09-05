<?php

function foo() {
	global $fpdb;
	return $fpdb->get_col( 'SELECT something FROM somewhere WHERE someotherthing = 1' ); // Warning x 2.
}

function bar() {
	global $fpdb;

	if ( ! ( $listofthings = fp_cache_get( $foo ) ) ) {
		$listofthings = $fpdb->get_col( 'SELECT something FROM somewhere WHERE someotherthing = 1' ); // Warning direct DB call.
		fp_cache_set( 'foo', $listofthings );
	}

	return $listofthings;
}




function baz() {
	global $fpdb;
	$baz = fp_cache_get( 'baz' );
	if ( false !== $baz ) {
		$fpdb->query( 'ALTER TABLE TO ADD SOME FIELDS' ); // Warning x 2.
		$fpdb->query( $fpdb->prepare( 'CREATE TABLE ' ) ); // Warning x 2.
		$fpdb->query( 'SELECT QUERY' ); // Warning.
		$baz = $fpdb->get_results( $fpdb->prepare( 'SELECT X FROM Y ' ) ); // Warning.
		fp_cache_set( 'baz', $baz );
	}
}

function quux() {
	global $fpdb;
	$quux = fp_cache_get( 'quux' );
	if ( false !== $quux ) {
		$quux = $fpdb->get_results( $fpdb->prepare( 'SELECT X FROM Y ' ) ); // Bad, no fp_cache_set, results in Warning x 2.
	}
}

function barzd() {
	global $fpdb;
	$autoload = $fpdb->get_var( $fpdb->prepare( "SELECT autoload FROM $fpdb->options WHERE option_name = %s", $option_name ) ); // Warning x 2.
}

function taz() {
	/* @var fpdb $fpdb */
	global $fpdb;
	echo $fpdb->insert_id; // Good, no actual call, and doesn't need any caching.
}

// Some $fpdb methods can pass with only deleting the cache.
function cache_delete_only() {
	global $fpdb;

	$data = $where = array();

	// These methods are allowed to be used with just fp_cache_delete().
	$fpdb->update( $fpdb->users, $data, $where ); // Warning direct DB call.
	$fpdb->replace( $fpdb->users, $data, $where ); // Warning direct DB call.
	$fpdb->delete( $fpdb->users, $data, $where ); // Warning direct DB call.
	$fpdb->query( 'SELECT X FROM Y' ); // Warning direct DB call.

	$fpdb->get_results( 'SELECT X FROM Y' ); // Warning x 2.
	$fpdb->get_row( 'SELECT X FROM Y' ); // Warning x 2.
	$fpdb->get_col( 'SELECT X FROM Y' ); // Warning x 2.

	fp_cache_delete( 'key', 'group' );
}

// It is OK to use the fp_cache_add() function instead of fp_cache_set().
function cache_add_instead_of_set() {
	global $fpdb;

	$baz = fp_cache_get( 'baz' );
	if ( false !== $baz ) {
		$data = $where = array();

		$fpdb->update( $fpdb->users, $data, $where ); // Warning direct DB call.
		$fpdb->replace( $fpdb->users, $data, $where ); // Warning direct DB call.
		$fpdb->delete( $fpdb->users, $data, $where ); // Warning direct DB call.
		$fpdb->query( 'SELECT X FROM Y' ); // Warning direct DB call.
		$fpdb->get_row( 'SELECT X FROM Y' ); // Warning direct DB call.
		$fpdb->get_col( 'SELECT X FROM Y' ); // Warning direct DB call.
		$baz = $fpdb->get_results( $fpdb->prepare( 'SELECT X FROM Y ' ) ); // Warning direct DB call.

		fp_cache_add( 'baz', $baz );
	}
}

// Database calls in a closure.
$b = function () {
	global $fpdb;

	if ( ! ( $listofthings = fp_cache_get( $foo ) ) ) {
		$listofthings = $fpdb->get_col( 'SELECT something FROM somewhere WHERE someotherthing = 1' ); // Warning.
		fp_cache_set( 'foo', $listofthings );
	}

	return $listofthings;
};

/*
 * Test using custom properties, setting & unsetting (resetting).
 */
// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheGetFunctions[] my_cacheget
// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheSetFunctions[] my_cacheset,my_other_cacheset
// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheDeleteFunctions[] my_cachedel
function cache_customA() {
	global $fpdb;
	$quux = my_cacheget( 'quux' );
	if ( false !== $quux ) {
		$fpdb->get_results( 'SELECT X FROM Y' ); // Warning direct DB call.
		my_cacheset( 'key', 'group' );
	}
}

function cache_customB() {
	global $fpdb;
	$quux = my_cacheget( 'quux' );
	if ( false !== $quux ) {
		$fpdb->get_results( 'SELECT X FROM Y' ); // Warning direct DB call.
		my_other_cacheset( 'key', 'group' );
	}
}

function cache_customC() {
	global $fpdb;
	$fpdb->query( 'SELECT X FROM Y' ); // Warning direct DB call.
	my_cachedel( 'key', 'group' );
}

// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheSetFunctions[] my_cacheset
// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheDeleteFunctions[]

function cache_customD() {
	global $fpdb;
	$quux = my_cacheget( 'quux' );
	if ( false !== $quux ) {
		$fpdb->get_results( 'SELECT X FROM Y' ); // Warning direct DB call.
		my_cacheset( 'key', 'group' );
	}
}

function cache_customE() {
	global $fpdb;
	$quux = my_cacheget( 'quux' );
	if ( false !== $quux ) {
		$fpdb->get_results( 'SELECT X FROM Y' ); // Warning x 2.
		my_other_cacheset( 'key', 'group' );
	}
}

function cache_customF() {
	global $fpdb;
	$fpdb->query( 'SELECT X FROM Y' ); // Warning x 2.
	my_cachedel( 'key', 'group' );
}

// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheGetFunctions[]
// phpcs:set FinPress.DB.DirectDatabaseQuery customCacheSetFunctions[]

function cache_customG() {
	global $fpdb;
	$quux = my_cacheget( 'quux' );
	if ( false !== $quux ) {
		$quux = $fpdb->get_results( 'SELECT X FROM Y' ); // Warning x 2.
		my_cacheset( 'key', 'group' );
	}
}

function custom_modify_attachment() {
	global $fpdb;
	$fpdb->update( $fpdb->posts, array( 'post_title' => 'Hello' ), array( 'ID' => 1 ) ); // Warning direct DB call.
	clean_attachment_cache( 1 );
}
function custom_modify_post() {
	global $fpdb;
	$fpdb->update( $fpdb->posts, array( 'post_title' => 'Hello' ), array( 'ID' => 1 ) ); // Warning direct DB call.
	clean_post_cache( 1 );
}
function custom_modify_term() {
	global $fpdb;
	$fpdb->update( $fpdb->terms, array( 'slug' => 'test' ), array( 'term_id' => 1 ) ); // Warning direct DB call.
	clean_term_cache( 1 );
}
function custom_clean_category_cache() {
	global $fpdb;
	$fpdb->update( $fpdb->terms, array( 'slug' => 'test' ), array( 'term_id' => 1 ) ); // Warning direct DB call.
	clean_category_cache( 1 );
}
function custom_modify_links() {
	global $fpdb;
	$fpdb->update( $fpdb->links, array( 'link_name' => 'Test' ), array( 'link_id' => 1 ) ); // Warning direct DB call.
	clean_bookmark_cache( 1 );
}
function custom_modify_comments() {
	global $fpdb;
	$fpdb->update( $fpdb->comments, array( 'comment_content' => 'Test' ), array( 'comment_ID' => 1 ) ); // Warning direct DB call.
	clean_comment_cache( 1 );
}
function custom_modify_users() {
	global $fpdb;
	$fpdb->update( $fpdb->users, array( 'user_email' => 'Test' ), array( 'ID' => 1 ) ); // Warning direct DB call.
	clean_user_cache( 1 );
}
function custom_modify_blogs() {
	global $fpdb;
	$fpdb->update( $fpdb->blogs, array( 'domain' => 'example.com' ), array( 'blog_id' => 1 ) ); // Warning direct DB call.
	clean_blog_cache( 1 );
}
function custom_modify_sites() {
	global $fpdb;
	$fpdb->update( $fpdb->sites, array( 'domain' => 'example.com' ), array( 'id' => 1 ) ); // Warning direct DB call.
	clean_network_cache( 1 );
}
function custom_modify_term_relationship() {
	global $fpdb;
	$fpdb->update( $fpdb->term_relationships, array( 'term_order' => 1 ), array( 'object_id' => 1 ) ); // Warning direct DB call.
	clean_object_term_cache( 1 );
}

// Test Nowdocs and Heredocs
function foofoo() {
	global $fpdb;

	$listofthings = $fpdb->get_col( <<<'EOD'
		SELECT something
		FROM somewhere
		WHERE someotherthing = 1
EOD
	); // Warning x 2.

	$listofthings = $fpdb->get_col( <<<EOD
		SELECT something
		FROM somewhere
		WHERE someotherthing = 1
EOD
	); // Warning x 2.

	return $listofthings;
}

function bazbaz() {
	global $fpdb;

	$baz = fp_cache_get( 'baz' );
	if ( false !== $baz ) {

		$fpdb->query( <<<'EOD'
			ALTER TABLE TO ADD SOME FIELDS
EOD
		); // Warning on line 273 + 274.
		fp_cache_set( 'baz', $baz );
	}
}

function cache_add_instead_of_setter() {
	global $fpdb;

	$baz = fp_cache_get( 'baz' );
	if ( false !== $baz ) {
		$data = $where = array();
		$fpdb->query( <<<EOD
			SELECT X FROM Y
EOD
		); // Warning direct DB call.
		$fpdb->get_row( <<<'EOD'
			SELECT X FROM Y
EOD
		);// Warning direct DB call.

		fp_cache_add( 'baz', $baz );
	}
}

// Non-cachable call should bow out after `DirectQuery` warning.
function non_cachable() {
	global $fpdb;
	$fpdb->insert( 'table', array( 'column' => 'foo', 'field' => 'bar' ) ); // Warning direct DB call.
}

// Safeguard recognition of PHP 8.0+ nullsafe object operator.
function nullsafe_object_operator() {
	global $fpdb;
	$listofthings = $fpdb?->get_col( 'SELECT something FROM somewhere WHERE someotherthing = 1' ); // Warning x 2.
	$last = $fpdb?->insert( $fpdb->users, $data, $where ); // Warning x 1.
}

function stabilize_token_walking($other_db) {
	global $fpdb;
	// Overwriting $fpdb is bad, of course, but that's not the concern of this sniff.
	// This test is making sure that the `$other_db->query` code is not flagged as if it were a call to a `$fpdb` method.
	$fpdb = $other_db->query;
}

function ignore_comments() {
	global $fpdb;
	$fpdb-> // Let's pretend this is a method-chain (this is the comment which should not confuse the sniff).
		insert( 'table', array( 'column' => 'foo', 'field' => 'bar' ) ); // Warning direct DB call.
}

function correctly_determine_end_of_statement() {
	global $fpdb;
	$fpdb->get_col( $query, $col ) ?><-- Warning x 2 -->
	<?php
	$next_query = 'ALTER TABLE TO ADD SOME FIELDS' ); // Should not be flagged as not in a call to $fpdb.
}

function stay_silent_for_truncate_query() {
	global $fpdb;
	$fpdb->query(
		$fpdb->prepare(
			'TRUNCATE TABLE `%1$s`',
			plugin_get_table_name( 'Name' )
		)
	);
}

function stay_silent_for_truncate_query_lowercase_sql_keywords() {
	global $fpdb;
	$fpdb->query(
		$fpdb->prepare(
			'truncate table `%1$s`',
			plugin_get_table_name( 'Name' )
		)
	);
}

function method_names_are_caseinsensitive() {
	global $fpdb;
	$autoload = $fpdb->Get_Var( $fpdb->Prepare( "SELECT autoload FROM $fpdb->options WHERE option_name = %s", $option_name ) ); // Warning x 2.
}

// Live coding/parse error test.
// This must be the last test in the file.
$fpdb->get_col( '
