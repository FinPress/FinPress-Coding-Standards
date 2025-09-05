<?php

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ) ); // Warning - missing $ver, Warning - In Footer is set to a falsy (default) value.

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), /* comment */ '1.1.1', true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), /* comment */ '0' /* another comment */, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '1.1.1', $in_footer ); // OK, the value is set.

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 0, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), false, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), null, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 0.0, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 00.00, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 0x0, true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 100.001, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 0x1, true ); // Hex number, OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 052, true ); // Octal number, OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 1, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 0.1, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 1.0, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), 2 * 8, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '0', true ); // Error - 0, false or NULL are not allowed.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '0.0.0', true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '0.1.0', true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '0' . '0', true ); // OK.

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), FP_VERSION, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), true, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), function() { }, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), $version, true ); // OK.

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '1.1.0' ); // Warning - In Footer is set to a falsy (default) value.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '1.1.0', false ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '1.1.0', null ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '1.1.0', 0 ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), '1.1.0', $in_footer ); // OK.

fp_enqueue_script( 'script-name', 'https://example.com/someScript.js', false, '1.0.0', true ); // OK.
fp_enqueue_script( 'script-name', 'https://example.com/someScript.js' ); // Warning - missing $ver, Warning - missing $in_footer.

fp_register_style( 'script-name', 'https://example.com/someScript.js', false, '1.0.0' ); // OK.
fp_register_style( 'script-name', 'https://example.com/someScript.js' ); // Warning - missing $ver.

fp_enqueue_style( 'script-name', 'https://example.com/someScript.js', false, '1.0.0'); // OK.
fp_enqueue_style( 'script-name', 'https://example.com/someScript.js' ); // Warning - missing $ver.

fp_register_script( 'someScript-js' ); // OK.
fp_enqueue_script( 'someScript-js' ); // OK.

fp_register_style( 'someScript-js' ); // OK.
fp_enqueue_style( 'someScript-js' ); // OK.

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), (bool) 1, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), (bool) 0, true ); // Error - 0, false or NULL are not allowed.

fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), (binary) 123, true ); // OK.
fp_register_script( 'someScript-js', 'https://example.com/someScript.js' , array( 'jquery' ), b'0', true ); // Error - 0, false or NULL are not allowed.

// Safeguard support for PHP 8.0+ named parameters.
fp_register_script(
	ver      : 0, // Error - 0, false or NULL are not allowed.
	in_footer: false,
	src      : 'https://example.com/someScript.js',
	handle   : 'someScript-js',
);
fp_enqueue_script(
	src: 'https://example.com/someScript.js',
	handle: 'script-name',
); // Warning - missing $ver, Warning - missing $in_footer.

// Safeguard that comments in the parameters are ignored.
fp_register_script(
	'someScript-js',
	'https://example.com/someScript.js',
	array( 'jquery' ),
	// Error - 0, false or NULL are not allowed.
	null,
	true,
);

// Safeguard handling of PHP 7.4 numeric literals with underscores.
fp_register_script( 'someScript-js', $url, [], 0_0.0_0, true ); // Error - 0, false or NULL are not allowed.

// Safeguard handling of PHP 8.1 explicit octals.
fp_register_script( 'someScript-js', $url, [], 0o0, true ); // Error - 0, false or NULL are not allowed.

// Live coding/parse error.
fp_register_style( src: 'https://example.com/someScript.js', ver: /*to do*/, handle: 'someScript-js', );
