<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $job_prices = JobPrices::get($_GET['delete']);
        if ($job_prices) {
            set_message('Удалена цена ' . $job_prices->job() . ' | ' . $job_prices->model());
            $job_prices->delete();
        } else {
            set_message('Цена не найдена');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$job_prices = JobPrices::get_all();

render_panel_page('admin/job_prices', [
    'job_prices' => $job_prices,
    'link_edit' => URLS::ADMIN_JOB_PRICES_EDIT,
    'link_add' => URLS::ADMIN_JOB_PRICES_ADD,
    'link_delete' => URLS::ADMIN_JOB_PRICES,
]);
