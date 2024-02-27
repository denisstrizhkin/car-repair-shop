<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$roles = Role::get_all();
$user = null;
if (!isset($_GET['id'])) {
    set_message('Пользователь не выбран');
} else {
    $user = User::get($_GET['id']);
    if (!$user) {
        set_message('Пользователя не существует');
    }
}

if (isset($_POST['email'])) {
    try {
        $user->set_username($_POST['username']);
        $user->set_email($_POST['email']);
        $user->set_password($_POST['password']);
        $user->set_phone($_POST['phone_number']);
        $user->set_role_id($_POST['role_id']);
        $user->update();
        set_message('Пользователь изменен ' . $user->username());
        redirect(URLS::ADMIN_USERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/users_edit', [
    'roles' => $roles,
    'user' => $user,
]);
