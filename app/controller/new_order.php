<?php

include_once(__DIR__ . "/../includes/constants.inc.php");
include_once(__DIR__ . "/../includes/urls.inc.php");
include_once(__DIR__ . "/../includes/config.inc.php");
include_once(__DIR__ . "/../includes/database.inc.php");
include_once(__DIR__ . "/../includes/functions.inc.php");

secure();

if ($_POST['user_id']) {
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
        redirect(URLS::ROOT);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$model = CarModel::get($_POST['model_id']);
$job = Job::get($_POST['job_id']);

$order_str = $job->name() . ' | ' . $model->get_model_str();

render('header', ['title' => get_panel_title()]);
render("index_nav", [
    'title' => CONSTANTS::TITLE,
    'link_login' => URLS::LOGIN,
]);
echo get_message();
render('new_order', [
    'order_str' => $order_str,
    'user_id' => current_user()->id(),
    'job_id' => $job->id(),
    'model_id' => $model->id(),
]);
render('footer');
