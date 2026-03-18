<?php

namespace App\Core;

class Csrf
{
    public static function generate(): string
    {
        Session::start();
        if (!Session::has('csrf_token')) {
            $token = bin2hex(random_bytes(32));
            Session::set('csrf_token', $token);
        }
        return Session::get('csrf_token');
    }

    public static function input(): string
    {
        $token = self::generate();
        return '<input type="hidden" name="csrf_token" value="' . $token . '">';
    }

    public static function verify(): bool
    {
        Session::start();
        $sessionToken = Session::get('csrf_token');
        $postToken = $_POST['csrf_token'] ?? '';

        if (empty($sessionToken) || empty($postToken)) {
            return false;
        }

        Session::remove('csrf_token');
        return hash_equals($sessionToken, $postToken);
    }
}