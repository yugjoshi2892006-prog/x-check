<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * post_size_exceeded()
 *
 * Detects the case where a POST request's total size (files + fields)
 * was bigger than PHP's post_max_size. In that situation PHP empties
 * $_POST and $_FILES completely BEFORE CodeIgniter ever runs, so every
 * form field (customer_id, plan_name, etc.) arrives blank and a
 * "Column 'xxx' cannot be null" DB error happens instead of a clear
 * upload-too-large message.
 *
 * How it works: the Content-Length header still reports the real size
 * the browser sent, even though PHP discarded $_POST/$_FILES. So: if
 * this is a POST request, Content-Length is greater than 0, but both
 * $_POST and $_FILES ended up empty -> that's the signature of this
 * exact bug (as opposed to a normal, legitimately-empty form submit).
 *
 * @return bool
 */
if (!function_exists('post_size_exceeded')) {
    function post_size_exceeded()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
            return false;
        }

        $content_length = isset($_SERVER['CONTENT_LENGTH']) ? (int) $_SERVER['CONTENT_LENGTH'] : 0;

        if ($content_length > 0 && empty($_POST) && empty($_FILES)) {
            return true;
        }

        return false;
    }
}
