<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_POST['name'])) {
    try {
        $job = new Job();
        $job->set_name($_POST['name']);
        $job->set_description($_POST['description']);
        $job->insert();
        set_message('Добавлена работа ' . $job->name());
        redirect(URLS::ADMIN_JOB);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/job_add');
