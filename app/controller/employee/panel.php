<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('employee');

render('header', ['title' => get_panel_title()]);
render('/panel_main_nav', [
    'title' => CONSTANTS::TITLE,
    'user_name' => current_user()->username(),
    'link_logout' => URLS::LOGOUT,
]);
echo get_message();
render('employee/panel', [
    'link_job' => URLS::EMPLOYEE_JOB,
    'link_job_prices' => URLS::EMPLOYEE_JOB_PRICES,
    'link_orders' => URLS::EMPLOYEE_ORDERS,
    'link_chart' => URLS:: EMPLOYEE_CHART,
]);
render('footer');
