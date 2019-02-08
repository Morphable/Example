<?php

namespace App\Infrastructure;

class Model
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

    public function update()
    {
        if (empty($this->data) || !isset($this->data['id']) || $this->tabel == null) {
            return false;
        }

        $id = $this->data['id'];
        $data = $this->data;
        unset($data['id']);

        return $this->db
                ->builder($this->table)
                ->update($data)
                ->where('`id` = ?', $id)
                ->execute();
    }

    public function insert()
    {
        if (empty($this->data) || isset($this->data['id']) || $this->tabel == null) {
            return false;
        }

        return $this->db
                ->builder($this->table)
                ->insert($this->data)
                ->execute()
                ->getLastInsertId();
    }
}
