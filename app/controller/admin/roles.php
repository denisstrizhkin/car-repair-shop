<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $role = Role::get($_GET['delete']);
        if ($role) {
            set_message('Удалена роль ' . $role->name());
            $role->delete();
        } else {
            set_message('Роль не найдена');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$roles = Role::get_all();

render_panel_page('admin/roles', [
    'roles' => $roles,
    'link_edit' => URLS::ADMIN_ROLES_EDIT,
    'link_add' => URLS::ADMIN_ROLES_ADD,
    'link_delete' => URLS::ADMIN_ROLES,
]);
