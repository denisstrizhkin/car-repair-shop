<?php

include_once(__DIR__ . "database.inc.php");

class User
{
    public int $id;
    public string $username;
    public string $email;
    public string $role;
    public string $phone_number;
    public string $password;

    public function __construct(string $username, string $email, string $password, string $)
    {
    	
    }

    public static function get(int $id): User {
        $db_con = db_connect();
        
    };
};
