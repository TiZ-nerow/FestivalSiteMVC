<?php
namespace Core\Session;

use \Core\Session\PHPSession;

class FlashService
{

    private static $_instance;

    /**
     * @var SessionInterface
     */
    private $session;

    private $sessionKey = 'flash';

    private $messages;

    public static function getInstance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new FlashService();

        return self::$_instance;
    }

    public function __construct(/*SessionInterface $session*/)
    {
        $this->session = new PHPSession(); // en attendant l'injecteur de dépendance
    }

    public static function set($key, $message)
    {
        $obj = self::getInstance();

        $flash = $obj->session->get($obj->sessionKey, []);
        $flash[$key] = $message;
        $flash = $obj->session->set($obj->sessionKey, $flash);
    }

    public static function get($key = null)
    {
        $obj = self::getInstance();

        if (is_null($obj->messages)) {
            $obj->messages = $obj->session->get($obj->sessionKey, []);
            $obj->session->delete($obj->sessionKey);
        }

        if (is_null($key))
            return $obj->messages;

        if (isset($obj->messages[$key]))
            return $obj->messages[$key];

        return null;
    }

}
