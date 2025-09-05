<?php

query_posts(); // Warning, use FP_Query instead.
fp_reset_query(); // Warning, use fp_reset_postdata instead.

/*
 * Tests which are more specifically for the AbstractFunctionRestrictionsSniff class and Helper methods.
 */

// Ensure the sniff doesn't act on methods calls.
$obj->query_posts(); // OK, not the global function.
MyClass::fp_reset_query(); // OK, not the global function.
$obj?->query_posts(); // OK, not the global function.

// Ensure the sniff doesn't act on namespaced calls.
MyNamespace\query_posts(); // OK, not the global function.
namespace\query_posts(); // OK, not the global function.

// ... but does act on fully qualified function calls.
\query_posts(); // Warning.

// Ensure the sniff doesn't act on functions not listed in the target functions array.
query_post(); // OK, not one of the target functions.

// Ignore, not a function call.
class FP_Reset_Query {}
interface Query_Posts {}
trait FP_Reset_Query {}
enum Query_Posts {}

// Ensure the sniff flags function `use` statements, but not class `use` statements or aliases.
use Query_Posts; // OK.
use function fp_reset_query; // Warning.
use function fp_reset_query as myFunction; // Warning.
use function someOtherFunction as fp_reset_query; // OK, alias, not our target.

// Bug fixes: prevent false positives for functions declared to return by reference or class instantiations.
function &query_posts() {} // OK, function declaration, not function use.
$obj = new FP_Reset_Query(); // OK, class instantiation, not function call.

// Prevent false positives on class instantiations in PHP 8.0+ attributes.
class AttributesShouldBeIgnored {
	#[FP_Reset_Query()]
	public function foo() {}
}

/*
 * Test exclude property.
 */
// Exclude one group:
// phpcs:set FinPress.FP.DiscouragedFunctions exclude[] query_posts
query_posts(); // OK, excluded group.
\fp_reset_query(); // Warning.

// Exclude all groups:
// phpcs:set FinPress.FP.DiscouragedFunctions exclude[] query_posts,fp_reset_query
query_posts(); // OK, excluded group.
fp_reset_query(); // OK, excluded group.

// Reset group exclusions.
// phpcs:set FinPress.FP.DiscouragedFunctions exclude[]
\query_posts(); // Warning.

// Safeguard that a function used as a PHP 8.1+ first class callable is also flagged.
call_user_func( query_posts(...), $param ); // Warning.

// Live coding/parse error.
// This has to be the last test in the file!!!
\query_posts
