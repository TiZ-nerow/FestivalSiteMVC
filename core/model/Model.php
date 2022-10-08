<?php
namespace Core\Model;

use \App;

class Model
{

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

    public static function find($id)
    {
        $instance = self::getInstance();

        return $instance->db->prepare("SELECT * FROM {$instance->table} WHERE id = ?", [$id], get_called_class())->first();
    }

    /*public function all()
    {
        return $this->query('SELECT * FROM ' . $this->table);
    }

    public function total()
    {
        return $this->query('SELECT COUNT(*) FROM ' . $this->table);
    }

    public function query($statement, $attributes = null, $one = false)
    {
        if ($attributes)
            return $this->db->prepare(
                $statement,
                $attributes,
                str_replace('Table', 'Entity', get_class($this)),
                $one
            );

        return $this->db->query(
            $statement,
            str_replace('Table', 'Entity', get_class($this)),
            $one
        );
    }

    public function update($id, $fields) {
        $sql_parts = [];
        $attributes = [];
        foreach( $fields as $k => $v ) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $attributes[] = $id;
        $sql_part = implode(',', $sql_parts);

        return $this->query("UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributes, true);
    }

    public function extract($key, $value) {
        $records = $this->all();
        $return = [];
        foreach( $records as $v ) {
            $return[$v->$key] = $v->$value;
        }

        return $return;
    }

    public function create($fields) {
        $sql_parts = [];
        $attributes = [];
        foreach( $fields as $k => $v ) {
            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }
        $sql_part = implode(',', $sql_parts);

        return $this->query("INSERT INTO {$this->table} SET $sql_part", $attributes, true);
    }

    public function delete($id) {
        return $this->query("DELETE FROM {$this->table} WHERE id = ?", [$id], true);
    }*/

}
