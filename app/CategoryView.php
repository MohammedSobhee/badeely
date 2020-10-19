<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryView extends Model
{
    protected $guarded = [];

    public function scopeBetweenDate($query)
    {
        if(request('from') && request('to')){
            $query->whereBetween('created_at',[request('from'),request('to')]);
        }
    }
}
