<?php

namespace App\Core;

class Session
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, mixed $value): void
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::start();
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        self::start();
        return isset($_SESSION[$key]);
    }

    public static function remove(string $key): void
    {
        self::start();
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        self::start();
        session_destroy();
        $_SESSION = [];
    }

    public static function isLoggedIn(): bool
    {
        return self::has('user_id');
    }

    public static function setFlash(string $type, string $message): void
    {
        self::set('flash', ['type' => $type, 'message' => $message]);
    }

    public static function getFlash(): ?array
    {
        $flash = self::get('flash');
        self::remove('flash');
        return $flash;
    }
}