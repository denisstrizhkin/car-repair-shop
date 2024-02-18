<?php

include_once(__DIR__ . "/includes/constants.inc.php");
include_once(__DIR__ . "/includes/urls.inc.php");
include_once(__DIR__ . "/includes/config.inc.php");
include_once(__DIR__ . "/includes/database.inc.php");
include_once(__DIR__ . "/includes/functions.inc.php");

$user = current_user();
render('header', ['title' => CONSTANTS::TITLE . " | Логин"]);
echo get_message();
render("index_nav", [
        'link_login' => URLS::LOGIN,
    ]);
render('footer', []);
