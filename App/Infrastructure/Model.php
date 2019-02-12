<?php

namespace App\Infrastructure;

abstract class Model
{
    protected $data = [];

    protected $tabel;

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

    abstract public function prepareUpdate();

    public function update()
    {
        if (empty($this->data) || !isset($this->data['id']) || $this->tabel == null) {
            return false;
        }

        $this->prepareUpdate();

        $id = $this->data['id'];
        $data = $this->data;
        unset($data['id']);

        return $this->db
                ->builder($this->table)
                ->update($data)
                ->where('`id` = ?', $id)
                ->execute();
    }

    abstract public function prepareInsert();

    public function insert()
    {
        if (empty($this->data) || isset($this->data['id']) || $this->tabel == null) {
            return false;
        }

        $this->prepareInsert();

        return $this->db
                ->builder($this->table)
                ->insert($this->data)
                ->execute()
                ->getLastInsertId();
    }
}
