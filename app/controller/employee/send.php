<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");
include_once(__DIR__ . "/../../includes/mailer.inc.php");

secure('employee');

$order = null;
if (!isset($_GET['id'])) {
    set_message('Заказ не выбран');
} else {
    $order = Orders::get($_GET['id']);
    if (!$order) {
        set_message('Заказ не существует');
    }
}

if (isset($_POST['user_id'])) {
    try {
        $order = Orders::get($_POST['order_id']);
        $user = User::get($_POST['user_id']);
        mailer_send($_POST['receiver'], $order->model() . ' | ' . $order->created(), $_POST['body']);
        set_message('Сообщение отправлено');
        redirect(URLS::EMPLOYEE_ORDERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$users = User::get_all();
$user = null;
foreach ($users as $user) {
    if ($user->username() == $order->user()) {
        $user = $user;
        break;
    }
}

render_panel_page('send', [
    'user' => $user,
    'order' => $order,
]);
