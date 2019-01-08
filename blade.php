<?php

/**
 * Get the contents of a file
 *
 * Example:
 * @fileContents(source/img/icons/logo.svg)
 *
 * @return  string  File contents
 */
$bladeCompiler->directive('fileContents', function($expression) {
    return '<?php
        $file = '.$expression.';
        echo file_exists($file) ? file_get_contents($file) : ""; ?>';
});
