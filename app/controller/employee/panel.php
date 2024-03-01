<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('employee');

render('header', ['title' => get_panel_title()]);
echo get_message();
render('employee/panel', [
    'user_name' => current_user()->username(),
    'link_logout' => URLS::LOGOUT,
    'link_job' => URLS::EMPLOYEE_JOB,
    'link_job_prices' => URLS::EMPLOYEE_JOB_PRICES,
    'link_orders' => URLS::EMPLOYEE_ORDERS,
]);
render('footer');
