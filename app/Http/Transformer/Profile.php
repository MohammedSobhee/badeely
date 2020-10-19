<?php

namespace App\Http\Transformer;

use App\Api\Transformer\Transformer;

class Profile extends Transformer
{
    public function get($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'email' => $item->email,
            'mobile' => $item->mobile,
            'language' => $item->language,
            'gender' => $item->gender ? __('inputs.'.$item->gender) : '',
            'age' => $item->age,
            'type' => $item->email ? 1 : 2,
            'country' => [
                'id' => $item->country->id ?? 0,
                'code' => $item->country->code ?? '',
                'name' => $item->country->name ?? ''
            ],
        ];
    }
}