<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('client');

$orders = Orders::get_all();
$client_orders = [];
foreach($orders as $order) {
    if ($order->user() == current_user()->username()) {
        array_push($client_orders, $order);
    }
}

render('header', ['title' => get_panel_title()]);
render('/panel_main_nav', [
    'title' => CONSTANTS::TITLE,
    'user_name' => current_user()->username(),
    'link_logout' => URLS::LOGOUT,
]);
echo get_message();
render('client/panel', [
    'orders' => $client_orders,
]);
render('footer');
