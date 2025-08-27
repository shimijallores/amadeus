<?php

namespace Core;

class Authenticator
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function login_attempt(array $attributes): bool
    {
        $user = $this->db->query("select * from users where username = :username", [':username' => $attributes['username']])->find();

        if ($user) {
            if (password_verify($attributes['password'], $user['password'])) {
                $this->login($user);

                Session::flash('success', $user['username']);
                return true;
            }
        }

        return false;
    }

    public function login($user): void
    {
        $_SESSION['user'] = $user;

        session_regenerate_id(true);
    }

    public function register_attempt(array $attributes): bool
    {
        $user = $this->db->query("select * from users where username = :username", [':username' => $attributes['username']])
            ->find();

        if (!$user) {
            $password = password_hash($attributes['password'], PASSWORD_DEFAULT);

            $this->db->query("insert into users (username, password, role) values (:username, :password, :role)", [
                ':username' => $attributes['username'],
                ':password' => $password,
                ':role' => $attributes['role']
            ]);

            $user = $this->db->query("SELECT * FROM users ORDER BY id DESC LIMIT 1")->find_or_fail();

            $this->login($user);
            return true;
        }

        return false;
    }
}
