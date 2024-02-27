<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_POST['name'])) {
    try {
        $manufacturer = new Manufacturer();
        $manufacturer->set_name($_POST['name']);
        $manufacturer->insert();
        set_message('Добавлен производитель машин ' . $manufacturer->name());
        redirect(URLS::ADMIN_MANUFACTURER);
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render_panel_page('admin/manufacturer_add');
