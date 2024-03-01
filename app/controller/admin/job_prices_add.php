<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_POST['job_id'])) {
    try {
        $job_prices = new JobPrices();
        $job_prices->set_job_id($_POST['job_id']);
        $job_prices->set_model_id($_POST['model_id']);
        $job_prices->set_price($_POST['price']);
        $job_prices->insert();
        set_message('Добавлена цена ' . $job_prices->job() . ' | ' . $job_prices->model());
        redirect(URLS::ADMIN_JOB_PRICES);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$manufacturers = Manufacturer::get_all();
$models = CarModel::get_all();
$jobs = Job::get_all();

render_panel_page('admin/job_prices_add', [
    'manufacturers' => $manufacturers,
    'models' => $models,
    'jobs' => $jobs,
]);
