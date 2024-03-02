<?php

include_once(__DIR__ . "/../includes/constants.inc.php");
include_once(__DIR__ . "/../includes/urls.inc.php");
include_once(__DIR__ . "/../includes/config.inc.php");
include_once(__DIR__ . "/../includes/database.inc.php");
include_once(__DIR__ . "/../includes/functions.inc.php");

secure();

var_dump($_POST);

render('header', ['title' => get_panel_title()]);
render("index_nav", [
    'title' => CONSTANTS::TITLE,
    'link_login' => URLS::LOGIN,
]);
echo get_message();
render('footer');
