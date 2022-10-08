<?php
namespace Core\Model;

use \App;

class Model
{
    //self::getDb()
    private static $_instance;

    protected $table;

    private $db;

    public static function getInstance()
    {
        if (is_null(self::$_instance)) {
            $class = get_called_class();
            self::$_instance = new $class();
        }

        return self::$_instance;
    }

    public function __construct()
    {
        $this->db = App::getDb();

        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $class_name = end($parts);
            $this->table = strtolower(str_replace('Table', '', $class_name)) . 's';
        }
    }

    public function __get($key)
    {
        $method = 'get' . ucfirst($key);
        $this->key = $this->$method();
        return $this->key;
    }

    public static function find($id)
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT * FROM {$instance->table} WHERE id = ?", [$id], true, get_called_class());
    }

}
