<?php

/*
 * Verify an incorrect nonce check _after_ in the global scope.
 */

if ( isset ( $_REQUEST['prefix_myfield'] ) {
	echo $_REQUEST['prefix_myfield']; // Bad, nonce is too late.
}

fp_verify_nonce( $_REQUEST['prefix_nonce'] );
