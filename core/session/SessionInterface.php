<?php
namespace Core\Session;

interface SessionInterface
{

    /**
     * Récupère une information en Session
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * Ajoute une information en Session
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function set(string $key, $value);

    /**
     * Supprime une clef en session
     * @param string $key
     * @return void
     */
    public function delete(string $key);

}
