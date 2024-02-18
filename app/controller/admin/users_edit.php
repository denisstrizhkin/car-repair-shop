<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$roles = get_roles();
$user = null;
if (!isset($_GET['id'])) {
    set_message('Пользователь не выбран');
} else {
    $user = get_user($_GET['id']);
    if (!$user) {
        set_message('Пользователя не существует');
    }
}

if (isset($_POST['email'])) {
    try {
        update_user(
            $_POST['id'],
            $_POST['username'],
            $_POST['email'],
            $_POST['password'],
            $_POST['phone_number'],
            $_POST['role_id']
        );
        set_message('Пользователь изменен ' . $_POST['username']);
        redirect(URLS::ADMIN_USERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}


render('header', ['title' => CONSTANTS::TITLE . " | Панель управления aдминистратора"]);
echo get_message();
render('admin/users_edit', [
    'roles' => $roles,
    'user' => $user,
]);
render('footer', []);
