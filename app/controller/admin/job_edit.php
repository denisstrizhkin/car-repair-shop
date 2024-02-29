<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$job = null;
if (!isset($_GET['id'])) {
    set_message('Работа не выбрана');
} else {
    $job = job::get($_GET['id']);
    if (!$job) {
        set_message('Работы не существует');
    }
}

if (isset($_POST['name'])) {
    try {
        $job->set_name($_POST['name']);
        $job->set_description($_POST['description']);
        $job->update();
        set_message('Роль изменена ' . $job->name());
        redirect(URLS::ADMIN_JOB);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/job_edit', [
    'job' => $job,
]);
