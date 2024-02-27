<?php

include_once(__DIR__ . "/../../includes/constants.inc.php");
include_once(__DIR__ . "/../../includes/urls.inc.php");
include_once(__DIR__ . "/../../includes/config.inc.php");
include_once(__DIR__ . "/../../includes/database.inc.php");
include_once(__DIR__ . "/../../includes/functions.inc.php");

secure('admin');

if (isset($_GET['delete'])) {
    try {
        $manufacturer = Manufacturer::get($_GET['delete']);
        if ($manufacturer) {
            set_message('Удален производитель ' . $manufacturer->name());
            $manufacturer->delete();
        } else {
            set_message('Производитель не найден');
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

$manufacturers = Manufacturer::get_all();

render_panel_page('admin/manufacturer', [
    'manufacturers' => $manufacturers,
    'link_edit' => URLS::ADMIN_MANUFACTURER_EDIT,
    'link_add' => URLS::ADMIN_MANFUCATURER_ADD,
    'link_delete' => URLS::ADMIN_MANUFACTURER,
]);
