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
    return $sth->fetch(PDO::FETCH_ASSOC);
}

function fetchAll(string $sql, array $values = []): array
{
    $dbh = db_connect();
    $sth = $dbh->prepare($sql);
    $sth->execute($values);
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function build_select(string $table, string $condition = ''): string
{
    $sql = 'select * from ' . $table;
    if (!$condition) {
        return $sql;
    }
    return $sql . ' where ' . $condition;
}

function build_insert(string $table, array $fields): string
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

function build_update(string $table, string $condition, array $fields): string {
    $sql = 'update ' . $table . ' set ';
    foreach ($fields as $key => $value) {
        $sql .= $key . ' = :' . $key . ', ';
    }
    $sql = substr($sql, 0, -2) . ' where ' . $condition;
    return $sql;
}
