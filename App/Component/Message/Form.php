<?php

namespace App\Component\Message;

use \App\Component\Message;

class Form extends Message
{
    const ERROR = 'error';
    const SUCCESS = 'success';
    const INFO = 'info';
    const WARNING = 'warning';

    protected $name = "form";

    public function setField($name, $msg)
    {
        $this->params[$name] = $msg;

        return $this;
    }

    public function setGeneral(string $type = null, string $message)
    {
        $this->set('general', [
            'type' => $type,
            'msg' => $message
        ]);

        return $this;
    }
}
