<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $user = User::get($_GET['delete']);
        if ($user) {
            set_message('Удален пользователь ' . $user->username());
            $user->delete();
        } else {
            set_message('Пользователь не найден');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$users = User::get_all();

render_panel_page('admin/users', [
    'users' => $users,
    'link_edit' => URLS::ADMIN_USERS_EDIT,
    'link_add' => URLS::ADMIN_USERS_ADD,
    'link_delete' => URLS::ADMIN_USERS,
]);
