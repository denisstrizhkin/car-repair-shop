<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

$manufacturer = null;
if (!isset($_GET['id'])) {
    set_message('Производитель не выбран');
} else {
    $manufacturer = manufacturer::get($_GET['id']);
    if (!$manufacturer) {
        set_message('Производителя не существует');
    }
}

if (isset($_POST['name'])) {
    try {
        $manufacturer->set_name($_POST['name']);
        $manufacturer->update();
        set_message('Производитель изменен ' . $manufacturer->name());
        redirect(URLS::ADMIN_MANUFACTURER);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/manufacturer_edit', [
    'manufacturer' => $manufacturer,
]);
