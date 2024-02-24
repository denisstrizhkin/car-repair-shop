<?php

class URLS {
    const ROOT = '/';
    const CONTROLLER = URLS::ROOT . 'controller/';

    const LOGIN = URLS::CONTROLLER . 'login.php';
    const LOGOUT = URLS::CONTROLLER . 'logout.php';

    const ADMIN_DIR = URLS::CONTROLLER . 'admin/';
    const ADMIN_PAGE = URLS::ADMIN_DIR . 'panel.php';
    
    const ADMIN_USERS = URLS::ADMIN_DIR . 'users.php';
    const ADMIN_USERS_EDIT = urls::ADMIN_DIR . 'users_edit.php';
    const ADMIN_USERS_ADD = urls::ADMIN_DIR . 'users_add.php';

    const ADMIN_ROLES = URLS::ADMIN_DIR . 'roles.php';
    const ADMIN_ROLES_EDIT = urls::ADMIN_DIR . 'roles_edit.php';
    const ADMIN_ROLES_ADD = urls::ADMIN_DIR . 'roles_add.php';
}
