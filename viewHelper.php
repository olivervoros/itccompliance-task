<?php

// Sanitize for HTML output
function h($string) {
    return strip_tags($string);
}

// Sanitize for JavaScript output
function j($string) {
    return json_encode($string);
}

// Sanitize for use in a URL
function u($string) {
    return urlencode($string);
}