<?php

include_once(__DIR__ . "/database.inc.php");

abstract class Model
{
    protected array $fields;
    protected int | null $id;

    protected const string TABLE = 'model';

    protected function __construct()
    {
        $this->fields = [];
        $this->id = null;
    }

    static function from_fields(string $name): static
    {
        $model = new static();
        $model->fields['name'] = $name;
        return $model;
    }

    protected static function from_fields_arr(array $fields): static
    {
        $model = new static();
        $model->id = $fields['id'];
        unset($fields['id']);
        $model->fields = $fields;
        return $model;
    }

    function id(): int | null
    {
        return $this->id;
    }

    function insert(): void
    {
        $sql = build_insert(static::TABLE, $this->fields);
        db_execute($sql, $this->fields);
    }

    function update(): void
    {
        $sql = build_update(static::TABLE, 'id = :id', $this->fields);
        $fields = $this->fields;
        $fields['id'] = $this->id;
        db_execute($sql, $fields);
    }

    static function get_all(): array
    {
        $sql = build_select(static::TABLE);
        $models = fetchAll($sql);
        $new_models = [];
        foreach ($models as $model) {
            $new_model = static::from_fields_arr($model);
            array_push($new_models, $new_model);
        }
        return $new_models;
    }

    static function get(int $id): static | null
    {
        $sql = build_select(static::TABLE, 'id = :id');
        $model = fetch($sql, ['id' => $id]);
        if (!$model) {
            return null;
        }
        return static::from_fields_arr($model);
    }
}

class Role extends Model
{
    protected const string TABLE = "roles";

    function name(): string
    {
        return $this->fields['name'];
    }

    function set_name(string $name): void
    {
        $this->fields['name'] = $name;
    }
}

class User extends Model
{
    protected const string TABLE = "users";

    private string | null $role = null;

    static function user_authorize(string $email, string $password): self | null
    {
        $sql = build_select(self::TABLE, 'email = :email and password = :password');
        $user = fetch($sql, ['email' => $email, 'password' => $password]);
        if (!$user) {
            return null;
        }
        return self::from_fields_arr($user);
    }

    function username(): string
    {
        return $this->fields['username'];
    }

    function set_username(string $username): void
    {
        $this->fields['username'] = $username;
    }

    function email(): string
    {
        return $this->fields['email'];
    }

    function set_email(string $email): void
    {
        $this->fields['email'] = $email;
    }

    function password(): string
    {
        return $this->fields['password'];
    }

    function set_password(string $password): void
    {
        $this->fields['password'] = $password;
    }

    function phone(): string
    {
        return $this->fields['phone_number'];
    }

    function set_phone(string $phone): void
    {
        $this->fields['phone_number'] = $phone;
    }

    function role(): string
    {
        if ($this->role) {
            return $this->role;
        }
        $role = Role::get($this->fields['role_id']);
        $this->role = $role->name();
        return $this->role;
    }

    function set_role_id(int $id): void
    {
        $role = Role::get($id);
        $this->fields['role_id'] = $role->id();
        $this->role = $role->name();
    }
}
