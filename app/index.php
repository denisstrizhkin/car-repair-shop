<?php

include_once(__DIR__ . "/includes/constants.inc.php");
include_once(__DIR__ . "/includes/urls.inc.php");
include_once(__DIR__ . "/includes/config.inc.php");
include_once(__DIR__ . "/includes/database.inc.php");
include_once(__DIR__ . "/includes/functions.inc.php");

$user = current_user();

$manufacturers = Manufacturer::get_all();
$models = CarModel::get_all();
$jobs = Job::get_all();
$job_prices = JobPrices::get_all();

render('header', ['title' => CONSTANTS::TITLE . " | Логин"]);
render("index_nav", [
    'title' => CONSTANTS::TITLE,
    'link_login' => URLS::LOGIN,
]);
echo get_message();
render('index', [
    'manufacturers' => $manufacturers,
    'models' => $models,
    'jobs' => $jobs,
    'job_prices' => $job_prices,
]);
render('footer', []);
