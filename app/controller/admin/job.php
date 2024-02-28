<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $job = Job::get($_GET['delete']);
        if ($job) {
            set_message('Удалена работа ' . $job->name());
            $job->delete();
        } else {
            set_message('Работа не найдена');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$jobs = Job::get_all();
echo $jobs[0]->name();
var_dump($jobs);

// render_panel_page('admin/job', [
//     'jobs' => $jobs,
//     'link_edit' => URLS::ADMIN_JOB_EDIT,
//     'link_add' => URLS::ADMIN_JOB_ADD,
//     'link_delete' => URLS::ADMIN_JOB,
// ]);
