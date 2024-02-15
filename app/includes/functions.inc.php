<?php

function secure()
{
    if (!isset($_SESSION['id'])) {
        set_message('Please login first!');
        header('Location: /');
        die();
    }
}

function set_message(string $message)
{
    $_SESSION["message"] = $message;
}

function get_message()
{
    if (isset($_SESSION['message'])) {
        echo '<p>' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
}

function check_login(): bool {
    return isset($_SESSION['id']);
}

function redirect(string $url): void
{
    header("Location: {$url}");
    die();
}

function render(string $view_name, array $data = []): void
{
    $view_dir = 'view/';
    extract($data);
    $content = file_get_contents($view_dir . $view_name);

    $content = preg_replace('/{{\s*(.+?)\s*}}/', '<?php echo $1; ?>', $content);

    $content = preg_replace('/@if\(\s*(.+?)\s*\)/', '<?php if($1): ?>', $content);
    $content = str_replace('@endif', '<?php endif; ?>', $content);

    $content = preg_replace('/@foreach\(\s*(.+?)\s*\)/', '<?php foreach($1)', $content);
    $content = str_replace('@endforeach', '<php endforeach; ?>', $content);

    ob_start();
    eval('?>'.$content);
    $final = ob_get_clean();
    echo $final;
}
