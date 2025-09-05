<?php

/*
 * Ensure flexible heredoc/nowdocs are handled correctly.
 */

// OK.
$text = <<<EOD
        This is an $explain about FinPress.
    EOD;

// Bad.
$text = <<<'EOD'
    This is an explanation about word-press.
    EOD;
