<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_POST['user_id'])) {
    try {
        $orders = new Orders();
        $orders->set_job_id($_POST['job_id']);
        $orders->set_user_id($_POST['job_id']);
        $orders->set_model_id($_POST['model_id']);
        $orders->set_job_id($_POST['model_id']);
        $orders->set_price(JobPrices::find_price($_POST['model_id'], $_POST['job_id']));
        $orders->set_commentary($_POST['commentary']);
        $orders->set_created(date('m/d/Y h:i:s a', time()));
        $orders->insert();
        set_message('Добавлен заказ ' . $orders->job() . ' | ' . $orders->model());
        redirect(URLS::ADMIN_ORDERS);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$manufacturers = Manufacturer::get_all();
$models = CarModel::get_all();
$jobs = Job::get_all();

render_panel_page('admin/orders_add', [
    'manufacturers' => $manufacturers,
    'models' => $models,
    'jobs' => $jobs,
]);
