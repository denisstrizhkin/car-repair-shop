<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

render('header', ['title' => get_panel_title()]);
echo get_message();
render('admin/panel', [
    'user_name' => current_user()->username(),
    'link_logout' => URLS::LOGOUT,
    'link_users' => URLS::ADMIN_USERS,
    'link_roles' => URLS::ADMIN_ROLES,
    'link_manufacturer' => URLS::ADMIN_MANUFACTURER,
    'link_model' => URLS::ADMIN_MODEL,
    'link_job' => URLS::ADMIN_JOB,
    'link_job_prices' => URLS::ADMIN_JOB_PRICES,
    'link_orders' => URLS::ADMIN_JOB,
]);
render('footer');
