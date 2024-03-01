<?php

class URLS {
    const ROOT = '/';
    const CONTROLLER = URLS::ROOT . 'controller/';

    const LOGIN = URLS::CONTROLLER . 'login.php';
    const LOGOUT = URLS::CONTROLLER . 'logout.php';

    const ADMIN_DIR = URLS::CONTROLLER . 'admin/';
    const EMPLOYEE_DIR = URLS::CONTROLLER . 'employee/';
    const CLIENT_DIR = URLS::CONTROLLER . 'client/';

    const ADMIN_PAGE = URLS::ADMIN_DIR . 'panel.php';

    const ADMIN_USERS = URLS::ADMIN_DIR . 'users.php';
    const ADMIN_USERS_EDIT = URLS::ADMIN_DIR . 'users_edit.php';
    const ADMIN_USERS_ADD = URLS::ADMIN_DIR . 'users_add.php';

    const ADMIN_ROLES = URLS::ADMIN_DIR . 'roles.php';
    const ADMIN_ROLES_EDIT = URLS::ADMIN_DIR . 'roles_edit.php';
    const ADMIN_ROLES_ADD = URLS::ADMIN_DIR . 'roles_add.php';

    const ADMIN_MANUFACTURER = URLS::ADMIN_DIR . 'manufacturer.php';
    const ADMIN_MANUFACTURER_EDIT = URLS::ADMIN_DIR . 'manufacturer_edit.php';
    const ADMIN_MANFUCATURER_ADD = URLS::ADMIN_DIR . 'manufacturer_add.php';

    const ADMIN_MODEL = URLS::ADMIN_DIR . 'model.php';
    const ADMIN_MODEL_EDIT = URLS::ADMIN_DIR . 'model_edit.php';
    const ADMIN_MODEL_ADD = URLS::ADMIN_DIR . 'model_add.php';

    const ADMIN_JOB = URLS::ADMIN_DIR . 'job.php';
    const ADMIN_JOB_EDIT = URLS::ADMIN_DIR . 'job_edit.php';
    const ADMIN_JOB_ADD = URLS::ADMIN_DIR . 'job_add.php';

    const ADMIN_JOB_PRICES = URLS::ADMIN_DIR . 'job_prices.php';
    const ADMIN_JOB_PRICES_EDIT = URLS::ADMIN_DIR . 'job_prices_edit.php';
    const ADMIN_JOB_PRICES_ADD = URLS::ADMIN_DIR . 'job_prices_add.php';

    const ADMIN_ORDERS = URLS::ADMIN_DIR . 'orders.php';
    const ADMIN_ORDERS_EDIT = URLS::ADMIN_DIR . 'orders_edit.php';
    const ADMIN_ORDERS_ADD = URLS::ADMIN_DIR . 'orders_add.php';

    const EMPLOYEE_PAGE = URLS::EMPLOYEE_DIR . 'panel.php';

    const EMPLOYEE_JOB = URLS::EMPLOYEE_DIR . 'job.php';
    const EMPLOYEE_JOB_PRICES = URLS::EMPLOYEE_DIR . 'job_prices.php';
    const EMPLOYEE_ORDERS = URLS::EMPLOYEE_DIR . 'orders.php';

    const CLIENT_PAGE = URLS::CLIENT_DIR . 'panel.php';
}
