<?php

namespace App\Api\Transformer;

abstract class Transformer
{
    public abstract function get($item);

    public function collection(array $items)
    {
        return array_map([$this, 'get'], $items);
    }

    public function includeMany($model,$data)
    {
        return $model->collection($data->all());
    }

    public function includeOne($model,$data)
    {
        return $model->get($data);
    }

}