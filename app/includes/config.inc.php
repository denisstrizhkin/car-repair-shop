<?php

include_once(__DIR__ . '/models.inc.php');

session_start();
date_default_timezone_set('Europe/Moscow');

function current_user(): User | null {
    if (!isset($_SESSION['user'])) {
        return null;
    }
    return $_SESSION['user'];
}

function set_current_user(User $user): void {
    $_SESSION['user'] = $user;
}
