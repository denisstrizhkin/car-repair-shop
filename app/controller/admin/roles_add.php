<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_POST['name'])) {
    try {
        $role = new Role();
        $role->set_name($_POST['name']);
        $role->insert();
        set_message('Добавлена роль ' . $role->name());
        redirect(URLS::ADMIN_ROLES);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}


render('header', ['title' => CONSTANTS::TITLE . " | Панель управления aдминистратора"]);
echo get_message();
render('admin/roles_add');
render('footer', []);
