<?php

namespace Core\Middleware;
class Admin
{
    public function handle(): void
    {
        if (! $_SESSION['admin'] ?? false) {
            redirect('/login');
        }
    }
}