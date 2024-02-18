<?php

include_once(__DIR__ . "/constants.inc.php");
include_once(__DIR__ . "/config.inc.php");

function secure(string $role = ''): void
{
    $user = current_user();
    if (!$user) {
        set_message('Пожалуйста сначала войдите в аккаунт!');
        redirect(URLS::ROOT);
    }

    if ($role != $user->role()) {
        set_message('У вашей роли недостаточно прав!');
        redirect(URLS::ROOT);
    }
}

function set_message(string $message): void
{
    $_SESSION["message"] = $message;
}

function get_message(): void
{
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
}

function redirect(string $url): void
{
    header("Location: {$url}");
    die();
}

function render(string $view_name, array $data = []): void
{
    extract($data);
    $content = file_get_contents(CONSTANTS::VIEW_DIR . $view_name . ".html");

    $content = preg_replace('/@if{{\s*(.+?)\s*}}/', '<?php if($1): ?>', $content);
    $content = str_replace('@else', '<?php else: ?>', $content);
    $content = str_replace('@endif', '<?php endif; ?>', $content);

    $content = preg_replace('/@foreach{{\s*(.+?)\s*}}/', '<?php foreach($1): ?>', $content);
    $content = str_replace('@endforeach', '<?php endforeach; ?>', $content);

    $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo $1; ?>', $content);

    $cache_file = __DIR__ . "/../cache/" . $view_name . ".php";
    file_put_contents($cache_file, $content);
    require $cache_file;
}
