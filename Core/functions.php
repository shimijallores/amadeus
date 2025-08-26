<?php

use Core\Response;
use Core\Session;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function base_path($path): string
{
    return BASE_PATH . $path;
}

function abort($code = 404): void
{
    http_response_code($code);

    require base_path("Http/views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN): void
{
    if (!$condition) {
        abort($status);
    }
}

function url($url): bool
{
    return $_SERVER['REQUEST_URI'] === $url;
}

function view($path, $attributes = []): void
{
    extract($attributes);

    require base_path("Http/views/" . $path);
}

function redirect($path): void
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Session::get('old')[$key] ?? $default;
}

function assets($path = ''): string
{
    return $_ENV['APP_ENV'] ? 'public/' . $path : $path;
}
