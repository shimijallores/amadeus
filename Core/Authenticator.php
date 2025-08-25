<?php

namespace Core;

class Authenticator
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function login_attempt($username, $password): bool
    {
        $admin = $this->db->query("select * from users where username = :username", [':username' => $username])->find();

        if ($admin) {
            if (password_verify($password, $admin['password'])) {
                $this->login($admin);

                Session::flash('success', $admin['username']);
                return true;
            }
        }

        return false;
    }

    public function login($admin): void
    {

        $_SESSION['admin'] = $admin;

        session_regenerate_id(true);
    }

    public function register_attempt($username, $password): bool
    {
        $user = $this->db->query("select * from users where username = :username", [':username' => $username])
            ->find();

        if (!$user) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $this->db->query("insert into users (username, password) values (:username, :password)", [':username' => $username, ':password' => $password]);
            return true;
        }

        return false;
    }
}
