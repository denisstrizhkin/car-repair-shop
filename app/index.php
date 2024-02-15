<?php

include_once(__DIR__ . "/includes/urls.inc.php");
include_once(__DIR__ . "/includes/config.inc.php");
include_once(__DIR__ . "/includes/database.inc.php");
include_once(__DIR__ . "/includes/functions.inc.php");

$is_logged_in = check_login();
render("index.html", [
        'is_logged_in' => $is_logged_in,
        'link_login' => URLS::LOGIN,
        'link_logout' => URLS::LOGOUT,
    ]);
