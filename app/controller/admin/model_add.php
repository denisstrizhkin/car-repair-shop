<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$manufacturers = CarModel::get_all();

if (isset($_POST['name'])) {
    try {
        $model = new CarModel();
        $model->set_name($_POST['name']);
        $model->insert();
        set_message('Добавлена роль ' . $model->name());
        redirect(URLS::ADMIN_MODEL);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/model_add', [
    'manufacturers' => $manufacturers,
]);
