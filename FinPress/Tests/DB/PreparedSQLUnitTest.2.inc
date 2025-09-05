<?php

// Safeguard handling of PHP 7.3+ flexible heredoc.
$fpdb->query( <<<EOT
		SELECT *
		FROM {$fpdb->posts}
		WHERE ID = {$foo};
	EOT
); // Bad.

// Live coding.
// This needs to be the last test in a file.
$fpdb->
