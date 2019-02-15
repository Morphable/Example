<?php

namespace App\Infrastructure;

abstract class Model
{
    protected $data = [];

    protected $table;

    public function __construct()
    {
        $this->db = Application::getService('database');
    }

    protected function set($name, $val)
    {
        $this->data[$name] = $val;

        return $this;
    }

    protected function get($name)
    {
        return $this->data[$name];
    }

    abstract public function beforeUpdate();

    public function update()
    {
        $this->beforeUpdate();

        $id = $this->data['id'];
        $data = $this->data;
        unset($data['id']);

        return $this->db
                ->builder($this->table)
                ->update($data)
                ->where('`id` = ?', $id)
                ->execute();
    }

    abstract public function beforeInsert();

    public function insert()
    {
        $this->beforeInsert();

        return $this->db
                ->builder($this->table)
                ->insert($this->data)
                ->execute();
    }
}
