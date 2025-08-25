<?php

namespace Core;

class Validator {
    public static function string($char, $min = 4, $max = 20): bool {
        $char = trim($char);
        return strlen($char) >= $min && strlen($char) <= $max;
    }

    public static function email($char): bool {
        return (bool) filter_var($char, FILTER_VALIDATE_EMAIL);
    }

    public static function number($num, $min = null, $max = null): bool {
        if (!is_numeric($num)) {
            return false;
        }

        if ($min !== null && $num < $min) {
            return false;
        }

        if ($max !== null && $num > $max) {
            return false;
        }

        return true;
    }

    public static function phone(string $phone) : bool
    {
        return preg_match('/^(09\d{9}|(0[2-8]\d{7}))$/', $phone);
    }

    public static function image($file): bool {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $validMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
        if (!in_array($file['type'], $validMimeTypes)) {
            return false;
        }

        $maxFileSize = 2 * 1024 * 1024;
        if ($file['size'] > $maxFileSize) {
            return false;
        }

        return true;
    }
}
