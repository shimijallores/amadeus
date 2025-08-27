<?php

namespace Core\Middleware;
class Admin
{
    public function handle(): void
    {
        if (! $_SESSION['user'] ?? false) {
            redirect('/login');
        }
    }
}