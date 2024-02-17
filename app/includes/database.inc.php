<?php

function db_connect(): PDO
{
    $db_host = $_ENV["DB_HOST"];
    $db_port = $_ENV["DB_PORT"];
    $db_name = $_ENV["DB_NAME"];
    $db_user = $_ENV["DB_USER"];
    $db_passwd = $_ENV["DB_PASSWD"];

    $db_str = "mysql:host=$db_host:$db_port;dbname=$db_name";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    return new PDO($db_str, $db_user, $db_passwd, $options);
}

function db_execute(string $sql, array $values = []): void
{
    $dbh = db_connect();
    $sth = $dbh->prepare($sql);
    $sth->execute($values);
}

function fetch(string $sql, array $values = []): mixed
{
    $dbh = db_connect();
    $sth = $dbh->prepare($sql);
    $sth->execute($values);
    return $sth->fetch();
}

function fetchAll(string $sql, array $values = []): array
{
    $dbh = db_connect();
    $sth = $dbh->prepare($sql);
    $sth->execute($values);
    return $sth->fetchAll();
}

function build_select(string $table, string $condition = ''): string
{
    $sql = 'select * from ' . $table;
    if (!$condition) {
        return $sql;
    }
    return $sql . ' where ' . $condition;
}

function build_insert(string $table, array $fields)
{
    $sql = 'insert into ' . $table . ' (';
    $form = 'values (';
    foreach ($fields as $key => $value) {
        $sql .= $key . ', ';
        $form .= ':' . $key . ', ';
    }
    $sql = substr($sql, 0, -2) . ') ' . substr($form, 0, -2) . ')';
    return $sql;
}

function user_authorize(string $email, string $password): mixed
{
    $sql = build_select('users_view', 'email = :email and password = :password');
    $user = fetch($sql, ['email' => $email, 'password' => $password]);
    return $user;
}

function get_users(): array
{
    $sql = build_select('users_view');
    $users = fetchAll($sql);
    return $users;
}

function add_user(
    string $username,
    string $email,
    string $password,
    string $phone_number,
    int $role_id
): void {
    $fields = [
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'phone_number' => $phone_number,
        'role_id' => $role_id
    ];
    $sql = build_insert('users', $fields);
    db_execute($sql, $fields);
}

function get_roles(): array
{
    $sql = build_select('roles');
    $users = fetchAll($sql);
    return $users;
}
