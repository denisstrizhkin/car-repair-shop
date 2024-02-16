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

function fetch(string $sql, array $values = []): mixed {
    $dbh = db_connect();
    $sth = $dbh->prepare($sql);
    $sth->execute($values);
    return $sth->fetch();
}

function fetchAll(string $sql, array $values = []): array {
    $dbh = db_connect();
    $sth = $dbh->prepare($sql);
    $sth->execute($values);
    return $sth->fetchAll();
}

function build_sql(string $table, string $condition = ''): string {
    $sql = 'select * from ' . $table;
    if (!$condition) {
        return $sql;
    }
    return $sql . ' where ' . $condition;
}

function user_authorize(string $email, string $password): mixed
{
    $sql = build_sql('users_view', 'email = :email and password = :password');
    $user = fetch($sql, ['email' => $email, 'password' => $password]);
    return $user;
}
