<?php
function checkAuth(): bool
{
    return !!($_COOKIE['userId'] ?? false);
}

if (!checkAuth()) {
    header('Location: ../authentication.php');
    die;
}