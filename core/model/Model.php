<?php
namespace Core\Model;

use \App;

class Model
{

    protected $table;

    protected $db;

    public static function getInstance()
    {
        $class = get_called_class();
        return new $class();
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

    public static function all()
    {
        $instance = self::getInstance();

        return $instance->db->query('SELECT * FROM ' . $instance->table, get_called_class())->get();
    }

    public static function find($id)
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT * FROM {$instance->table} WHERE id = ?", [$id], get_called_class())->first();
    }

    public static function exist($fields)
    {
        $instance = self::getInstance();

        $sql_parts = [];
        $attributes = [];
        foreach( $fields as $k => $v ) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(' AND ', $sql_parts);

        return $instance->db->prepare("SELECT * FROM $instance->table WHERE $sql_part", $attributes, get_called_class())->first();
    }

    public static function total()
    {
        $instance = self::getInstance();

        return $instance->db->query('SELECT COUNT(*) FROM ' . $instance->table, get_called_class())->first();
    }

    public static function extract($key, $value) {
        $records = self::all();
        $return = [];
        foreach( $records as $v ) {
            $return[$v->$key] = $v->$value;
        }

        return $return;
    }

    public static function create($fields) {
        $instance = self::getInstance();

        $sql_parts = [];
        $attributes = [];
        foreach( $fields as $k => $v ) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(',', $sql_parts);

        return $instance->db->prepare("INSERT INTO {$instance->table} SET $sql_part", $attributes);
    }

    public function update($fields)
    {
        $sql_parts = [];
        $attributes = [];
        foreach( $fields as $k => $v ) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $this->id;
        $sql_part = implode(',', $sql_parts);

        return $this->prepare("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributes);
    }

    public function delete()
    {
        return $this->prepare("DELETE FROM {$this->table} WHERE id = ?", [$this->id]);
    }

}
