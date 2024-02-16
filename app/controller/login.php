<?php

include_once(__DIR__ . "/../includes/constants.inc.php");
include_once(__DIR__ . "/../includes/urls.inc.php");

include_once(__DIR__ . "/../includes/config.inc.php");
include_once(__DIR__ . "/../includes/database.inc.php");
include_once(__DIR__ . "/../includes/functions.inc.php");

function user_login(array $user): void
{
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['phone_number'] = $user['phone_number'];
    $_SESSION['role'] = $user['role'];

    set_message('Вы зашли как пользователь ' . $user['username']);
}

if (isset($_POST['email'])) {
    try {
        $user = user_authorize($_POST['email'], $_POST['password']);
        if ($user) {
            user_login($user);
        } else {
            set_message("Неправильный пароль или почта");
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

render('header', ['title' => CONSTANTS::TITLE . " | Логин"]);
echo get_message();
render('login', []);
render('footer', []);
