<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$manufacturers = Manufacturer::get_all();
$model = null;
if (!isset($_GET['id'])) {
    set_message('Модель не выбрана');
} else {
    $model = CarModel::get($_GET['id']);
    if (!$model) {
        set_message('Модели не существует');
    }
}

if (isset($_POST['name'])) {
    try {
        $model->set_name($_POST['name']);
        $model->set_manufacturer_id($_POST['manufacturer_id']);
        $model->update();
        set_message('Модель изменена ' . $model->name());
        redirect(URLS::ADMIN_MODEL);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/model_edit', [
    'model' => $model,
    'manufacturers' => $manufacturers,
]);
