<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $model = CarModel::get($_GET['delete']);
        if ($model) {
            set_message('Удалена модель ' . $model->name());
            $model->delete();
        } else {
            set_message('Модель не найдена');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$models = CarModel::get_all();

render_panel_page('admin/model', [
    'models' => $models,
    'link_edit' => URLS::ADMIN_MODEL_EDIT,
    'link_add' => URLS::ADMIN_MODEL_ADD,
    'link_delete' => URLS::ADMIN_MODEL,
]);
