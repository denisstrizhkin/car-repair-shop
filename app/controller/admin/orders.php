<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $orders = Orders::get($_GET['delete']);
        if ($orders) {
            set_message('Удален заказ ' . $orders->job() . ' | ' . $orders->model());
            $orders->delete();
        } else {
            set_message('Заказ не найден');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$orders = Orders::get_all();

render_panel_page('admin/orders', [
    'orders' => $orders,
    'link_edit' => URLS::ADMIN_ORDERS_EDIT,
    'link_add' => URLS::ADMIN_ORDERS_ADD,
    'link_delete' => URLS::ADMIN_ORDERS,
]);
