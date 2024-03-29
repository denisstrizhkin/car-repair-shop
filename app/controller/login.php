<?php

include_once(__DIR__ . "/../includes/constants.inc.php");
include_once(__DIR__ . "/../includes/urls.inc.php");

include_once(__DIR__ . "/../includes/config.inc.php");
include_once(__DIR__ . "/../includes/functions.inc.php");

function redirect_role(): void {
    $user = current_user();
    if (!$user) {
        return;
    }

    switch ($user->role()) {
        case 'admin':
            redirect(URLS::ADMIN_PAGE);
        case 'employee':
            redirect(URLS::EMPLOYEE_PAGE);
        case 'client':
            redirect(URLS::CLIENT_PAGE);
    }
}

function user_login(User $user): void
{
    set_current_user($user);
    set_message('Вы зашли как пользователь ' . $user->username());
    redirect_role();
}

if (isset($_POST['email'])) {
    try {
        $user = User::user_authorize($_POST['email'], $_POST['password']);
        if ($user) {
            user_login($user);
        } else {
            set_message("Неправильный пароль или почта");
        }
    } catch (Throwable $e) {
        set_message($e->getMessage());
    }
}

redirect_role();

render('header', ['title' => CONSTANTS::TITLE . " | Логин"]);
render("index_nav", [
        'title' => CONSTANTS::TITLE,
        'link_login' => URLS::LOGIN,
    ]);
echo get_message();
render('login', []);
render('footer', []);
