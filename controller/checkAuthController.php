<?php
function checkAuth(): bool
{
    return !!($_COOKIE['userId'] ?? false);
}
