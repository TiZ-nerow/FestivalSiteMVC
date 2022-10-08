<?php
namespace Core\Session;

class PHPSession implements SessionInterface
{

    /**
     * S'assure que la Session est démarée
     */
    private function ensureStarted()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Récupère une information en Session
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->ensureStarted();

        if (array_key_exists($key, $_SESSION))
            return $_SESSION[$key];

        return $default;
    }

    /**
     * Ajoute une information en Session
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value)
    {
        $this->ensureStarted();

        $_SESSION[$key] = $value;
    }

    /**
     * Supprime une clef en session
     * @param string $key
     */
    public function delete(string $key)
    {
        $this->ensureStarted();

        unset($_SESSION[$key]);
    }

    /**
     * Détruit la Session
     */
    public function destroy()
    {
        if (session_status() !== PHP_SESSION_NONE)
            session_destroy();
    }

}
