<?php

include_once("includes/urls.inc.php");
include_once("includes/config.inc.php");
include_once("includes/database.inc.php");
include_once("includes/functions.inc.php");

secure();
render('admin/panel.html', [
    'link_users' => URLS::ADMIN_USERS,
    'link_roles' => URLS::ADMIN_USERS,
]);
