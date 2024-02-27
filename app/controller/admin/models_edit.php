<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$role = null;
if (!isset($_GET['id'])) {
    set_message('Роль не выбрана');
} else {
    $role = role::get($_GET['id']);
    if (!$role) {
        set_message('Роли не существует');
    }
}

if (isset($_POST['name'])) {
    try {
        $role->set_name($_POST['name']);
        $role->update();
        set_message('Роль изменена ' . $role->name());
        redirect(URLS::ADMIN_ROLES);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}


render('header', ['title' => CONSTANTS::TITLE . " | Панель управления aдминистратора"]);
echo get_message();
render('admin/roles_edit', [
    'role' => $role,
]);
render('footer', []);
