<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$users = User::get_all();

render('header', ['title' => CONSTANTS::TITLE . " | Панель управления aдминистратора"]);
echo get_message();
render('admin/users', [
    'users' => $users,
    'link_edit' => URLS::ADMIN_USERS_EDIT,
    'link_add' => URLS::ADMIN_USERS_ADD,
    'link_delete' => URLS::ADMIN_USERS,
]);
render('footer', []);
