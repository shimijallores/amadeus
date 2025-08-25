<?php

namespace Core\Middleware;
class Guest
{
    public function handle(): void
    {
        if ($_SESSION['admin'] ?? false) {
            redirect('/products');
        }
    }
}