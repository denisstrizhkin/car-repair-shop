<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$job_price = null;
if (!isset($_GET['id'])) {
    set_message('Цена не выбрана');
} else {
    $job_price = JobPrices::get($_GET['id']);
    if (!$job_price) {
        set_message('Цены не существует');
    }
}

if (isset($_POST['job_id'])) {
    try {
        $job_price->set_job_id($_POST['job_id']);
        $job_price->set_model_id($_POST['model_id']);
        $job_price->set_price($_POST['price']);
        $job_price->update();
        set_message('Цена изменена ' . $job_price->job() . ' | ' . $job_price->model());
        redirect(URLS::ADMIN_JOB_PRICES);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$manufacturers = Manufacturer::get_all();
$models = CarModel::get_all();
$jobs = Job::get_all();

render_panel_page('admin/job_prices_edit', [
    'job_price' => $job_price,
    'models' => $models,
    'manufacturers' => $manufacturers,
    'jobs' => $jobs,
]);
