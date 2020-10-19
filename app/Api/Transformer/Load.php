<?php

namespace App\Api\Transformer;

class Load
{
    private $object;
    private $data;

    public function __construct($object,$data)
    {
        $this->object = $object;
        $this->data = $data;
    }

    public function one()
    {
        return $this->object->get($this->data);
    }

    public function collection()
    {
        return $this->object->collection($this->data->all());
    }
}