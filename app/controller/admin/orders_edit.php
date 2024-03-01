<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$order = null;
if (!isset($_GET['id'])) {
    set_message('Заказ не выбран');
} else {
    $order = Orders::get($_GET['id']);
    if (!$order) {
        set_message('Заказ не существует');
    }
}

if (isset($_POST['job_id'])) {
    try {
        $order->set_job_id($_POST['job_id']);
        $order->set_user_id($_POST['user_id']);
        $order->set_model_id($_POST['model_id']);
        $order->set_price(JobPrices::find_price($_POST['model_id'], $_POST['job_id']));
        $order->set_commentary($_POST['commentary']);
        $order->update();
        set_message('Заказ изменен ' . $order->job() . ' | ' . $order->model());
        redirect(URLS::ADMIN_ORDERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$users = User::get_all();
$manufacturers = Manufacturer::get_all();
$models = CarModel::get_all();
$jobs = Job::get_all();
$job_prices = JobPrices::get_all();

render_panel_page('admin/orders_edit', [
    'order' => $order,
    'job_prices' => $job_prices,
    'users' => $users,
    'manufacturers' => $manufacturers,
    'models' => $models,
    'jobs' => $jobs,
]);
