<?php
function validatePostData($key): string
{
    if (isset($_POST[$key])) {
        return trim($_POST[$key]);
    } else {
        return '';
    }
}
