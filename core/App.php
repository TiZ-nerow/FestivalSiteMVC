<?php

use Core\Database\MysqlDatabase;

class App
{

    private static $_instance;

    private $db_instance;

    public static function load()
    {
        require ROOT . '/app/Autoloader.php';
        App\Autoloader::register();
        require ROOT . '/core/Autoloader.php';
        Core\Autoloader::register();

        require ROOT . '/app/helper/helper.php';
        require ROOT . '/core/helper/helper.php';
    }

    public static function getInstance()
    {
        if (is_null(self::$_instance))
            self::$_instance = new App();

        return self::$_instance;
    }

    public static function getDb()
    {
        $app = self::getInstance();

        if (is_null($app->db_instance)) {
            $config = config('database');
            $app->db_instance = new MysqlDatabase($config['db_name'], $config['db_user'], $config['db_pass'], $config['db_host']);
        }

        return $app->db_instance;
    }

}
