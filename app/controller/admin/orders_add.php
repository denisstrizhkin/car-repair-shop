<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_POST['user_id'])) {
    try {
        $order = new Orders();
        $order->set_job_id($_POST['job_id']);
        $order->set_user_id($_POST['user_id']);
        $order->set_model_id($_POST['model_id']);
        $order->set_price(JobPrices::find_price($_POST['model_id'], $_POST['job_id']));
        $order->set_commentary($_POST['commentary']);
        $order->set_created(date('Y-m-d H:i:s', time()));
        $order->insert();
        set_message('Добавлен заказ ' . $order->job() . ' | ' . $order->model());
        redirect(URLS::ADMIN_ORDERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$manufacturers = Manufacturer::get_all();
$models = CarModel::get_all();
$jobs = Job::get_all();
$job_prices = JobPrices::get_all();
$users = User::get_all();

render_panel_page('admin/orders_add', [
    'job_prices' => $job_prices,
    'users' => $users,
    'manufacturers' => $manufacturers,
    'models' => $models,
    'jobs' => $jobs,
]);
