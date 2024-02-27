<?php

include_once(__DIR__ . "/database.inc.php");

abstract class Model
{
    protected array $fields;
    protected int | null $id;

    protected const string TABLE = 'model';

    function __construct()
    {
        $this->fields = [];
        $this->id = null;
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
        $this->id = db_last_insert_id();
    }

    function delete(): void
    {
        $sql = build_delete(static::TABLE, 'id = :id');
        db_execute($sql, ['id' => $this->id]);
        $this->id = null;
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
        $models = db_fetchAll($sql);
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
        $model = db_fetch($sql, ['id' => $id]);
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
        $user = db_fetch($sql, ['email' => $email, 'password' => $password]);
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

class Manufacturer extends Model
{
    protected const string TABLE = "manufacturer";

    function name(): string
    {
        return $this->fields['name'];
    }

    function set_name(string $name): void
    {
        $this->fields['name'] = $name;
    }
}

class CarModel extends Model
{
    protected const string TABLE = "model";
    private string | null $manufacturer = null;

    function name(): string
    {
        return $this->fields['name'];
    }

    function set_name(string $name): void
    {
        $this->fields['name'] = $name;
    }

    function manufacturer(): string
    {
        if ($this->manufacturer) {
            return $this->manufacturer;
        }
        $manufacturer = Manufacturer::get($this->fields['manufacturer_id']);
        $this->manufacturer = $manufacturer->name();
        return $this->manufacturer;
    }

    function set_manufacturer_id(int $id): void
    {
        $manufacturer = Manufacturer::get($id);
        $this->fields['manufacturer_id'] = $manufacturer->id();
        $this->manufacturer = $manufacturer->name();
    }
}
