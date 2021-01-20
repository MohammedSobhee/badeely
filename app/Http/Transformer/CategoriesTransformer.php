<?php

namespace App\Http\Transformer;

use App\Api\Transformer\Transformer;

class CategoriesTransformer extends Transformer
{
    public function get($item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'image' => $item->image(),
            'children_count' => $item->children()->count(),
            'follow_num' => $item->follow_num,
            'is_follow' => $item->is_follow,
            'status' => $item->status,

//            'sub_categories' => $this->includeMany(new CategoriesTransformer(),$item->children)
        ];
    }
}