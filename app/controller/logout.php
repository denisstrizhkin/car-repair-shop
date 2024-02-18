<?php

include_once(__DIR__ . '/../includes/config.inc.php');
include_once(__DIR__ . '/../includes/functions.inc.php');
include_once(__DIR__ . '/../includes/urls.inc.php');

session_destroy();
redirect(URLS::ROOT);
