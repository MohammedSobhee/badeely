<?php

namespace App\Http\Transformer;

use App\Api\Transformer\Transformer;

class NotificationsTransformer extends Transformer
{
    public function get($item)
    {
        return [
            'id' => $item->id,
            'title' => $item->title,
            'content' => $item->content,
            'category_id' => $item->category_id,
            'action' => $item->action,
            'action_id' => $item->action_id,
            'created_at' => $item->created_at,

//            'sub_categories' => $this->includeMany(new CategoriesTransformer(),$item->children)
        ];
    }
}