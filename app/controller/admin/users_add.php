<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$roles = Role::get_all();

if (isset($_POST['email'])) {
    try {
        $user = new 
        add_user(
            $_POST['username'],
            $_POST['email'],
            $_POST['password'],
            $_POST['phone_number'],
            $_POST['role_id']
        );
        set_message('Добавлен пользователь ' . $_POST['username']);
        redirect(URLS::ADMIN_USERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}


render('header', ['title' => CONSTANTS::TITLE . " | Панель управления aдминистратора"]);
echo get_message();
render('admin/users_add', [
    'roles' => $roles,
]);
render('footer', []);
