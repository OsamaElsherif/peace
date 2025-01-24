<?php
namespace Peace\libs;

class CookieHandler {

    /**
     * Sets a cookie.
     *
     * @param string $name The name of the cookie.
     * @param string $value The value of the cookie.
     * @param int $expiry The expiration timestamp (Unix timestamp), default is 1 hour.
     * @param string $path The path on the server in which the cookie is available, default is '/'.
     * @param string|null $domain The domain the cookie is available on, default is null
     * @param bool $secure Set if cookie should only be transmitted over secure https connection, default is false
     * @param bool $httponly Set if the cookie is accessible via HTTP only (not JS), default is true.
     * @return bool  True if the cookie is set, otherwise false.
     */
    public static function set(string $name, string $value, int $expiry = null, string $path = '/', ?string $domain = null, bool $secure = false, bool $httponly = true): bool
    {
        $expiry = $expiry ?? time() + 3600; // Default expiry is 1 hour
        return setcookie($name, $value, $expiry, $path, $domain, $secure, $httponly);
    }


    /**
     * Gets a cookie value by its name.
     *
     * @param string $name The name of the cookie.
     * @return string|null The cookie value, or null if not set.
     */
    public static function get(string $name): ?string
    {
        return $_COOKIE[$name] ?? null;
    }

    /**
     * Checks if a cookie with the given name exists.
     *
     * @param string $name The name of the cookie.
     * @return bool True if cookie exists, false otherwise.
     */
    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

     /**
     * Deletes a cookie by its name.
     *
     * @param string $name The name of the cookie.
     * @param string $path The path that the cookie is available in, default is '/'.
     * @param string|null $domain The domain the cookie is available on, default is null
     * @return bool True if cookie was deleted, false otherwise.
     */
    public static function delete(string $name, string $path = '/', ?string $domain = null): bool
    {
        if (self::has($name)) {
            return setcookie($name, '', 1, $path, $domain);
        }
        return false;
    }
}