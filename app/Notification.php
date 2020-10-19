<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    protected $appends = ['category'];

    public function Category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function getCategoryAttribute()
    {
     if ($this->category_id == 0){
         return __('inputs.all');
     }
     return $this->Category()->first()->name;
    }
}
